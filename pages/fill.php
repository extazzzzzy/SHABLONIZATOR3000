<?php
session_start();
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');
$document_record = $connectMySQL->query("SELECT student_id, usu_chief_id, organization_chief_id, status FROM `diary_document` WHERE `id` = " . $_GET['ID'])->fetch_assoc();
if ($_SESSION['ROLE'] == "usu_chief")
{
    if ($_SESSION['ID'] != $document_record['usu_chief_id'] | $document_record['status'] != '1')
    {
        header("Location: ../pages/documents.php");
        die;
    }
}
elseif ($_SESSION['ROLE'] == "student")
{
    if ($_SESSION['ID'] != $document_record['student_id'] | $document_record['status'] != '2')
    {
        header("Location: ../pages/documents.php");
        die;
    }
}
elseif ($_SESSION['ROLE'] == "org_chief")
{
    if ($_SESSION['ID'] != $document_record['organization_chief_id'] | $document_record['status'] != '3')
    {
        header("Location: ../pages/documents.php");
        die;
    }
}

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
        }
        h1 {
            color: #0a4d8c;
            text-align: center;
            margin-bottom: 10px;
        }
        .container {
            display: flex;
            justify-content: center;
            background-color: #78ace3;
            border-radius: 8px;
            width: 600px;
            height: 50vh;
            overflow-y: auto;
            scrollbar-width: none;
            margin-left: calc(50% - 310px);
        }
        .logo img {
            width: 100%;
        }
        h1 {
            color: #0a4d8c;
            margin-bottom: 20px;
        }
        input[type="text"] {
            color: #ffffff;
            width: 40%;
            padding: 10px;
            margin: 10px auto;
            background-color: #0a4d8c;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
        }
        input[type="password"], input[type="submit"], button {
            color: #ffffff;
            padding: 10px;
            width: calc(50% - 50px);
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

        .org_chief_fill {
            background-color: #78ace3;
            padding: 20px;
            width: 300px;
            height: 300px;
            overflow: auto;
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
<div class="button-container">
    <a class="documents-link" href="documents.php">Вернуться к списку документов</a>
</div>
<?php
if ($_SESSION['ROLE'] == 'usu_chief') {
    ?>
    <div class="container">
        <div class="logo">
            <img src="../images/fill1.png">
        </div>
    </div>
    <form action="../python/fill_usu_chief_data.php" method="post">
        <input required type="text" id="student_group" name="student_group" placeholder="Введите номер группы">
        <input required type="text" id="practice_kind" name="practice_kind" placeholder="Введите вид практики">
        <input type="hidden" name="document_id" value="<?php echo $_GET['ID'];?>">
        <button class="nav-button" type="submit">Отправить</button>
    </form>
    <?php
} elseif ($_SESSION['ROLE'] == 'student') {
    ?>
    <form action="../python/fill_student_data.php" method="post" enctype="multipart/form-data">
        Select CSV file to upload:
        <input required type="file" name="fileToUpload" id="fileToUpload">
        <br>
        <input type="submit" value="Загрузить CSV файл" name="submit">
        <input type="hidden" name="document_id" value="<?php echo $_GET['ID'];?>">
        <br>
        <select name="org_chief_fullname">
            <?php
            $org_chief_list = $connectMySQL->query("SELECT FULLNAME FROM `user` WHERE `ROLE` = 'org_chief'");
            while ($row = $org_chief_list->fetch_assoc())
            {
                $usu_chief_fullname = $row['FULLNAME'];
                echo "<option>" . $usu_chief_fullname . "</option>";
            }
            ?>
        </select>
    </form>
    <form id="taskForm" action="" method="post">

    </form>
    <button id="addPairButton">Добавить новую задачу</button>
    <div id="submitButtonContainer"></div>
    <script>
        const taskForm = document.getElementById('taskForm');
        const addPairButton = document.getElementById('addPairButton');
        const submitButtonContainer = document.getElementById('submitButtonContainer');

        addPairButton.addEventListener('click', function() {
            const pairDiv = document.createElement('div');
            pairDiv.className = 'input-pair';

            const input1 = document.createElement('input');
            input1.type = 'text';
            input1.name = 'taskName[]';
            input1.placeholder = 'Название задачи';

            const input2 = document.createElement('input');
            input2.type = 'text';
            input2.name = 'taskDescription[]';
            input2.placeholder = 'Дата';

            pairDiv.appendChild(input1);
            pairDiv.appendChild(input2);

            taskForm.appendChild(pairDiv);

            if (!submitButtonContainer.querySelector('button[type="submit"]')) {
                const submitButton = document.createElement('button');
                submitButton.type = 'submit';
                submitButton.textContent = 'Отправить';
                submitButtonContainer.appendChild(submitButton);
            }
        });
    </script>
    <?php
}
elseif ($_SESSION['ROLE'] == 'org_chief'){
    header("Location: fill_org_chief.php?ID=" . $_GET['ID']);
    //<input type="hidden" name="document_id" value="<?php echo $_GET['ID'];
    ?>
<?php
}
?>
</body>
</html>