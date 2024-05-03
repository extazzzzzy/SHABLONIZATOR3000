<?php
session_start();
if ($_SESSION['ROLE'] != "usu_chief")
{
    header("Location: ../pages/profile.php");
    die();
}
$diary_document_id = $_POST['document_id'];
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

if ($connectMySQL->query("SELECT STATUS FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc()['STATUS'] != '2')
{
    header("Location: ../pages/profile.php");
    die();
}

$STUDENTS_GROUP = $_POST['STUDENTS_GROUP'];
$PRACTICE_KIND = $_POST['PRACTICE_KIND'];
$PRACTICE_TYPE = $_POST['PRACTICE_TYPE'];
$CODE_AND_PREPARATION_DIRECTION = $_POST['CODE_AND_PREPARATION_DIRECTION'];
$ORDER_NUMBER_AND_DATE = $_POST['ORDER_NUMBER_AND_DATE'];
$YEAR = $_POST['YEAR'];
$REPORT_YEAR = $_POST['REPORT_YEAR'];


$students_result = $connectMySQL->query("SELECT STUDENT_COURSE FROM `user` WHERE `ROLE` = 'student' AND `STUDENT_GROUP` = '$STUDENTS_GROUP'");
$STUDENTS_COURSE = $students_result->fetch_assoc()['STUDENT_COURSE'];
$connectMySQL->query("UPDATE `diary_document` SET `STUDENTS_GROUP` = '$STUDENTS_GROUP', `STUDENTS_COURSE` = '$STUDENTS_COURSE', `PRACTICE_KIND` = '$PRACTICE_KIND', `PRACTICE_TYPE` = '$PRACTICE_TYPE', `CODE_AND_PREPARATION_DIRECTION` = '$CODE_AND_PREPARATION_DIRECTION', `ORDER_NUMBER_AND_DATE` = '$ORDER_NUMBER_AND_DATE', `YEAR` = '$YEAR', `REPORT_YEAR` = '$REPORT_YEAR', `STATUS` = '4' WHERE `id` = '$diary_document_id'");
header("Location: ../pages/documents.php");

?>
