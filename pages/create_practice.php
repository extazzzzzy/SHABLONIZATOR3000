<?php
session_start();
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

if (!isset($_SESSION['ID'])) {
    header("Location: auth.php");
    die();
}
if($_SESSION['ROLE'] != 'org_chief')
{
    header("Location: profile.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Информация о документе</title>
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
<div class="container">
        <nav>
            <div><a href='documents.php'>Вернуться к списку документов</a></div>
            <div><a href='../php/logout.php'>Выход из аккаунта</a></div>
        </nav>
    <h3>Информация о документе</h3>
    <form action="../python/fill_practice_data.php" method="post">
        <select id="practice_place" required name="practice_place" onchange="toggleInput()">
            <option value="">Выберите место практики</option>
            <option value="Югорский государственный университет">Югорский государственный университет</option>
            <option value="Югорский  научно-исследовательский институт информационных технологий">Югорский  научно-исследовательский институт информационных технологий</option>
            <option value="other">Нет нужного варианта</option>
        </select>
        <input type="text" id="other_place" name="other_place" placeholder="Введите другое место практики" style="display: none;">
        <input required type="text" name = "practice_place_address" placeholder="Адрес места практики">
        <input required type="text" name="work_year" placeholder="Год работы" value="<?php echo date("Y"); ?>">
        <input required type="text" name = "practice_deadlines" placeholder="Сроки практики">
        <br>
        <h3>Выберите номер группы</h3>
        <div class="students_list">
            <?php
            $students_list = $connectMySQL->query("SELECT DISTINCT STUDENT_GROUP FROM user WHERE STUDENT_GROUP IS NOT NULL");
            while ($row = $students_list->fetch_assoc()){
                $student_group = $row["STUDENT_GROUP"];
                echo "<div class='students'><input type='checkbox' id='group_$student_group' name='student_groups[]' value='$student_group'>";
                echo "<label for='group_$student_group'>$student_group</label></div>";
            }
            ?>
        </div>
        <h3>Выберите студентов</h3>
        <div class="students_list">
            <?php
            $students_list = $connectMySQL->query("SELECT * FROM `user` WHERE `ROLE` = 'student'");
            while ($row = $students_list->fetch_assoc())
            {
                $student_id = $row['ID'];
                $student_fullname = $row['FULLNAME'];
                $result = $connectMySQL->query("SELECT STUDENT_ID FROM `diary_document` WHERE `STUDENT_ID` = '$student_id' AND `PRACTICE_PLACE` IS NULL AND `ORGANIZATION_CHIEF_ID` = " . $_SESSION['ID'])->fetch_assoc();
                if ($result != "")
                {
                   echo "<div class='students'><input type='checkbox' name='students_id[]' value=" . $student_id . ">" .$student_fullname . "</div>";
                }
            }
            ?>
        </div>
        <br>
        <input type="submit" name="submit" value="Отправить">
    </form>
</div>
<script>
    function toggleInput() {
        var selectElement = document.getElementById("practice_place");
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
</body>
</html>
