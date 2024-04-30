<?php
session_start();
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

$ID = $_SESSION['ID'];
$result = $connectMySQL->query("SELECT * FROM user WHERE ID = '$ID'");
$FULLNAME = $connectMySQL->query("SELECT `FULLNAME` FROM `user` WHERE `ID` = '$ID'")->fetch_assoc()['FULLNAME'];
$LOGIN = $connectMySQL->query("SELECT `LOGIN` FROM `user` WHERE `ID` = '$ID'")->fetch_assoc()['LOGIN'];
$PASSWORD = $connectMySQL->query("SELECT `PASSWORD` FROM `user` WHERE `ID` = '$ID'")->fetch_assoc()['PASSWORD'];
$STUDENT_COURSE = $connectMySQL->query("SELECT `STUDENT_COURSE` FROM `user` WHERE `ID` = '$ID'")->fetch_assoc()['STUDENT_COURSE'];
$STUDENT_GROUP = $connectMySQL->query("SELECT `STUDENT_GROUP` FROM `user` WHERE `ID` = '$ID'")->fetch_assoc()['STUDENT_GROUP'];
$INSTITUTE = $connectMySQL->query("SELECT `INSTITUTE` FROM `user` WHERE `ID` = '$ID'")->fetch_assoc()['INSTITUTE'];
$PREPARATION_DIRECTION = $connectMySQL->query("SELECT `PREPARATION_DIRECTION` FROM `user` WHERE `ID` = '$ID'")->fetch_assoc()['PREPARATION_DIRECTION'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Профиль</title>
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
        .documents-link {
            display: inline-block;
            background-color: rgb(51, 136, 85);
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }

        .documents-link:hover {
            background-color: #78ace3;
        }
        .nav-button {
            background-color: rgb(51, 136, 85);
            font-weight: normal;
            font-size: medium;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="../images/SHABLON.png">
    </div>
    <div class="button-container">
        <a class="documents-link" href="documents.php">Список документов, доступных к заполнению</a>
    </div>
    <?php
    while ($row = $result->fetch_assoc()) {
        ?>
        <form action="../php/change_profile_info.php" method="post">
            <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
            <input type="text" minlength="15" id="FULLNAME" name="FULLNAME" value="<?php echo $FULLNAME; ?>" placeholder="Введите ФИО">
            <input type="text" id="LOGIN" name="LOGIN" value="<?php echo $LOGIN; ?>" placeholder="Введите логин">
            <input type="password" maxlength="30" id="PASSWORD" name="PASSWORD" value="<?php echo $PASSWORD; ?>" placeholder="Введите пароль">
            <input type="text" id="STUDENT_COURSE" name="STUDENT_COURSE" value="<?php echo $STUDENT_COURSE; ?>" placeholder="Введите номер курса">
            <input type="text" id="STUDENT_GROUP" name="STUDENT_GROUP" value="<?php echo $STUDENT_GROUP; ?>" placeholder="Введите номер группы">
            <input type="text" minlength="10" id="INSTITUTE" name="INSTITUTE" value="<?php echo $INSTITUTE; ?>" placeholder="Введите название Высшей школы">
            <input type="text" minlength="10" id="PREPARATION_DIRECTION" name="PREPARATION_DIRECTION" value="<?php echo $PREPARATION_DIRECTION; ?>" placeholder="Введите направление подготовки">
            <button type="submit">Изменить данные</button>
        </form>
            <form action="../php/logout.php">
                <button class="nav-button" type="submit">Выйти из аккаунта</button>
            </form>
        <?php
    }
    ?>
</div>
</body>
</html>
