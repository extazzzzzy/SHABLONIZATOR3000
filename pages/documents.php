<?php
    session_start();
    $connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

    if (!isset($_SESSION['ID'])) {
    header("Location: auth.php");
    die();
    }

    function generate_document_table($connectMySQL) {
    ob_start(); // начало буферизации вывода
?>
<div class="table_orders">
<table>
    <thead>
        <tr>
        <th>№ документа</th>
        <th>Название документа</th>
        <th>ФИО студента</th>
        <th>ФИО руководителя от ЮГУ</th>
        <th>ФИО руководителя от предприятия</th>
        <th>Место проведения </th>
        <th>Дата обращения</th>
        <th>Комментарий</th>
        <th>Принять документ</th>
        <tr>
    </thead>
    <tbody>
    <?php
        $doc_list = $connectMySQL->query("SELECT * FROM `diary_document`");
        while ($row = $doc_list->fetch_assoc()) {
        $doc_numb = $row['ID'];
        $doc_name = $row['NAME'];
        $student = $connectMySQL->query("SELECT `FULLNAME` FROM `user` WHERE `ID` = ". $row['STUDENT_ID'])->fetch_assoc()['FULLNAME'];
        $usu_chief = $connectMySQL->query("SELECT `FULLNAME` FROM `user`
        WHERE `ID` = ". $row['USU_CHIEF_ID'])->fetch_assoc()['FULLNAME'];
        $org_chief = $connectMySQL->query("SELECT `FULLNAME` FROM `user` WHERE `ID` = ". $row['ORGANISATION_CHIEF_ID'])->fetch_assoc()['FULLNAME'];
        $practice_place = $row['PRACTICE_PLACE'];
        $timestamp = $row['TIMESTAMP'];
        $comments = $row['COMMENT'];
    ?>
    <tr>
    <td><?php echo $doc_numb; ?><input type='text' hidden value='<? echo $doc_numbS?>'></td>
    <td><?php echo $doc_name; ?></td>
    <td><?php echo $student; ?></td>
    <td><?php echo $usu_chief; ?></td>
    <td><?php echo $org_chief; ?></td>
    <td><?php echo $practice_place; ?></td>
    <td><?php echo $timestamp; ?></td>
    <td><?php echo $comments; ?></td>
    <td><button>Принять</button><button>Отклонить</button></td>
    <tr>
<?php
}
?>
    </tbody>
</table>
</div>
<?php
    $output = ob_get_contents(); // сохраняем буфер
    ob_end_clean(); // очищаем буфер
    return $output; // возвращаем содержимое буфера
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Принятие документов</title>
    <style>
        body {
            font-family: Bahnschrift, sans-serif;
            background-color: rgba(120, 172, 227, 0.72);
            margin: 0;
            padding: 0;
            display: flex;
            /*justify-content: center;
            align-items: center;*/
            height: 100vh;
        }
        h1 {
            color: #0a4d8c;
            text-align: center;
            margin-bottom: 10px;
        }
        /*a {
            text-decoration: none;
            color: #004d8c;
            display: block;
        }
        a:hover {
            text-decoration: underline;
        }*/
        button {
            background-color: #0a4d8c;
            border-style: none;
            border-radius: 5px;
            height: 40px;
            color: white;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            font-size: medium;
        }
        button:hover {
            background-color: #78ace3;
        }
        table {
            border-collapse: collapse;
            width: 110%;
            margin-bottom: 20px;
            margin-top: 50px;
            margin-left: -170px;
        }

        th, td {
            border: 2px solid #1E90FF;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #7FFFD4;
        }

        tr:nth-child(even) {
            background-color: #00FFFF;
        }

        tr:hover {
            background-color: #00FFFF;
        }   
    </style>
</head>
<body>
    <header>
        <div class="container">
        <nav>
            <a href='pick_template.php'>Создать документ</a>
            <a href='profile.php'>Профиль</a>
            <a href='../php/logout.php'>Выход из аккаунта</a>
        </nav>
        </div>
    </header>
    <?php echo generate_document_table($connectMySQL); ?>
</body>
</html>