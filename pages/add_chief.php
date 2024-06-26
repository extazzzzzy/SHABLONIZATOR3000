<?php
session_start();
if($_SESSION['ID'] == '')
{
    header("Location: auth.php");
}
else if ($_SESSION['ROLE'] != 'admin') {
    header("Location: profile.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">

    <title>Добавление руководителя</title>
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
            text-align: center;
            max-height: 700px;
            overflow: auto;
            scrollbar-width: none;
        }
        h1 {
            color: #0a4d8c;
            text-align: center;
            margin-bottom: 10px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="password"] {
            color: #ffffff;
            width: calc(100% - 25px);
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
            background-color: #0a4d8c;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: rgba(120, 172, 227, 0.72);
            color: #0a4d8c;
            font-size: 16px;
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
        ::-webkit-scrollbar
        {
            display: none;
        }
        nav {
            margin-bottom: 10px;
        }
        nav a {
            margin-top: 10px;
            background-color: rgb(51, 136, 85);
            color: #ffffff;
            padding: 10px 40px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }
        nav a:hover {
            background-color: rgba(120, 172, 227, 0.72);
            text-decoration: underline;
        }
        select {
            background-color: #0a4d8c;
            border-style: none;
            border-radius: 5px;
            height: 40px;
            width: 100%;
            color: white;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: medium;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <nav>
        <a href='documents.php'>Вернуться к списку документов</a>
        <a href='../php/logout.php'>Выход из аккаунта</a>
    </nav>
    <h3>Регистрация руководителя</h3>
    <form action="../php/registration_chief.php" method="post">
        <input type="text" minlength="15" id="FULLNAME" name="FULLNAME" placeholder="Введите ФИО" required>
        <input type="text" id="LOGIN" name="LOGIN" placeholder="Введите логин" required>
        <input type="password" maxlength="30" id="PASSWORD" name="PASSWORD" placeholder="Введите пароль" required>
        <select id="ROLE" name="ROLE" required>Выберите руководителя
            <option name="ROLE1" value="org_chief">Руководитель от организации</option>
            <option name="ROLE2" value="usu_chief">Руководитель от ЮГУ</option>
        </select>
        <input type="text" id="POSITION" name="POSITION" placeholder="Введите должность" required>
        <input type="submit" name="submit" value="Отправить">
    </form>
</div>
</body>
</html>
