<?php
    session_start();
    $connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

    if (!isset($_SESSION['ID'])) {
    header("Location: auth.php");
    die();
    }

    function generate_document_list($connectMySQL) {
        ob_start(); // начало буферизации вывода
?>
<form action="../php/create_documents.php" method="post">
    <h3>Выберите шаблон для документа:</h3>
    <div class="document_list">
        <select>
        <?php //тут выводится список документов на отправку
            $doc_list = $connectMySQL->query("SELECT * FROM `template`");
            while ($row = $doc_list->fetch_assoc()) {
                $doc_name = $row['NAME'];
        ?>
            <option class='documents' value="<?php echo $doc_name; ?>"><?php echo $doc_name; ?></div>
        <?php
            }
        ?>
        </select>
    </div>
    <h3>Выберите руководителей ЮГУ, которым хотите отправить документ:</h3>
    <div class="chef_list">
        <?php //здесь список всех ЮГУшек, которым его можно отправить
            $usu_chief_list = $connectMySQL->query("SELECT * FROM `user` WHERE `ROLE` = 'usu_chief'");
            while ($row = $usu_chief_list->fetch_assoc()) {
                $usu_chief = $row['FULLNAME'];
        ?>
            <div class='chefs'><input type='checkbox' name='<?php echo $usu_chief; ?>' ><?php echo $usu_chief; ?></div>
        <?php
            }
        ?>
    </div>
    <h3>Выберите руководителей организации, которым хотите отправить документ:</h3>
    <div class="chef_list">
        <?php //здесь список всех ЮГУшек, которым его можно отправить
            $org_chief_list = $connectMySQL->query("SELECT * FROM `user` WHERE `ROLE` = 'org_chief'");
            while ($row = $org_chief_list->fetch_assoc()) {
                $org_chief = $row['FULLNAME'];
        ?>
            <div class='chefs'><input type='checkbox' name='<?php echo $org_chief; ?>' ><?php echo $org_chief; ?></div>
        <?php
            }
        ?>
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
        .documents, .chefs {
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
        .chef_list {
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
        <?php echo generate_document_list($connectMySQL); ?>
        </div>
    </header>
    <script>
        function pick_all() { //Хотел написать скрипт для кнопки, чтобы можно было выбрать сразу всех руков или снять галочки со всех
            document.getElementById('pick_all').innerHTML = "Убрать со всех";
            return 1;
        }
    </script>
</body>
</html>
