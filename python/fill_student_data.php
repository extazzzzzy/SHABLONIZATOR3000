<?php
session_start();
if ($_SESSION['ROLE'] != "student")
{
    header("Location: ../pages/profile.php");
    die;
}
$diary_document_id = $_POST['document_id'];
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

if ($connectMySQL->query("SELECT STATUS FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc()['STATUS'] != '3')
{
    header("Location: ../pages/profile.php");
    die();
}

$diary_record = $connectMySQL->query("SELECT * FROM `diary_document` WHERE `id` = '$diary_document_id'")->fetch_assoc();

$PRACTICE_KIND_IMEN = $diary_record['PRACTICE_KIND'];
$PRACTICE_KIND_DAT = $diary_record['PRACTICE_KIND_DAT'];
$PRACTICE_KIND_VIN = $diary_record['PRACTICE_KIND_VIN'];

$student_record = $connectMySQL->query("SELECT * FROM `user` WHERE `id` = " . $diary_record['STUDENT_ID'])->fetch_assoc();

$STUDENT_COURSE = $student_record['STUDENT_COURSE'];
$STUDENT_GROUP = $student_record['STUDENT_GROUP'];
$STUDENT_FULLNAME_IMEN = $student_record['FULLNAME'];
$STUDENT_FULLNAME_ROD = $student_record['FULLNAME_ROD'];
$STUDENT_FULLNAME_DAT = $student_record['FULLNAME_DAT'];
$INSTITUTE = $student_record['INSTITUTE'];
$PREPARATION_DIRECTION = $student_record['PREPARATION_DIRECTION'];

$usu_chief_record = $connectMySQL->query("SELECT * FROM `user` WHERE `id` = " . $diary_record['USU_CHIEF_ID'])->fetch_assoc();

$USU_CHIEF_FULLNAME = $usu_chief_record['FULLNAME'];
$USU_CHIEF_POSITION = $usu_chief_record['POSITION'];

$id = uniqid('diary_', true);
$target_file = $id . ".csv";

$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if($fileType == "csv")
{
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

$connectMySQL->query("UPDATE `diary_document` SET `STATUS` = '4', `SRC` = '" . "../documents/" . $id . ".docx' WHERE `id` = '$diary_document_id'");


$result = shell_exec('python student_create_document.py ' . escapeshellarg($id) . ' ' . escapeshellarg($PRACTICE_KIND_IMEN) . ' ' . escapeshellarg($PRACTICE_KIND_DAT) . ' ' . escapeshellarg($PRACTICE_KIND_VIN) . ' ' . escapeshellarg($STUDENT_COURSE) . ' ' . escapeshellarg($STUDENT_GROUP) . ' ' . escapeshellarg($STUDENT_FULLNAME_IMEN) . ' ' . escapeshellarg($STUDENT_FULLNAME_ROD) . ' ' . escapeshellarg($STUDENT_FULLNAME_DAT) . ' ' . escapeshellarg($INSTITUTE) . ' ' . escapeshellarg($PREPARATION_DIRECTION) . ' ' . escapeshellarg($USU_CHIEF_FULLNAME) . ' ' . escapeshellarg($USU_CHIEF_POSITION));

header("Location: ../pages/documents.php");
?>