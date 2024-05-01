<?php
session_start();
$_SESSION['id'] = 2;
/*if ($_SESSION['role'] != "student") {
    header("Location: ../pages/profile.php");
    die;
}*/
$diary_document_id = 31;//$_POST['student_group'];

$practice_place = $_POST['practice_place'];
$practice_place_address = $_POST['practice_place_address'];
$work_year = $_POST['work_year'];
$practice_deadlines = $_POST['practice_deadlines'];
if (isset($_POST['qualities']))
{
    $student_qualities = implode(', ', $_POST['qualities']);
}
else
{
    $student_qualities = "никаких";
}
$problem_solving_speed = $_POST['problem_solving_speed'];
$work_amount = $_POST['work_amount'];
$remarks = $_POST['remarks'];
$student_assessment = $_POST['assessment'];


$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

$connectMySQL->query("UPDATE `diary_document` SET `STUDENT_QUALITIES` = '$student_qualities', `PROBLEM_SOLVING_SPEED` = '$problem_solving_speed', `WORK_AMOUNT` = '$work_amount', `WORK_YEAR` = '$work_year', `REMARKS` = '$remarks', `STUDENT_ASSESSMENT` = '12', `PRACTICE_PLACE` = '$practice_place', `PRACTICE_PLACE_ADDRESS` = '$practice_place_address', `PRACTICE_DEADLINES` = '$practice_deadlines', `STATUS` = '4' WHERE `ID` = $diary_document_id");

$src = $connectMySQL->query("SELECT SRC FROM `diary_document` WHERE `id` = '$diary_document_id'")->fetch_assoc()['SRC'];

// внесение недостающих данных в документ через питон и повторное сохранение уже существующего документа
$result = shell_exec('python org_chief_update_document.py ' . escapeshellarg($src) . ' ' .  escapeshellarg($practice_place) . ' ' . escapeshellarg($practice_place_address) . ' ' . escapeshellarg($work_year) . ' ' . escapeshellarg($practice_deadlines) . ' ' . escapeshellarg($student_qualities) . ' ' . escapeshellarg($problem_solving_speed) . ' ' . escapeshellarg($work_amount) . ' ' . escapeshellarg($remarks) . ' ' . escapeshellarg($student_assessment));
?>
