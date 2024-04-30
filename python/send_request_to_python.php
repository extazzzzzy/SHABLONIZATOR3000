<?php

$PRACTICE_PLACE = "Югорский государственный университет";
$PRACTICE_PLACE_ADDRESS = "г. Ханты-Мансийск, ул. Чехова 16";
$STUDENT_COURSE = "2";
$STUDENT_GROUP = "1521б";
$STUDENT_FULLNAME_IMEN = "Коваль Данил Вячеславович";
$PRACTICE_KIND_IMEN = "Научная";

$ORGANIZATION_CHIEF_FULLNAME = "Змеев Денис Олегович";
$ORGANIZATION_CHIEF_POSITION = "Профессор";
$USU_CHIEF_FULLNAME = "Самарина Ольга Владимировна";
$USU_CHIEF_POSITION = "Доцент";
$COMPANY_CHIEF_POSITION = "Кандидат наук";

$INSTITUTE = "ИШЦТ";
$PRACTICE_DEADLINES = "с 22 апреля 2024 года по 4 мая 2024 года";
$WORK_YEAR = "2024";
$PREPARATION_DIRECTION = "Программная инженерия";
$STUDENT_QUALITIES = "Целеустремлённость, стрессоустойчивость";
$PROBLEM_SOLVING_SPEED = "Быстро";
$WORK_AMOUNT = "в полном объёме";
$REMARKS1 = "Замечаний нет";
$STUDENT_ASSESSMENT = "5";
$result = shell_exec('python main.py ' . escapeshellarg($PRACTICE_PLACE) . ' ' . escapeshellarg($PRACTICE_PLACE_ADDRESS) . ' ' . escapeshellarg($STUDENT_COURSE) . ' ' . escapeshellarg($STUDENT_GROUP) . ' ' . escapeshellarg($STUDENT_FULLNAME_IMEN) . ' ' . escapeshellarg($PRACTICE_KIND_IMEN) . ' ' . escapeshellarg($ORGANIZATION_CHIEF_FULLNAME) . ' ' . escapeshellarg($ORGANIZATION_CHIEF_POSITION) . ' ' . escapeshellarg($USU_CHIEF_FULLNAME) . ' ' . escapeshellarg($USU_CHIEF_POSITION) . ' ' . escapeshellarg($COMPANY_CHIEF_POSITION) . ' ' . escapeshellarg($INSTITUTE) . ' ' . escapeshellarg($PRACTICE_DEADLINES) . ' ' . escapeshellarg($WORK_YEAR) . ' ' . escapeshellarg($PREPARATION_DIRECTION) . ' ' .escapeshellarg($STUDENT_QUALITIES) . ' ' . escapeshellarg($PROBLEM_SOLVING_SPEED) . ' ' . escapeshellarg($WORK_AMOUNT) . ' ' . escapeshellarg($REMARKS1) . ' ' . escapeshellarg($STUDENT_ASSESSMENT));

?>

<!--PRACTICE_PLACE - место практики в именительном падеже
PRACTICE_PLACE_PRED - место практики в предложном падеже

PRACTICE_PLACE_ADDRESS - адрес места практики
STUDENT_COURSE - курс студента
STUDENT_GROUP - группа студента

STUDENT_FULLNAME_ROD - фио студента в родительном падеже
STUDENT_FULLNAME_IMEN - фио студента в именительном падеже
STUDENT_FULLNAME_DAT - фио студента в дательном падеже

PRACTICE_KIND_IMEN - вид практики в именительном падеже
PRACTICE_KIND_DAT - вид практики в дательном падеже
PRACTICE_KIND_VIN - вид практики в винительном падеже

ORGANIZATION_CHIEF_FULLNAME - руководитель практики от предприятия
ORGANIZATION_CHIEF_POSITION - должность руководителя практики от предприятия
USU_CHIEF_FULLNAME - руководитель практики от ЮГУ
USU_CHIEF_POSITION - должность руководителя практики от ЮГУ
INSTITUTE - название института
PRACTICE_DEADLINES - сроки практики(ДОЛЖНО БЫТЬ В ТАКОМ ФОРМАТЕ: с ДД месяц ГГГГ года по ДД месяц ГГГГ года)
YEAR_WORK - год выполнения работы
DIRECTION_OF_PREPARATION - направление подготовки
STUDENT_QUALITIES - качества студента
SPEED_OF_PROBLEM_SOLVING - скорость решения проблем
AMOUNT_OF_WORK - объём выполненной работы
OTHER_REMARKS - замечания к работе
STUDENT_ASSESSMENT - оценка работы-->
