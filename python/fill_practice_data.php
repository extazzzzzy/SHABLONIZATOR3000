<?php
session_start();
if ($_SESSION['ROLE'] != "org_chief")
{
    header("Location: ../pages/profile.php");
    die();
}
$diary_document_id = $_POST['document_id']; //

$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');


$words = ['отсутствуют'];
$result = $connectMySQL->query("SELECT *  FROM `diary_document`");

while ($row = $result->fetch_assoc())
{
    $random = $words[array_rand($words)];

    $connectMySQL->query("UPDATE `diary_document` SET `STATUS` = '7' WHERE `ID` = " . $row['ID']);

}


die();



$practice_place = $_POST['practice_place'];
if ($practice_place == "other") {
    $practice_place = $_POST['other_place'];
}
$practice_place_address = $_POST['practice_place_address'];
$work_year = $_POST['work_year'];
$practice_deadlines = $_POST['practice_deadlines'];
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
