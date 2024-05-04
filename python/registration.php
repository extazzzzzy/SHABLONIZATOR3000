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

$check_statement->store_result();

if ($check_statement->num_rows > 0) {
    echo "Пользователь с таким логином уже существует.";
    exit;
}

$check_statement->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FULLNAME = $_POST['FULLNAME'];
    $LOGIN = $_POST['LOGIN'];
    $PASSWORD = $_POST['PASSWORD'];
    $STUDENT_COURSE = $_POST['STUDENT_COURSE'];
    $STUDENT_GROUP = $_POST['STUDENT_GROUP'];
    $INSTITUTE = $_POST['INSTITUTE'];
    $PREPARATION_DIRECTION = $_POST['PREPARATION_DIRECTION'];




    $result = shell_exec('python fullname_variations.py ' . escapeshellarg($FULLNAME));
    $output = json_decode($result, true);
    $STUDENT_FULLNAME_ROD = $output["STUDENT_FULLNAME_ROD"];
    $STUDENT_FULLNAME_DAT = $output["STUDENT_FULLNAME_DAT"];


    $statement = $mysql->prepare("INSERT INTO user (FULLNAME, FULLNAME_ROD, FULLNAME_DAT, LOGIN, PASSWORD, STUDENT_COURSE, STUDENT_GROUP, INSTITUTE, PREPARATION_DIRECTION) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$statement) {
        die("Ошибка подготовки запроса: " . $mysql->error);
    }

    $statement->bind_param("sssssisss", $FULLNAME, $STUDENT_FULLNAME_ROD, $STUDENT_FULLNAME_DAT, $LOGIN, $PASSWORD, $STUDENT_COURSE, $STUDENT_GROUP, $INSTITUTE, $PREPARATION_DIRECTION);
    if (!$statement->execute()) {
        die("Ошибка выполнения запроса: " . $statement->error);
    }

    $ID = $statement->insert_id;

    $statement->close();
    $mysql->close();

    header('Location: ../pages/auth.php');
}
