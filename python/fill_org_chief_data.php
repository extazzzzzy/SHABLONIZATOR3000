<?php
session_start();
if ($_SESSION['ROLE'] != "org_chief")
{
    header("Location: ../pages/profile.php");
    die;
}
$diary_document_id = $_POST['document_id'];
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

if ($connectMySQL->query("SELECT STATUS FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc()['STATUS'] != '4')
{
    header("Location: ../pages/documents.php");
    die();
}

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

$connectMySQL->query("UPDATE `diary_document` SET `STUDENT_QUALITIES` = '$student_qualities', `PROBLEM_SOLVING_SPEED` = '$problem_solving_speed', `WORK_AMOUNT` = '$work_amount', `REMARKS` = '$remarks', `STUDENT_ASSESSMENT` = '$student_assessment', `STATUS` = '5' WHERE `ID` = $diary_document_id");
$src = $connectMySQL->query("SELECT SRC FROM `diary_document` WHERE `id` = '$diary_document_id'")->fetch_assoc()['SRC'];

//$result = shell_exec('python org_chief_update_document.py ' . escapeshellarg($src) . ' ' .  escapeshellarg($practice_place) . ' ' . escapeshellarg($practice_place_address) . ' ' . escapeshellarg($work_year) . ' ' . escapeshellarg($practice_deadlines) . ' ' . escapeshellarg($student_qualities) . ' ' . escapeshellarg($problem_solving_speed) . ' ' . escapeshellarg($work_amount) . ' ' . escapeshellarg($remarks) . ' ' . escapeshellarg($student_assessment));
header("Location: ../pages/documents.php");
?>
