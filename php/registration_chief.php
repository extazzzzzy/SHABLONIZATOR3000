<?php
session_start();
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASSWORD = 'root';
const DB_NAME = 'shablonizator3000';

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

$LOGIN = $_POST['LOGIN'];

$check_statement = $mysql->prepare("SELECT ID FROM user WHERE LOGIN = ?");
if (!$check_statement) {
    die("Ошибка подготовки запроса: " . $mysql->error);
}

$check_statement->bind_param("s", $phone_number);
if (!$check_statement->execute()) {
    die("Ошибка выполнения запроса: " . $check_statement->error);
}

$check_statement->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FULLNAME = $_POST['FULLNAME'];
    $LOGIN = $_POST['LOGIN'];
    $PASSWORD = $_POST['PASSWORD'];
    $ROLE = $_POST['ROLE'];
    $POSITION = $_POST['POSITION'];

    $statement = $mysql->prepare("INSERT INTO user (FULLNAME, LOGIN, PASSWORD, ROLE, POSITION) VALUES (?, ?, ?, ?, ?)");
    if (!$statement) {
        die("Ошибка подготовки запроса: " . $mysql->error);
    }

    $statement->bind_param("sssss", $FULLNAME, $LOGIN, $PASSWORD, $ROLE, $POSITION);
    if (!$statement->execute()) {
        die("Ошибка выполнения запроса: " . $statement->error);
    }

    $ID = $statement->insert_id;

    $statement->close();

    $mysql->close();

    header('Location: ../pages/documents.php');
}
