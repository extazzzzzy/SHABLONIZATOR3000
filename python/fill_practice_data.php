<?php
session_start();
if ($_SESSION['ROLE'] != "org_chief")
{
    header("Location: ../pages/profile.php");
    die();
}
$diary_document_id = $_POST['document_id']; //

$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

$practice_place = $_POST['practice_place'];
if ($practice_place == "other") {
    $practice_place = $_POST['other_place'];
}
$practice_place_address = $_POST['practice_place_address'];
$work_year = $_POST['work_year'];
$practice_deadlines = $_POST['practice_deadlines'];
$practice_deadlines1 = $_POST['practice_deadlines1'];
$practice_deadlines = "c " . $practice_deadlines . " по " . $practice_deadlines1;

$students_groups = $_POST['student_groups'];

foreach ($students_groups as $students_group)
{
    $students_id = $connectMySQL->query("SELECT `ID` FROM `user` WHERE `ROLE` = 'student' AND `STUDENT_GROUP` = '$students_group'");
    while ($student_id = $students_id->fetch_assoc()['ID'])
    {
        $connectMySQL->query("UPDATE `diary_document` SET `PRACTICE_PLACE` = '$practice_place', `PRACTICE_PLACE_ADDRESS` = '$practice_place_address', `WORK_YEAR` = '$work_year', `PRACTICE_DEADLINES` = '$practice_deadlines' WHERE `STUDENT_ID` = '$student_id' AND `ORGANIZATION_CHIEF_ID` = " . $_SESSION['ID']);
    }
}
$students_id = $_POST['students_id'];

foreach ($students_id as $student_id)
{
    $connectMySQL->query("UPDATE `diary_document` SET `PRACTICE_PLACE` = '$practice_place', `PRACTICE_PLACE_ADDRESS` = '$practice_place_address', `WORK_YEAR` = '$work_year', `PRACTICE_DEADLINES` = '$practice_deadlines' WHERE `STUDENT_ID` = '$student_id' AND `ORGANIZATION_CHIEF_ID` = " . $_SESSION['ID']);
}



header("Location: ../pages/documents.php");
?>
