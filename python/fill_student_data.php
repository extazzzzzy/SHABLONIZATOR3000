<?php
session_start();
$_SESSION['id'] = 2;
/*if ($_SESSION['role'] != "student") {
    header("Location: ../pages/profile.php");
    die;
}*/

$diary_document_id = 22;//$_POST['student_group'];
$currentTimeMillis = round(microtime(true) * 1000);
$dateTime = date("Y-m-d H:i:s") . "." . sprintf("%03d", $currentTimeMillis % 1000);;

$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');
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


$target_file = $dateTime . ".csv";
$fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));

if($fileType == "csv")
{
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}
else
{
    echo "Выберите файл с расширением csv!";
}

$connectMySQL->query("UPDATE `diary_document` SET `STATUS` = '3', `SRC` = '" . "../documents/" . $target_file . "' WHERE `id` = '$diary_document_id'");

// создание первого документа через питон
$result = shell_exec('python student_create_document.py ' . escapeshellarg($dateTime) . ' ' .  escapeshellarg($PRACTICE_KIND_IMEN) . ' ' . escapeshellarg($PRACTICE_KIND_DAT) . ' ' . escapeshellarg($PRACTICE_KIND_VIN) . ' ' . escapeshellarg($STUDENT_COURSE) . ' ' . escapeshellarg($STUDENT_GROUP) . ' ' . escapeshellarg($STUDENT_FULLNAME_IMEN) . ' ' . escapeshellarg($STUDENT_FULLNAME_ROD) . ' ' . escapeshellarg($STUDENT_FULLNAME_DAT) . ' ' . escapeshellarg($INSTITUTE) . ' ' . escapeshellarg($PREPARATION_DIRECTION) . ' ' . escapeshellarg($USU_CHIEF_FULLNAME) . ' ' . escapeshellarg($USU_CHIEF_POSITION));

?>
