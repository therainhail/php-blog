<?php
session_start();
require_once "db.php";
$stmt = $pdo->prepare("SELECT * FROM users where login=?");
$stmt->execute([
    $_SESSION['login']
]);
    $login = $stmt->fetch();
    if ($_SESSION['login']==null){
        $user_id=$_COOKIE['user_id'];
    } else {
        $user_id = $login['id'];
    }
    $stmt1 = $pdo->prepare("SELECT * FROM likes where user_id=? and post_id=?");
    $stmt1->execute([
        $user_id,
        $_GET['id']
    ]);
    $likes = $stmt1->fetch();

    if ($likes) {
        $stmt3 = $pdo->prepare("DELETE FROM likes where post_id=? and user_id=?");
        $stmt3->execute([
            $_GET['id'],
            $user_id
        ]);
    } else {
        $stmt2 = $pdo->prepare("INSERT INTO likes(post_id,user_id) values (?,?)");
        $stmt2->execute([
            $_GET['id'],
            $user_id
        ]);
    }
    header("Location: index.php");
//echo $_GET['id'].''.$_SESSION['login'].' '.$user_id;
//echo $likes['post_id'].' '.$likes['post_id'];
