<?php
session_start();
if ($_SESSION['ROLE'] != "org_chief")
{
    header("Location: ../pages/profile.php");
    die;
}
$diary_document_id = $_POST['document_id'];
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

if ($connectMySQL->query("SELECT `STATUS` FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc()['STATUS'] != '4')
{
    header("Location: ../pages/documents.php");
    die();
}

$PRACTICE_PLACE = $_POST['PRACTICE_PLACE'];
if ($PRACTICE_PLACE == "other")
{
    $PRACTICE_PLACE = $_POST['other_place'];
}

$PRACTICE_DEADLINES = $_POST['PRACTICE_DEADLINES'];

$connectMySQL->query("UPDATE `diary_document` SET `PRACTICE_PLACE` = '$PRACTICE_PLACE', `PRACTICE_DEADLINES` = '$PRACTICE_DEADLINES', `STATUS` = '5' WHERE `id` = '$diary_document_id'");
$report_record = $connectMySQL->query("SELECT `STATUS` FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc();
header("Location: ../pages/documents.php");
die("monkey");
$STUDENT_GROUP = $report_record['STUDENT_GROUP'];
$STUDENT_COURSE = $report_record['STUDENT_COURSE'];
$PRACTICE_GROUP = $report_record['PRACTICE_GROUP'];
$PRACTICE_KIND = $report_record['PRACTICE_KIND'];
$PRACTICE_TYPE = $report_record['PRACTICE_TYPE'];
$CODE_AND_PREPARATION_DIRECTION = $report_record['CODE_AND_PREPARATION_DIRECTION'];
$ORDER_NUMBER_AND_DATE = $report_record['ORDER_NUMBER_AND_DATE'];
$YEAR = $report_record['YEAR'];
$REPORT_YEAR = $report_record['REPORT_YEAR'];

$SUCCESS_STUDENTS =  $connectMySQL->query("SELECT STUDENT_ID FROM `diary_document` WHERE `ASSESSMENT` <> 'неудовлетворительно' AND `STATUS` = '7' AND `STUDENT_GROUP` = " . $report_record['STUDENTS_GROUP'] . " AND `USU_CHIEF_ID` = " . $report_record['USU_CHIEF_ID'] . " AND `ORGANIZATION_CHIEF_ID` = " . $report_record['ORGANIZATION_CHIEF_ID'] . " AND `WEEK_NUMBER` = " . $report_record['WEEK_NUMBER']);

header("Location: ../pages/documents.php");
?>
