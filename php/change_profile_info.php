<?php
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASSWORD = 'root';
const DB_NAME = 'shablonizator3000';

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysql->connect_errno) {
    exit("Ошибка подключения к базе данных: " . $mysql->connect_error);
}

if (isset($_POST["ID"]) && isset($_POST["FULLNAME"]) && isset($_POST["FULLNAME_ROD"]) && isset($_POST["FULLNAME_DAT"]) && isset($_POST["LOGIN"]) && isset($_POST["PASSWORD"]) && isset($_POST["STUDENT_COURSE"]) && isset($_POST["STUDENT_GROUP"]) && isset($_POST["INSTITUTE"]) && isset($_POST["PREPARATION_DIRECTION"])) {
    $ID = $_POST["ID"];

    $FULLNAME = $_POST["FULLNAME"];
    $FULLNAME_ROD = $_POST["FULLNAME_ROD"];
    $FULLNAME_DAT = $_POST["FULLNAME_DAT"];

    $LOGIN = $_POST["LOGIN"];
    $PASSWORD = $_POST["PASSWORD"];
    $STUDENT_COURSE = $_POST["STUDENT_COURSE"];
    $STUDENT_GROUP = $_POST["STUDENT_GROUP"];
    $INSTITUTE = $_POST["INSTITUTE"];
    $PREPARATION_DIRECTION = $_POST["PREPARATION_DIRECTION"];


    $sql = "UPDATE user SET FULLNAME = '$FULLNAME', FULLNAME_ROD = '$FULLNAME_ROD', FULLNAME_DAT = '$FULLNAME_DAT', LOGIN = '$LOGIN', PASSWORD = '$PASSWORD', STUDENT_COURSE = '$STUDENT_COURSE', STUDENT_GROUP = '$STUDENT_GROUP', INSTITUTE = '$INSTITUTE', PREPARATION_DIRECTION = '$PREPARATION_DIRECTION' WHERE ID = '$ID'";


    if ($mysql->query($sql) === TRUE) {
        header('Location: ../pages/profile.php');
    } else {
        echo "Ошибка: " . $mysql->error;
    }
} else {
    echo "Некорректные данные.";
}

$mysql->close();
?>
