<?php
session_start();

if ($_SESSION['role'] != "org_chief") {
    header("Location: ../pages/profile.php");
    die;
}

$student_group = $_POST['student_group'];

$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');
$connectMySQL->query("UPDATE `diary_document` SET `student_group` = '$student_group', `status` = 4 WHERE `usu_chief_id` = " . $_SESSION['id']);

?>