<?php
    $connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

    $template_id = 1;//$_POST["temp_id"];

    $count = $connectMySQL->query("SELECT COUNT(*) FROM `user`");
    $count_usu_chief = $count -> fetch_row();
    $chief_count = $count_usu_chief[0];

    $chief_list = $connectMySQL->query("SELECT ID FROM `user` WHERE `ROLE` = 'usu_chief'");
    while ($row = $chief_list->fetch_assoc()) {
        $chief_id = $row['ID'];
        $connectMySQL->query("INSERT INTO `diary_document` (`TEMPLATE_ID`, `USU_CHIEF_ID`) VALUES ('$template_id', '$chief_id')");
    }
?>