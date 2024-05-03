<?php
session_start();

$doc_id = $_POST['doc_id'];
$check = $_POST['check'];

$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

$sql = "DELETE FROM user_to_document_to_agreement WHERE DOCUMENT_ID = '$doc_id'";
if ($check == 0) {  

    if ($connectMySQL->query($sql) === TRUE) {
        $sql = "DELETE FROM diary_document WHERE ID = '$doc_id'";

        if ($connectMySQL->query($sql) === TRUE) {
            header('Location: ../pages/documents.php');
        }
        else {
            echo "Ошибка при удалении документа: " . $connectMySQL->error;
        }
    }
    else {
        echo "Ошибка при удалении документа: " . $connectMySQL->error;
    }
}
else {
    if ($connectMySQL->query($sql) === TRUE) {
        $sql = "UPDATE diary_document 
            SET 
            SRC = NULL,
            STUDENT_QUALITIES = NULL,
            PROBLEM_SOLVING_SPEED = NULL,
            WORK_AMOUNT = NULL,
            WORK_YEAR = NULL,
            REMARKS = DEFAULT,
            STUDENT_ASSESSMENT = NULL,
            COMMENT = NULL,
            PRACTICE_PLACE = NULL,
            PRACTICE_PLACE_ADDRESS = NULL,
            PRACTICE_DEADLINES = NULL,
            STATUS = 3
            WHERE ID = '$doc_id'";

        if ($connectMySQL->query($sql) === TRUE) {
            header('Location: ../pages/documents.php');
        }
        else {
            echo "Ошибка при удалении документа: " . $connectMySQL->error;
        }
    }
    else {
        echo "Ошибка при удалении документа: " . $connectMySQL->error;
    }
}

$connectMySQL->close();
?>