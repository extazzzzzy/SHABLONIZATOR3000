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
            flex-direction: column;
        }
        .chefs {
            color: #ffffff;
            width: calc(100% - 40px);
            padding: 10px;
            margin-bottom: 10px;
            background-color: #0a4d8c;
            border-color: #0a4d8c;
            border-radius: 5px;
            border-style: solid;
            outline: none;
            font-size: 16px;
        }
        .container {
            background-color: #78ace3;
            width: 400px;
            text-align: center;
            padding: 10px;
        }
        .container1 {
            width: 500px;
            height: 600px;
            overflow-x: auto;
            scrollbar-width: none;
            text-align: center;
            justify-content: center;
        }
        .container2 {
            width: calc(100% - 20px);
            height: 200px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: calc(100% - 20px);
        }
        input[type="text"], input[type="password"], select {
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
<div class="container2">
    <nav>
        <a href='documents.php'>Вернуться к списку документов</a>
        <a href='../php/logout.php'>Выход из аккаунта</a>
    </nav>
</div>
<div class="container1">
    <form action="../python/fill_org_chief_data.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <input type="text" id="practice_place" name="practice_place" placeholder="Место практики" required>
        </div>
        <div class="container">
            <input type="text" id="practice_place_address" name="practice_place_address" placeholder="Адрес места практики" required>
        </div>
        <div class="container">
            <input type="text" id="work_year" name="work_year" placeholder="Год работы" required>
        </div>
        <div class="container">
            <input type="text" id="practice_deadlines" name="practice_deadlines" placeholder="Сроки практики" required>
        </div>
        <div class="container">
            <h2>В ходе выполнения практики продемонстрировал следующие качества:</h2>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox1'><label for='checkbox1'></label>пунктуальность</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox2'><label for='checkbox2'></label>ответственность</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox3'><label for='checkbox3'></label>целеустремлённость</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox4'><label for='checkbox4'></label>заинтересованность</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox5'><label for='checkbox5'></label>трудолюбие</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox6'><label for='checkbox6'></label>отзывчивость</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox7'><label for='checkbox7'></label>эрудированность</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox8'><label for='checkbox8'></label>вежливость</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox9'><label for='checkbox9'></label>тактичность</div>
        </div>

        <div class="container">
            <label for="problem_solving_speed">С возникающими при работе проблемами справлялся:</label>
            <select id="problem_solving_speed" name="problem_solving_speed">
                <option>оперативно</option>
                <option>легко</option>
                <option>с трудом</option>
                <option>быстро</option>
                <option>с небольшими затруднениями</option>
                <option>своевременно</option>
            </select>
        </div>

        <div class="container">
            <label for="work_amount">Индивидуальное задание, предусмотренное программой практики, выполнено:</label>
            <select id="work_amount" name="work_amount">
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
            <input type="text" id="remarks" placeholder="Замечания" name="remarks">
        </div>

        <div class="container">
            <label for="assessment">Работа студента оценивается на:</label>
            <select id="assessment" name="assessment">
                <option name='assessment_1'>отлично</option>
                <option name='assessment_2'>хорошо</option>
                <option name='assessment_3'>удовлетворительно</option>
                <option name='assessment_4'>неудовлетворительно</option>
            </select>
        </div>
        <div class="container">
            <input type="submit" value="Запустить документ" name="submit">
        </div>
</div>
</form>
</div>
</body>
</html>
