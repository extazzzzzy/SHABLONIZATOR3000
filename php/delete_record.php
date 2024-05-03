<?php
    session_start();

    $doc_id = $_POST['doc_id'];

    $connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

    $sql = "DELETE FROM user_to_document_to_agreement WHERE DOCUMENT_ID = '$doc_id'";

    if ($connectMySQL->query($sql) === TRUE) {
        $sql = "DELETE FROM diary_document WHERE ID = '$doc_id'";

        if ($connectMySQL->query($sql) === TRUE) {
            header('Location: ../pages/documents.php');
        } else {
            echo "Ошибка при удалении документа: " . $connectMySQL->error;
        }
    } 
    else {
        echo "Ошибка при удалении документа: " . $connectMySQL->error;
    }

    $connectMySQL->close();
?>