<?php

$fullname = "Петров Петр Петрович";
$address = "г. Грозный, ул. Попкина 26, кв. 7";
$result = shell_exec('python main.py ' . escapeshellarg($fullname) . ' ' . escapeshellarg($address));

?>