<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        <input type="text" id="STUDENT_GROUP" name="STUDENT_GROUP" placeholder="Введите номер группы" required>
        <input type="text" minlength="10" id="INSTITUTE" name="INSTITUTE" placeholder="Введите название Высшей школы" required>
        <input type="text" minlength="10" id="PREPARATION_DIRECTION" name="PREPARATION_DIRECTION" placeholder="Введите направление подготовки" required>
        <input type="submit" name="submit" value="Отправить">
    </form>
    <a href="auth.php">Уже есть аккаунт</a>
</div>
</body>
</html>
