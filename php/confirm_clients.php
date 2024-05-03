<?php
    session_start();
    $user_id = $_SESSION['ID'];
    $doc_id = $_POST['doc_id'];
    $agree = $_POST['answer'];
    $comment = $_POST['comment'];

    echo $agree;

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
    
    if ($agree == 0)
        header('Location: ../pages/documents.php');
?>