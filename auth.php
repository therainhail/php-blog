<?php
require_once "db.php";
if( !empty($_POST['login']) && !empty($_POST['password']))
{
    $stmt = $pdo->prepare("select * from users where login=? and password=?");
    $stmt->execute([
        $_POST['login'],
        $_POST['password']
    ]);
    $login = $_POST['login'];

    $user = $stmt->fetch();
    if($user) {
        session_start();
        $_SESSION['login'] = $login;
        header('Location: user.php');
    } else {
        echo "Извините, вы не зарегестрированы";
    }
}
?>
