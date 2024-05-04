<?php
session_start();
if ($_SESSION['ROLE'] != "org_chief")
{
    header("Location: ../pages/profile.php");
    die;
}
$diary_document_id = $_GET['ID'];
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

if ($connectMySQL->query("SELECT STATUS FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc()['STATUS'] != '4')
{
    header("Location: ../pages/documents.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">

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
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .container1 {
            width: 400px;
            max-height: 500px;
            overflow-x: auto;
            scrollbar-width: none;
            text-align: center;
            justify-content: center;
            display: flex;
        }
        .container2 {
            width: calc(100% - 20px);
            height: 200px;
            text-align: center;
            display: flex;
            justify-content: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: calc(100% - 20px);
        }
        input[type="text"], input[type="password"], input[type="date"], select {
            color: #ffffff;
            width: 89%;
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
        input[type="submit"], button {
            width: 95%;
            padding: 10px;
            background-color: #0a4d8c;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 15px;
        }
        input[type="submit"]:hover, button:hover {
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
        select {
            background-color: #0a4d8c;
            border-style: none;
            border-radius: 5px;
            height: 40px;
            width: calc(100% - 20px);
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
<div class="container2">
    <nav>
        <a href='documents.php'>Вернуться к списку документов</a>
        <a href='../php/logout.php'>Выход из аккаунта</a>
    </nav>
</div>
<?php
if ($_SESSION['ROLE'] == 'org_chief')
{
    if ($connectMySQL->query("SELECT STATUS FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc()['STATUS'] != '4') {
        header("Location: documents.php");
        die();
    }
if ($connectMySQL->query("SELECT TEMPLATE_ID FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc()['TEMPLATE_ID'] == '1'){
?>
<div class="container1">
    <form action="../python/fill_org_chief_data.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <h2>В ходе выполнения практики продемонстрировал следующие качества:</h2>
            <div class="chefs"><button type="button" onclick="selectRandom()">Выбрать случайно</button></div>
            <br>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox1' value="пунктуальность"><label for='checkbox1'></label>пунктуальность</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox2' value="ответственность"><label for='checkbox2'></label>ответственность</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox3' value="целеустремлённость"><label for='checkbox3'></label>целеустремлённость</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox4' value="заинтересованность"><label for='checkbox4'></label>заинтересованность</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox5' value="трудолюбие"><label for='checkbox5'></label>трудолюбие</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox6' value="отзывчивость"><label for='checkbox6'></label>отзывчивость</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox7' value="эрудированность"><label for='checkbox7'></label>эрудированность</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox8' value="вежливость"><label for='checkbox8'></label>вежливость</div>
            <div class='chefs'><input type='checkbox' name='qualities[]' id='checkbox9' value="тактичность"><label for='checkbox9'></label>тактичность</div>

            <label for="problem_solving_speed">С возникающими при работе проблемами справлялся:</label>
            <select id="problem_solving_speed" name="problem_solving_speed">
                <option>оперативно</option>
                <option>легко</option>
                <option>с трудом</option>
                <option>быстро</option>
                <option>с небольшими затруднениями</option>
                <option>своевременно</option>
            </select>

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

            <input type="text" id="remarks" placeholder="Замечания(необязательно к заполнению)" name="remarks">

            <label for="assessment">Работа студента оценивается на:</label>
            <select id="assessment" name="assessment">
                <option name='assessment_1'>отлично</option>
                <option name='assessment_2'>хорошо</option>
                <option name='assessment_3'>удовлетворительно</option>
                <option name='assessment_4'>неудовлетворительно</option>
            </select>
            <input type="submit" value="Запустить документ" name="submit">
        <input type="hidden" name="document_id" value=<?php echo $_GET['ID'] ?>>
        </div>
</form>
</div>
<?php
}
elseif ($connectMySQL->query("SELECT TEMPLATE_ID FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc()['TEMPLATE_ID'] == '2'){
    ?>
<div class="container1">
        <form action="../python/fill_org_chief_data_report.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <select id="PRACTICE_PLACE" name="PRACTICE_PLACE" onchange="toggleInput()">
                    <option value="">Выберите место прохождения практики</option>
                    <option value="Югорский государственный университет">Югорский государственный университет</option>
                    <option value="Югорский научно-исследовательский институт информационных технологий">Югорский научно-исследовательский институт информационных технологий</option>
                    <option value="other">Нет нужного варианта</option>
                </select>
                <input type="text" id="other_place" name="other_place" placeholder="Введите другое место практики" style="display: none;">

                <h3>Сроки практики (с, по)</h3>
                <input required type="date" name = "practice_deadlines">
                <input required type="date" name = "practice_deadlines1">
                <input type="submit" value="Запустить документ" name="submit">
            <input type="hidden" name="document_id" value=<?php echo $_GET['ID'] ?>>
            </div>
</form>
</div>
<?php
}
}
?>
<script>
    function toggleInput() {
        var selectElement = document.getElementById("PRACTICE_PLACE");
        var otherPlaceInput = document.getElementById("other_place");

        if (selectElement.value === "other") {
            otherPlaceInput.style.display = "block";
            otherPlaceInput.setAttribute("required", "true");
        } else {
            otherPlaceInput.style.display = "none";
            otherPlaceInput.removeAttribute("required");
        }
    }
</script>
<script>
    function selectRandom() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"][name="qualities[]"]');
        var selectedIndexes = [];
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
        while (selectedIndexes.length < 3) {
            var randomIndex = Math.floor(Math.random() * checkboxes.length);
            if (!selectedIndexes.includes(randomIndex)) {
                selectedIndexes.push(randomIndex);
                checkboxes[randomIndex].checked = true;
            }
        }
    }
</script>
</body>
</html>
