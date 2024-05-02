<?php
session_start();
$connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

if (!isset($_SESSION['ID'])) {
    header("Location: auth.php");
    die();
}

function view_status($doc_status_id) {
    switch ($doc_status_id) {
        case 1:
            echo "Ожидает назначения руководителя организации администратором";
            break;
        case 2:
            echo "Ожидает получения данных от руководителя ЮГУ";
            break;
        case 3:
            echo "Ожидает заполнения данных о практике от руководителя организации/ожидает заполнение данных студентом";
            break;
        case 4:
            echo "Ожидает получения характеристики студента от руководителя организации";
            break;
        case 5:
            echo "Ожидает подтверждения всех участников";
            break;
        case 6:
            echo "Ожидает подтверждения администратора";
            break;
        }
}

function check_link($doc_src) {
    if ($doc_src != '')
    {
        echo "<a id='btn' href=" .  $doc_src . " download>Скачать</a>";
    }
    else
        echo '';
}

function generate_document_table($connectMySQL) {
    ob_start(); // начало буферизации вывода
    ?>
    <div class="table_orders">
        <table>
            <thead>
            <tr>
                <th>№ документа</th>
                <th>Название документа</th>
                <th>Статус</th>
                <th>ФИО студента</th>
                <th>ФИО руководителя от ЮГУ</th>
                <th>ФИО руководителя от предприятия</th>
                <th>Место проведения </th>
                <th>Дата обращения</th>
                <th>Комментарий</th>
                <th>Скачать документ</th>
                <th>Принять документ</th>
            <tr>
            </thead>
            <tbody>
            <?php
            if ($_SESSION['ROLE'] == "student")
            {
                $doc_list = $connectMySQL->query("SELECT * FROM `diary_document` WHERE `STUDENT_ID` = ". $_SESSION['ID']);
            }
            elseif ($_SESSION['ROLE'] == "usu_chief")
            {
                $doc_list = $connectMySQL->query("SELECT * FROM `diary_document` WHERE `USU_CHIEF_ID` = ". $_SESSION['ID']);
            }
            elseif ($_SESSION['ROLE'] == "org_chief")
            {
                $doc_list = $connectMySQL->query("SELECT * FROM `diary_document` WHERE `ORGANIZATION_CHIEF_ID` = ". $_SESSION['ID']);
            }
            else
            {
                $doc_list = $connectMySQL->query("SELECT * FROM `diary_document`");
            }

            while ($row = $doc_list->fetch_assoc())
            {
            $doc_status_id = $row['STATUS'];
            
            if (isset($row['SRC']) && $doc_status_id > 3) {
                $doc_src = $row['SRC'];
            }
            else
                $doc_src = '';
                
            $doc_id = $row['ID'];
            $template_name = $connectMySQL->query("SELECT `NAME` FROM `template` WHERE `ID` = ". $row['TEMPLATE_ID'])->fetch_assoc()['NAME'];

            $student_fullname = isset($row['STUDENT_ID']) ? $connectMySQL->query("SELECT `FULLNAME` FROM `user` WHERE `ID` = ".
                $row['STUDENT_ID'])->fetch_assoc()['FULLNAME'] : "";
            $usu_chief_fullname = isset($row['USU_CHIEF_ID']) ? $connectMySQL->query("SELECT `FULLNAME` FROM `user`WHERE `ID` = ".
                $row['USU_CHIEF_ID'])->fetch_assoc()['FULLNAME'] : "";
            $org_chief_fullname = isset($row['ORGANIZATION_CHIEF_ID']) ? $connectMySQL->query("SELECT `FULLNAME` FROM `user`
                WHERE `ID` = ". $row['ORGANIZATION_CHIEF_ID'])->fetch_assoc()['FULLNAME'] : "";
            $practice_place = isset($row['PRACTICE_PLACE']) ? $row['PRACTICE_PLACE'] : "";
            $timestamp = $row['TIMESTAMP'];
            $comment = isset($row['COMMENT']) ? $row['COMMENT'] : "";
            ?>
            <tr>
                <td><a href="fill.php?ID=<?php echo $doc_id;?>"><?php echo $doc_id;?></a></td>
                <td><?php echo $template_name; ?></td>
                <td><?php view_status($doc_status_id); ?></td>
                <td><?php echo $student_fullname; ?></td>
                <td><?php echo $usu_chief_fullname; ?></td>
                <td><?php echo $org_chief_fullname; ?></td>
                <td><?php echo $practice_place; ?></td>
                <td><?php echo $timestamp; ?></td>
                <td><?php echo $comment; ?></td>
                <td><?php check_link($doc_src) ?></td>
                <td><button>Принять</button><button>Отклонить</button></td>
            <tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    $output = ob_get_contents(); // сохраняем буфер
    ob_end_clean(); // очищаем буфер
    return $output; // возвращаем содержимое буфера
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Принятие документов</title>
    <style>
        body {
            font-family: Bahnschrift, sans-serif;
            background-color: rgb(120, 172, 227, 0.72);
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            border-radius: 8px;
            padding: 20px;
            overflow-y: auto;
            scrollbar-width: none;
            display: flex;
            justify-content: center;
            justify-items: center;
        }

        nav {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        nav a {
            margin-top: 30px;
            background-color: rgb(51, 136, 85);
            color: #ffffff;
            padding: 10px 40px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: rgba(120, 172, 227, 0.72);
            text-decoration: underline;
        }

        .table_orders {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 2px solid rgba(120, 172, 227, 0.72);
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #0a4d8c;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #0a4d8c;
            color: #0a4d8c;
        }

        tr:hover {
            background-color: #0a4d8c;
            color: white;
        }
        tr:hover a{
            color: white;
        }

        button {
            background-color: rgb(51, 136, 85);
            border-style: none;
            border-radius: 5px;
            height: 40px;
            color: white;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            font-size: medium;
        }

        button:hover {
            background-color: rgba(120, 172, 227, 0.72);
        }

        #btn {
            display: inline-block;
            background-color: rgb(51, 136, 85);
            color: #fff;
            padding: 8px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <nav>
            <a href='pick_template.php'>Создать документ</a>
            <a href='profile.php'>Профиль</a>
            <a href='../php/logout.php'>Выход из аккаунта</a>
            <?php
            if ($_SESSION['ROLE'] == "org_chief")
            {
                echo "<a href='create_practice.php'>Создать практику</a>";
            }
            ?>
        </nav>
    </div>
</header>
<?php echo generate_document_table($connectMySQL); ?>
</body>
</html>