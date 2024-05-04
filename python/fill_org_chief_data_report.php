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

$PRACTICE_DEADLINES = $_POST['practice_deadlines'];
$practice_deadlines1 = $_POST['practice_deadlines1'];
$PRACTICE_DEADLINES = "c " . $PRACTICE_DEADLINES . " по " . $practice_deadlines1;

$connectMySQL->query("UPDATE `diary_document` SET `PRACTICE_PLACE` = '$PRACTICE_PLACE', `PRACTICE_DEADLINES` = '$PRACTICE_DEADLINES', `STATUS` = '5' WHERE `id` = '$diary_document_id'");

$report_record = $connectMySQL->query("SELECT * FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc();
$usu_chief_record = $connectMySQL->query("SELECT * FROM `user` WHERE `id` = " . $report_record['USU_CHIEF_ID'])->fetch_assoc();
$org_chief_record = $connectMySQL->query("SELECT * FROM `user` WHERE `id` = " . $report_record['ORGANIZATION_CHIEF_ID'])->fetch_assoc();

$STUDENT_GROUP = $report_record['STUDENTS_GROUP'];
$STUDENT_COURSE = $report_record['STUDENTS_COURSE'];
$PRACTICE_GROUP = $report_record['PRACTICE_GROUP'];
$PRACTICE_KIND = $report_record['PRACTICE_KIND'];
$PRACTICE_TYPE = $report_record['PRACTICE_TYPE'];
$INSTITUTE = $report_record['INSTITUTE'];

$USU_CHIEF_FULLNAME = $usu_chief_record['FULLNAME'];
$ORGANIZATION_CHIEF_FULLNAME = $org_chief_record['FULLNAME'];

$name_file = uniqid('diary_', true) . ".docx";
$src = "../documents/" . $name_file;
$connectMySQL->query("UPDATE `diary_document` SET `SRC` = '$src' WHERE `id` = '$diary_document_id'");

$CODE_AND_PREPARATION_DIRECTION = $report_record['CODE_AND_PREPARATION_DIRECTION'];
$ORDER_NUMBER_AND_DATE = $report_record['ORDER_NUMBER_AND_DATE'];
$YEAR = $report_record['YEAR'];
$REPORT_YEAR = $report_record['REPORT_YEAR'];

$SUCCESS_STUDENTS_ID = $connectMySQL->query("SELECT `STUDENT_ID` FROM `diary_document` WHERE `STUDENT_ASSESSMENT` <> 'неудовлетворительно' AND `STATUS` = '7' AND `STUDENT_GROUP` = '" . $report_record['STUDENTS_GROUP'] . "' AND `USU_CHIEF_ID` = " . $report_record['USU_CHIEF_ID'] . " AND `ORGANIZATION_CHIEF_ID` = " . $report_record['ORGANIZATION_CHIEF_ID'] . " AND `WEEK_NUMBER` = " . $report_record['WEEK_NUMBER']);
$FAILURE_STUDENTS_ID =  $connectMySQL->query("SELECT `STUDENT_ID` FROM `diary_document` WHERE `STUDENT_ASSESSMENT` = 'неудовлетворительно' AND `STATUS` = '7' AND `STUDENT_GROUP` = '" . $report_record['STUDENTS_GROUP'] . "' AND `USU_CHIEF_ID` = " . $report_record['USU_CHIEF_ID'] . " AND `ORGANIZATION_CHIEF_ID` = " . $report_record['ORGANIZATION_CHIEF_ID'] . " AND `WEEK_NUMBER` = " . $report_record['WEEK_NUMBER']);

$SUCCESS_STUDENTS = [];
while($row = $SUCCESS_STUDENTS_ID->fetch_assoc())
{
    $SUCCESS_STUDENTS[] = $connectMySQL->query("SELECT `FULLNAME` FROM `user` WHERE `ID` = ".$row['STUDENT_ID'])->fetch_assoc()['FULLNAME'];
}
$FAILURE_STUDENTS = [];
while($row = $FAILURE_STUDENTS_ID->fetch_assoc())
{
    $FAILURE_STUDENTS[] = $connectMySQL->query("SELECT `FULLNAME` FROM `user` WHERE `ID` = ".$row['STUDENT_ID'])->fetch_assoc()['FULLNAME'];
}

$SUCCESS_STUDENTS = implode(',', $SUCCESS_STUDENTS);
$FAILURE_STUDENTS = implode(',', $FAILURE_STUDENTS);

$result = shell_exec('python create_report_document.py ' . escapeshellarg($src) . ' ' .  escapeshellarg($INSTITUTE) . ' ' . escapeshellarg($PRACTICE_KIND) . ' ' . escapeshellarg($PRACTICE_TYPE) . ' ' . escapeshellarg($YEAR) . ' ' . escapeshellarg($CODE_AND_PREPARATION_DIRECTION) . ' ' . escapeshellarg($STUDENT_COURSE) . ' ' . escapeshellarg($STUDENT_GROUP) . ' ' . escapeshellarg($REPORT_YEAR) . ' ' . escapeshellarg($PRACTICE_DEADLINES) . ' ' . escapeshellarg($ORDER_NUMBER_AND_DATE) . ' ' . escapeshellarg($SUCCESS_STUDENTS) . ' ' . escapeshellarg($FAILURE_STUDENTS) . ' ' . escapeshellarg($PRACTICE_PLACE) . ' ' . escapeshellarg($USU_CHIEF_FULLNAME) . ' ' . escapeshellarg($ORGANIZATION_CHIEF_FULLNAME));

header("Location: ../pages/documents.php");
?>
