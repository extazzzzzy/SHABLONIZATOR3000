<?php
session_start();

    $connectMySQL = new mysqli('localhost', 'root', 'root', 'shablonizator3000');

    $LOGIN = $_POST['LOGIN'];
    $PASSWORD = $_POST['PASSWORD'];

    $query = $connectMySQL->prepare("SELECT * FROM user WHERE LOGIN=? AND PASSWORD=?");
    $query->bind_param("ss", $LOGIN, $PASSWORD);
    $query->execute();

    $result = $query->get_result();

    if ($result)
    {
        if ($result->num_rows > 0)
        {
            $data = $result->fetch_assoc();
            $_SESSION['ID'] = $data['ID'];
            $_SESSION['ROLE'] = $data['ROLE'];
            header("Location: ../pages/profile.php");
        }
        else
        {
            echo "Неверный логин или пароль";
        }
    }
    else
    {
        header("Location: auth.php");
    }
?>