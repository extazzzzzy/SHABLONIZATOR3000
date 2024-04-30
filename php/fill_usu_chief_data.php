<?php
session_start();
$_SESSION['id'] = 1;
/*if ($_SESSION['role'] != "usu_chief") {
    header("Location: ../pages/profile.php");
    die;
}*/

$student_group = 1521;//$_POST['student_group'];

$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

$diary_record = $connectMySQL->query("SELECT * FROM `diary_document` WHERE `usu_chief_id` = " . $_SESSION['id'])->fetch_assoc();
$connectMySQL->query("DELETE FROM `diary_document` WHERE `usu_chief_id` = " . $_SESSION['id']);

$students_result = $connectMySQL->query("SELECT id FROM `user` WHERE `role` = 'student'");
while ($row = $students_result->fetch_assoc())
{
    $connectMySQL->query("INSERT INTO `diary_document` (`TEMPLATE_ID`, `STUDENT_GROUP`, `STUDENT_ID`, `USU_CHIEF_ID`, `STATUS`, `TIMESTAMP`) VALUES (" .
        $diary_record['TEMPLATE_ID'] . ", '$student_group', " . $row['id'] . ", " . $diary_record['USU_CHIEF_ID'] . ", '2', CURRENT_TIMESTAMP)");
}

?>
