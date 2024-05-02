<?php
session_start();
if ($_SESSION['ROLE'] != "admin")
{
    header("Location: ../pages/profile.php");
    die;
}

$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

$template_name = $_POST['template_name'];
$template_id = $connectMySQL->query("SELECT * FROM `template` WHERE `name` = '$template_name'")->fetch_assoc()['ID'];

foreach ($_POST['usu_chiefs'] as $usu_chief_fullname)
{

    $usu_chief_id = $connectMySQL->query("SELECT id FROM `user` WHERE `fullname` = '$usu_chief_fullname'")->fetch_assoc()['id'];

    $connectMySQL->query("INSERT INTO `diary_document` (`TEMPLATE_ID`, `USU_CHIEF_ID`) VALUES ('$template_id', '$usu_chief_id')");
}
header("Location: ../pages/documents.php");
?>

