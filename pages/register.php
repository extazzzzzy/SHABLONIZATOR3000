<?php
session_start();
if($_SESSION['ID'] != '')
{
    header("Location: profile.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">

    <title>Регистрация</title>
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
        h1 {
            color: #0a4d8c;
            text-align: center;
            margin-bottom: 10px;
        }
        .container {
            background-color: #78ace3;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
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
        }
        a {
            text-decoration: none;
            color: #004d8c;
            text-align: center;
            display: block;
            margin-top: 10px;
            font-size: 18px;
        }
        a:hover {
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
    <div class="logo">
        <img src="../images/SHABLON.png">
    </div>
    <h1>Регистрация</h1>
    <form action="../python/registration.php" method="post">
        <input type="text" minlength="15" id="FULLNAME" name="FULLNAME" placeholder="Введите ФИО" required>
        <input type="text" id="LOGIN" name="LOGIN" placeholder="Введите логин" required>
        <input type="password" maxlength="30" id="PASSWORD" name="PASSWORD" placeholder="Введите пароль" required>
        <input type="text" id="STUDENT_COURSE" name="STUDENT_COURSE" placeholder="Введите номер курса" required>
        <select id="STUDENT_GROUP" name="STUDENT_GROUP" required>
            <option value="">Выберите номер группы</option>
            <option value="1521б">1521б</option>
            <option value="1121б">1121б</option>
        </select>
        <select id="INSTITUTE" name="INSTITUTE" required>
            <option value="">Выберите название высшей школы</option>
            <option value="Инженерная школа цифровых технология">Инженерная школа цифровых технология</option>
        </select>
        <select id="PREPARATION_DIRECTION" name="PREPARATION_DIRECTION" required>
            <option value="">Введите направление подготовки</option>
            <option value="Программная инженерия">Программная инженерия</option>
            <option value="Программная инженерия">Информатика и вычислительная техника</option>
        </select>
        <input type="submit" name="submit" value="Отправить">
    </form>
    <a href="auth.php">Уже есть аккаунт</a>
</div>
</body>
</html>
