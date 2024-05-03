<?php
session_start();
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

if (!isset($_SESSION['ID'])) {
    header("Location: auth.php");
    die();
}
if ($_SESSION['ROLE'] != "admin")
{
    header("Location: ../pages/profile.php");
    die;
}

function generate_document_list($connectMySQL) {
ob_start(); // начало буферизации вывода
?>
<form action="../php/create_new_record.php" method="post">
    <h3>Выберите шаблон для документа:</h3>
        <select name = "template_name">
            <?php //тут выводится список шаблонов документа на отправку
            $template_list = $connectMySQL->query("SELECT * FROM `template`");
            while ($row = $template_list->fetch_assoc()) {
            $doc_name = $row['NAME'];
            ?>
                <option class='templates' value="<?php echo $doc_name; ?>"><?php echo $doc_name; ?></option>
    <?php
    }
    ?>
    </select>
    <h3>Выберите руководителей ЮГУ, которым хотите отправить документ:</h3>
    <div class="students_list">
        <div class="students"><input type="checkbox" id="select-all">Выбрать всех</div>
        <?php //здесь список всех ЮГУшек, которым его можно отправить
        $usu_chief_list = $connectMySQL->query("SELECT * FROM `user` WHERE `ROLE` = 'usu_chief'");
        while ($row = $usu_chief_list->fetch_assoc()) {
            $usu_chief = $row['FULLNAME'];
            ?>
            <div class='students'><input type='checkbox' name="usu_chiefs[]" value="<?php echo $usu_chief; ?>"><?php echo $usu_chief; ?></div>
            <?php
        }
        ?>
    </div>
    <br>
    <div class="container4">
        <select id="WEEK_NUMBER" name="WEEK_NUMBER" required>
            <option value="">Выберите неделю практики</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
    </div>
    <input type="submit" name="submit" value="Отправить документы">
    <?php
    $output = ob_get_contents(); // сохраняем буфер
    ob_end_clean(); // очищаем буфер
    return $output; // возвращаем содержимое буфера
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
        .students_list
        {
            overflow: auto;
            height: 150px;
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
        .students {
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
    document.addEventListener("DOMContentLoaded", function() {
        var selectAllCheckbox = document.getElementById('select-all');
        var otherCheckboxes = document.querySelectorAll('.students_list input[type="checkbox"]:not(#select-all)');
        function updateSelectAllCheckbox() {
            var allChecked = true;
            for (var i = 0; i < otherCheckboxes.length; i++) {
                if (!otherCheckboxes[i].checked) {
                    allChecked = false;
                    break;
                }
            }
            selectAllCheckbox.checked = allChecked;
        }
        for (var i = 0; i < otherCheckboxes.length; i++) {
            otherCheckboxes[i].addEventListener('change', function() {
                updateSelectAllCheckbox();
            });
        }
        selectAllCheckbox.addEventListener('change', function() {
            for (var i = 0; i < otherCheckboxes.length; i++) {
                otherCheckboxes[i].checked = this.checked;
            }
        });
    });
</script>
</body>
</html>