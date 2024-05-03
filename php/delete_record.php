<?php
    session_start();

    $doc_id = $_POST['doc_id'];

    $connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');
    $sql = "DELETE FROM diary_document WHERE ID = '$doc_id'";

    if ($connectMySQL->query($sql) === TRUE) {
        header('Location: ../pages/documents.php');
    } else {
        echo "Ошибка при удалении документа: " . $mysql->error;
    }

    $connectMySQL->close();
?>