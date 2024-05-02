<?php
session_start();
if ($_SESSION['ROLE'] != "org_chief")
{
    header("Location: ../pages/profile.php");
    die();
}
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

$practice_place = $_POST['practice_place'];
$practice_place_address = $_POST['practice_place_address'];
$work_year = $_POST['work_year'];
$practice_deadlines = $_POST['practice_deadlines'];
$students_id = $_POST['students_id'];

foreach ($students_id as $student_id)
{
    $connectMySQL->query("UPDATE `diary_document` SET `PRACTICE_PLACE` = '$practice_place', `PRACTICE_PLACE_ADDRESS` = '$practice_place_address', `WORK_YEAR` = '$work_year', `PRACTICE_DEADLINES` = '$practice_deadlines', `STATUS` = '4' WHERE `STUDENT_ID` = '$student_id' AND `ORGANIZATION_CHIEF_ID` = " . $_SESSION['ID']);
}

//$result = shell_exec('python org_chief_update_document.py ' . escapeshellarg($src) . ' ' .  escapeshellarg($practice_place) . ' ' . escapeshellarg($practice_place_address) . ' ' . escapeshellarg($work_year) . ' ' . escapeshellarg($practice_deadlines) . ' ' . escapeshellarg($student_qualities) . ' ' . escapeshellarg($problem_solving_speed) . ' ' . escapeshellarg($work_amount) . ' ' . escapeshellarg($remarks) . ' ' . escapeshellarg($student_assessment));
header("Location: ../pages/documents.php");
?>
