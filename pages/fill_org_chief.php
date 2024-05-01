<?php
session_start();
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
            padding: 20px;
            width: 300px;
            height: 300px;
            overflow: auto;
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
        .document_list, .chef_list {
            width:300px;
            height:100px;
            overflow-x:hidden;
            border:solid 1px #78ace3;
        }
        ::-webkit-scrollbar {
            display: none;
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
    </div>
</header>

<form action="../python/fill_org_chief_data.php" method="post" enctype="multipart/form-data">
    <div>
        Место практики
        <input type="text" name = "practice_place">
    </div>
    <div>
        Адрес места практики
        <input type="text" name = "practice_place_address">
    </div>
    <div>
        Год работы
        <input type="text" name = "work_year">
    </div>
    <div>
        Сроки практики
        <input type="text" name = "practice_deadlines">
    </div>
    <div class="container">
        <p>В ходе выполнения практики продемонстрировал следующие качества:</p>
        <div class='documents'><input type='checkbox' name='qualities[]' value='пунктуальность'>пунктуальность</div>
        <div class='documents'><input type='checkbox' name='qualities[]' value='ответственность'>ответственность</div>
        <div class='documents'><input type='checkbox' name='qualities[]' value='целеустремлённость'>целеустремлённость</div>
        <div class='documents'><input type='checkbox' name='qualities[]' value='заинтересованность'>заинтересованность</div>
        <div class='documents'><input type='checkbox' name='qualities[]' value='трудолюбие'>трудолюбие</div>
        <div class='documents'><input type='checkbox' name='qualities[]' value='отзывчивость'>отзывчивость</div>
        <div class='documents'><input type='checkbox' name='qualities[]' value='эрудированность'>эрудированность</div>
        <div class='documents'><input type='checkbox' name='qualities[]' value='вежливость'>вежливость</div>
        <div class='documents'><input type='checkbox' name='qualities[]' value='тактичность'>тактичность</div>
    </div>

    <div class="container">
        <p>С возникающими при работе проблемами справлялся:</p>
        <select name = "problem_solving_speed">
            <option>оперативно</option>
            <option>легко</option>
            <option>с трудом</option>
            <option>быстро</option>
            <option>с небольшими затруднениями</option>
            <option>своевременно</option>
        </select>
    </div>

    <div class="container">
        <p>Индивидуальное задание, предусмотренное программой практики, выполнено:</p>
        <select name = "work_amount">
            <option>частично</option>
            <option>в полном объеме</option>
            <option>успешно</option>
            <option>безупречно</option>
            <option>удовлетворительно</option>
            <option>в минимальном объёме</option>
            <option>неудовлетворительно</option>
            <option>безнадёжно</option>
            <option>плачевно</option>
            <option>жалко</option>
        </select>
    </div>

    <div class="container">
        <p>Замечания</p>
        <input type="text" name="remarks">
    </div>


    <div class="container">
        <p>Работа студента оценивается на:</p>
        <select name="assessment">
            <option name='assessment_1'>отлично</option>
            <option name='assessment_2'>хорошо</option>
            <option name='assessment_3'>удовлетворительно</option>
            <option name='assessment_4'>неудовлетворительно</option>
        </select>
    </div>
    <input type="submit" value="ЗАПУСК!!!" name="submit">
</form>

</body>
</html>