<?php
require_once "db.php";
if( !empty($_POST['login']) && !empty($_POST['password']))
    {
        $stmt = $pdo->prepare("insert into users(login, password) values(?,?)");
        $stmt->execute([
            $_POST['login'],
            $_POST['password']
        ]);
        header("Location: index.php");
    }
