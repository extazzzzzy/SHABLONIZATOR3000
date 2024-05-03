<?php
session_start();
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');
$diary_document_id = $_GET['ID'];
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
            justify-content: center;
            text-align: center;
            align-content: center;
        }
        button {
            transition: background-color 0.3s ease;

        }
        h1 {
            color: #0a4d8c;
            text-align: center;
            margin-bottom: 10px;
        }
        h2 {
            color: #0a4d8c;
            text-align: center;
            font-size: medium;
        }
        .container {
            display: flex;
            justify-content: center;
            background-color: #78ace3;
            border-radius: 8px;
            width: 600px;
            height: 40vh;
            overflow-y: auto;
            scrollbar-width: none;
            margin-left: calc(50% - 310px);
        }
        .logo img {
            width: 100%;
        }
        input[type="text"] {
            color: #ffffff;
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px auto;
            background-color: #0a4d8c;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
        }
        input[type="password"], input[type="submit"], button, select {
            color: #ffffff;
            padding: 10px;
            width: 100%;
            margin: 10px auto;
            background-color: #0a4d8c;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            max-width: 300px;
        }
        .input-pair {
            display: flex;
        }
        input[type="text"]::placeholder, input[type="password"]::placeholder {
            color: #ffffff;
        }
        input[type="submit"]:hover, button:hover {
            background-color: rgba(120, 172, 227, 0.72);
            color: #0a4d8c;
            transition: background-color 0.3s ease;
        }
        a {
            text-decoration: none;
            color: #004d8c;
            display: block;
            margin-top: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        .nav-button {
            background-color: rgb(51, 136, 85);
            font-weight: normal;
            font-size: medium;
            transition: background-color 0.3s ease;
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
        .tooltip {
            position: relative;
            max-width: 400px;
            margin-left: calc(50% - 220px);
            background-color: rgb(51, 136, 85);
            border: 1px solid rgb(51, 136, 85);
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgb(51, 136, 85);
            display: none;
            z-index: 999;
            color: white;
        }
        .icon:hover + .tooltip {
            display: block;
        }
        .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-size: contain;
            cursor: pointer;
            vertical-align: middle;
            margin-left: 5px;
            color: #0a4d8c;
        }
        .container1 {
            background-color: #78ace3;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            text-align: center;
            max-height: 300px;
            overflow: auto;
            scrollbar-width: none;
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="button-container">
    <a class="documents-link" href="documents.php">Вернуться к списку документов</a>
</div>
<?php
if ($_SESSION['ROLE'] == 'usu_chief') {
    if ($connectMySQL->query("SELECT STATUS FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc()['STATUS'] != '2') {
        header("Location: documents.php");
        die();
    }


    ?>
    <?php
if ($connectMySQL->query("SELECT TEMPLATE_ID FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc()['TEMPLATE_ID'] == '1'){
    ?>
    <form action="../python/fill_usu_chief_data.php" method="post">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "shablonizator3000";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT DISTINCT STUDENT_GROUP FROM user WHERE STUDENT_GROUP IS NOT NULL";

        $result = $conn->query($sql);
        ?>
        <div class="container">
            <div class="logo">
                <img src="../images/fill1.png">
            </div>
        </div>
        <div class="container1">
        <?php
        echo '<select id="student_group" name="student_group" required>';
        echo '<option value="">Выберите группу</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["STUDENT_GROUP"] . '">' . $row["STUDENT_GROUP"] . '</option>';
        }
        echo '</select>';

        $conn->close();
        ?>
        <select id="practice_kind" name="practice_kind" required>
            <option value="">Выберите вид практики</option>
            <option value="Учебная">Учебная</option>
            <option value="Производственная">Производственная</option>
        </select>
        <input type="hidden" name="document_id" value = <?php echo $_GET['ID'] ?>>
        <button class="nav-button" type="submit">Отправить</button>
        </div>>
    </form>
    <?php
}elseif ($connectMySQL->query("SELECT TEMPLATE_ID FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc()['TEMPLATE_ID'] == '2'){?>
    <form action="../python/fill_usu_chief_data_report.php" method="post">
        <?php
        $statement = new mysqli("localhost", "root", "root", "shablonizator3000");

        if ($statement->connect_error) {
            die("Connection failed: " . $statement->connect_error);
        }

        $sql1 = "SELECT DISTINCT STUDENT_GROUP FROM user WHERE STUDENT_GROUP IS NOT NULL";

        $result = $statement->query($sql1);
        ?>
        <div class="container">
            <div class="logo">
                <img src="../images/fill2.png">
                <img src="../images/fill3.png">
            </div>
        </div>
        <div class="container1">
        <?php
        echo '<select id="student_group" name="STUDENTS_GROUP" required>';
        echo '<option value="">Выберите группу</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["STUDENT_GROUP"] . '">' . $row["STUDENT_GROUP"] . '</option>';
        }
        echo '</select>';
        echo "<br>";
        $statement->close();
        ?>
        <input type="text" name="YEAR" id="YEAR" placeholder="Год отчета" value="<?php echo date('Y') - 1;?> / <?php echo date('Y'); ?>">
        <br>
        <input type="text" name="REPORT_YEAR" placeholder="Год обучения" value="<?php echo date('Y'); ?>">
        <br>
        <select id="practice_kind" name="PRACTICE_KIND" required>
            <option value="">Выберите вид практики</option>
            <option value="Учебная">Учебная</option>
            <option value="Производственная">Производственная</option>
        </select>
        <br>
        <select id="PRACTICE_TYPE" name="PRACTICE_TYPE">
            <option value="">Выберите тип практики</option>
            <option value="Ознакомительная">Ознакомительная</option>
            <option value="Технологическая">Технологическая</option>
            <option value="Преддипломная">Преддипломная</option>
        </select>
        <br>
        <select id="CODE_AND_PREPARATION_DIRECTION" name="CODE_AND_PREPARATION_DIRECTION">
            <option value="">Выберите код направления</option>
            <option value="09.03.04 Программная инженерия">09.03.04 Программная инженерия</option>
            <option value="09.03.01 Информатика и вычислительная техника">09.03.01 Информатика и вычислительная техника</option>
        </select>
        <br>
        <select id="ORDER_NUMBER_AND_DATE" name="ORDER_NUMBER_AND_DATE">
            <option value="">Выберите номер приказа</option>
            <option value="2-221 от 6-го марта 2024г">2-221 от 06.03.2024</option>
            <option value="2-222 от 6-го марта 2024г">2-222 от 06.03.2024</option>
        </select>
        <br>
        <input type="hidden" name="document_id" value = <?php echo $_GET['ID'] ?>>
        <button class="nav-button" type="submit">Отправить</button>
        </div>
    </form>
<?php
}
}elseif ($_SESSION['ROLE'] == 'student')
{
$diary_document_record = $connectMySQL->query("SELECT STATUS, PRACTICE_PLACE FROM `diary_document` WHERE `ID` = " . $diary_document_id)->fetch_assoc();

if ($diary_document_record['STATUS'] != '3' | !isset($diary_document_record['PRACTICE_PLACE']))
{
    header("Location: documents.php");
    die();
}
?>
    <form action="../python/fill_student_data.php?ID=" . <?php echo $_GET['ID'] ?> method="post" enctype="multipart/form-data">
        <div id="taskForm">

        </div>
        <button id="addPairButton" type="button">Добавить новую задачу</button>
        <button id="removePairButton" type="button">Удалить последнюю задачу</button>
        <h2>Выберите .csv файл для загрузки задач</h2>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="hidden" name="document_id" value = <?php echo $_GET['ID'] ?>>
        <br>
        <input type="submit" value="Отправить" name="submit">
        <br>


        <ion-icon class="icon" name="help-circle-outline"></ion-icon>
        <div class="tooltip" style="font-size: 14px">
            Добавьте задачи вручную или загрузите .csv таблицу
        </div>
    </form>
<br>


    <script>
        function checkFormState() {
            const tasks = document.querySelectorAll('.input-pair');
            const fileInput = document.getElementById('fileToUpload');
            const addButton = document.getElementById('addPairButton');
            const removeButton = document.getElementById('removePairButton');

            if (tasks.length > 0) {
                fileInput.disabled = true;
                removeButton.disabled = false;
            } else {
                fileInput.disabled = false;
                removeButton.disabled = true;
            }

            if (fileInput.value !== '') {
                addButton.disabled = true;
            } else {
                addButton.disabled = false;
            }
        }

        addPairButton.addEventListener('click', function() {
            const pairDiv = document.createElement('div');
            pairDiv.className = 'input-pair';

            const input1 = document.createElement('input');
            input1.type = 'text';
            input1.name = 'taskName[]';
            input1.placeholder = 'Название задачи';
            input1.required = true;

            const input2 = document.createElement('input');
            input2.type = 'text';
            input2.name = 'taskDescription[]';
            input2.placeholder = 'Дата';
            input2.required = true;

            pairDiv.appendChild(input1);
            pairDiv.appendChild(input2);

            taskForm.appendChild(pairDiv);
            checkFormState();
        });

        removePairButton.addEventListener('click', function() {
            const pairs = document.querySelectorAll('.input-pair');
            const lastPair = pairs[pairs.length - 1];
            if (lastPair) {
                taskForm.removeChild(lastPair);
            }
            checkFormState();
        });

        fileToUpload.addEventListener('change', function() {
            checkFormState();
        });
    </script>
    <?php
} elseif ($_SESSION['ROLE'] == 'org_chief'){
    header("Location: fill_org_chief.php?ID=" . $_GET['ID']);
}
else
{
    header("Location: pick_org_chief.php?ID=" . $_GET['ID']);
}
?>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>