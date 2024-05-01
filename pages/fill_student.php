<?php
session_start();
//ЭТОТ ФАЙЛ НУЖЕН ТОЛЬКО ДЛЯ ТЕСТА, ПОСЛЕ ПЕРЕНОСА В FILL.PHP ЭТОТ МОЖНО УДАЛИТЬ

$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

/*if (!isset($_SESSION['ID'])) {
header("Location: auth.php");
die();
}*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание документа</title>
    <style>
        body {
            font-family: Bahnschrift, sans-serif;
            background-color: rgba(120, 172, 227, 0.72);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        img {
            max-width: 300px;
            text-align: center;
        }
        h3 {
            color: #0a4d8c;
        }
        .container {
            background-color: #78ace3;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
        }
        h1 {
            color: #0a4d8c;
            text-align: center;
            margin-bottom: 10px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
            color: #0a4d8c;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .templates, .chiefs {
            color: #ffffff;
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            background-color: #0a4d8c;
            border-color: #0a4d8c;
            border-radius: 5px;
            border-style: solid;
            outline: none;
            font-size: 16px;
        }
        ::placeholder {
            color: #ffffff;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #0a4d8c;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: rgba(120, 172, 227, 0.72);
            color: #0a4d8c;
        }
        a {
            text-decoration: none;
            color: #004d8c;
            text-align: center;
            display: block;
            margin-top: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        button {
            background-color: #0a4d8c;
            border-style: none;
            border-radius: 5px;
            height: 40px;
            color: white;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: medium;
        }
        button:hover {
            background-color: #6A5ACD;
        }
        .usu_chief_list {
            width:300px;
            height:100px;
            overflow-x:hidden;
            border:solid 1px #78ace3;
        }
        ::-webkit-scrollbar {
            display: none;
        }
        select {
            background-color: #0a4d8c;
            border-style: none;
            border-radius: 5px;
            height: 40px;
            width: 300px;
            color: white;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: medium;
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <nav>
            <div><a href='documents.php'>Вернуться к списку документов</a></div>
            <div><a href='../php/logout.php'>Выход из аккаунта</a></div>
        </nav>
        <form action="../python/fill_student_data.php" method="post" enctype="multipart/form-data">
            <h3>Выберите руководителя от организации:</h3>
            <div class="org_chiefs_list">
                <select name="org_chief_fullname">
                    <?php
                    $org_chief_list = $connectMySQL->query("SELECT FULLNAME FROM `user` WHERE `ROLE` = 'org_chief'");
                    while ($row = $org_chief_list->fetch_assoc())
                    {
                        $usu_chief_fullname = $row['FULLNAME'];
                        echo "<option>" . $usu_chief_fullname . "</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" name="submit" value="Отправить данные">
        </form>
    </div>
</header>
</body>
</html>
