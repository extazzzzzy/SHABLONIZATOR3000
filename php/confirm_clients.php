<?php
    session_start();
    $user_id = $_SESSION['ID'];
    $doc_id = $_POST['doc_id'];
    $agree = $_POST['answer'];
    $connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

        $connectMySQL->query("INSERT INTO `user_to_document_to_agreement` (`USER_ID`, `DOCUMENT_ID`, `AGREEMENT`)
                                 VALUES ('$user_id', '$doc_id', '$agree')");
?>