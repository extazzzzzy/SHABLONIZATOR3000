<?php
session_start();
$_SESSION['id'] = 2;
/*if ($_SESSION['role'] != "admin") {
    header("Location: ../pages/profile.php");
    die;
}*/
echo $_GET['ID'];
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

foreach ($_POST['org_chiefs'] as $org_chief_fullname)
{

    $org_chief_id = $connectMySQL->query("SELECT id FROM `user` WHERE `fullname` = '$org_chief_fullname'")->fetch_assoc()['id'];

    $connectMySQL->query("UPDATE `diary_document` SET `ORGANIZATION_CHIEF_ID` = '$org_chief_id' WHERE `id` = " . $_GET['ID']);
}
header("Location: ../pages/documents.php");
?>

