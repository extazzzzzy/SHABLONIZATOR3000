<?php
session_start();
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

if ($_SESSION['ROLE'] != "admin")
{
    header("Location: ../pages/profile.php");
    die;
}
function generate_document_list($connectMySQL) {
ob_start(); // начало буферизации вывода
?>
<form action="../php/create_org_chief.php" method="post">
    <h2>Выберите руководителя от организации:</h2>
    <div class="container4">
        <select name="org_chief">
        <?php
        $org_chief_list = $connectMySQL->query("SELECT * FROM `user` WHERE `ROLE` = 'org_chief'");
        while ($row = $org_chief_list->fetch_assoc()) {
            $org_chief = $row['FULLNAME'];
            ?>
            <div class='chefs'><option value="<?php echo $org_chief ?>"><?php echo $org_chief; ?></div>
            <?php
        }
        ?>
        </select>
    </div>
    <br>
    <input type="submit" name="submit" value="Отправить документы">
    <input type="hidden" name="document_id" value=<?php echo $_GET['ID'] ?>>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
    }
    ?>
</form>


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
            display: block;
            justify-content: center;
            align-content: center;
        }
        img {
            max-width: 300px;
            text-align: center;
        }
        input[type="text"]::placeholder,
        select {
            color: #ffffff;
        }

        input[type="text"]:hover {
            background-color: rgba(120, 172, 227, 0.72);
            color: #0a4d8c;
        }

        img {
            max-width: 300px;
            text-align: center;
        }
        h3 {
            color: #0a4d8c;
            font-weight: normal;
            font-size: medium;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        .chefs {
            color: #ffffff;
            width: calc(100% - 30px);
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
        button {
            background-color: #0a4d8c;
            border-style: none;
            border-radius: 5px;
            height: 50px;
            color: white;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 18px;
        }
        button:hover {
            background-color: #6A5ACD;
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
        .container {
            background-color: #78ace3;
            width: 400px;
            text-align: center;
            padding: 10px;
            margin: 0 auto;
            border-radius: 5px;
            font-weight: bold;
            font-size: 18px;
        }
        .container4 {
            width: 400px;
            height: 50px;
            overflow: auto;
            scrollbar-width: none;
            font-weight: bold;
            font-size: 18px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
        input[type="text"], input[type="password"], select {
            transition: background-color 0.3s ease;
            color: #ffffff;
            width: 100%;
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
            height: 40px;
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
        }
        a:hover {
            text-decoration: underline;
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
        h1 {
            color: #0a4d8c;
            text-align: center;
            margin-bottom: 10px;
        }
        h2 {
            color: #0a4d8c;
            text-align: center;
            font-size: large;
        }
        label {
            color: #0a4d8c;
            font-size: medium;
            font-weight: bold;
            margin-bottom: 10px;
        }
        img {
            max-width: 300px;
            text-align: center;
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
        <?php echo generate_document_list($connectMySQL);?>
    </div>
</header>
<script>
    function pick_all()
    {
//Хотел написать скрипт для кнопки, чтобы можно было выбрать сразу всех руков или снять галочки со всех
        document.getElementById('pick_all').innerHTML = "Убрать со всех";
        return 1;
    }
</script>
</body>
</html>