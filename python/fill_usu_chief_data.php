<?php
session_start();
if ($_SESSION['ROLE'] != "usu_chief")
{
    header("Location: ../pages/profile.php");
    die;
}
$diary_document_id = $_POST['document_id'];
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

$student_group = $_POST['student_group'];
$practice_kind = $_POST['practice_kind'];

$result = shell_exec('python practice_kind_variations.py ' . escapeshellarg($practice_kind));
$output = json_decode($result, true);
$practice_kind_dat = $output["PRACTICE_KIND_DAT"];
$practice_kind_vin = $output["PRACTICE_KIND_VIN"];

$students_result = $connectMySQL->query("SELECT id FROM `user` WHERE `role` = 'student' AND `STUDENT_GROUP` = '$student_group'");
if ($students_result)
{
    $diary_record = $connectMySQL->query("SELECT * FROM `diary_document` WHERE `id` = '$diary_document_id'")->fetch_assoc();
    $connectMySQL->query("DELETE FROM `diary_document` WHERE `id` = '$diary_document_id'");
    while ($row = $students_result->fetch_assoc())
    {
        $connectMySQL->query("INSERT INTO `diary_document` (`TEMPLATE_ID`, `STUDENT_GROUP`, `PRACTICE_KIND`, `PRACTICE_KIND_DAT`, `PRACTICE_KIND_VIN`, `STUDENT_ID`, `USU_CHIEF_ID`, `STATUS`, `TIMESTAMP`) VALUES (" .
            $diary_record['TEMPLATE_ID'] . ", '$student_group', '$practice_kind', '$practice_kind_dat', '$practice_kind_vin', " . $row['id'] . ", " . $diary_record['USU_CHIEF_ID'] . ", '2', CURRENT_TIMESTAMP)");
    }
    header("Location: ../pages/documents.php");
}
else
{
    echo "Студентов данной группы не найдено!";
}

?>
