<?php
    session_start();
    $user_id = $_SESSION['ID'];
    $doc_id = $_POST['doc_id'];
    $agree = $_POST['answer'];
    $comment = $_POST['comment'];
    
    if ($agree == 1)
        $comment = "принят";

    $connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');
        $connectMySQL->query("INSERT INTO `user_to_document_to_agreement` (`USER_ID`, `DOCUMENT_ID`, `AGREEMENT`)
                                 VALUES ('$user_id', '$doc_id', '$agree')");

    $user_fullname = $connectMySQL->query("SELECT FULLNAME FROM `user` 
                                            WHERE `ID` = " . $user_id)->fetch_assoc()['FULLNAME'];

    $exist_comment = $connectMySQL->query("SELECT COMMENT FROM `diary_document` 
                                            WHERE `ID` = " . $doc_id)->fetch_assoc()['COMMENT'];
    if (isset($exist_comment))
        $comment = $exist_comment . "<div>" . $user_fullname . ": <br>" . $comment . "</div><br>";
    else
        $comment = "<div>" . $user_fullname . ": <br>" . $comment . "</div><br>";

    $sql = "UPDATE diary_document SET COMMENT = '$comment' WHERE ID = '$doc_id'";

    $connectMySQL->query($sql);

    $view_agree = $connectMySQL->query("SELECT * FROM user_to_document_to_agreement
                                            WHERE DOCUMENT_ID = '$doc_id'");

    $template_id = $connectMySQL->query("SELECT TEMPLATE_ID FROM `diary_document`
                                            WHERE `ID` = ". $doc_id)->fetch_assoc()['TEMPLATE_ID'];

    if (isset($view_agree)) {
        $count_accept= 0;
        while ($row = $view_agree->fetch_assoc()) {
            if ($row['AGREEMENT'] == 0) {
                $sql = "UPDATE diary_document SET STATUS = -1 WHERE ID = '$doc_id'";

                $connectMySQL->query($sql);
                break;
            }
            else
                $count_accept++;
        }
        if($template_id == 2 && $count_accept == 2) {
            $sql = "UPDATE diary_document SET STATUS = 6 WHERE ID = '$doc_id'";

            $connectMySQL->query($sql);
        }
        else if($count_accept == 3) {
            if ($template_id == 1)
                $sql = "UPDATE diary_document SET STATUS = 6 WHERE ID = '$doc_id'";
            else
                $sql = "UPDATE diary_document SET STATUS = 7 WHERE ID = '$doc_id'";

            $connectMySQL->query($sql);
        }
        else if($count_accept == 4 && $template_id == 1) {
            $sql = "UPDATE diary_document SET STATUS = 7 WHERE ID = '$doc_id'";

            $connectMySQL->query($sql);
        }
    }
    
    if ($agree == 0)
        header('Location: ../pages/documents.php');
?>