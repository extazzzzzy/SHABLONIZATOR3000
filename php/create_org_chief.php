<?php
session_start();
if ($_SESSION['ROLE'] != "admin") {
    header("Location: ../pages/profile.php");
    die;
}

$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

$org_chief_fullname = $_POST['org_chief'];
$org_chief_id = $connectMySQL->query("SELECT * FROM `user` WHERE `FULLNAME` = '$org_chief_fullname'")->fetch_assoc()['ID'];

$document_id = $_POST['document_id'];
$connectMySQL->query("UPDATE `diary_document` SET `ORGANIZATION_CHIEF_ID` = '$org_chief_id', `STATUS` = '2' WHERE `id` = '$document_id'");

header("Location: ../pages/documents.php");
?>

