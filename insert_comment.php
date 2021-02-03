<?php
session_start();
require_once "db.php";
$stmt = $pdo->prepare("select * from users where login=?");
$stmt->execute([
    $_SESSION['login']
]);
$login = $stmt->fetch();
$user_id=$login['id'];

if (!empty($_POST['comment'])) {
    $stmt = $pdo->prepare("insert into comments(post_id,user_id,comment) values(?,?,?)");
    $stmt->execute([
        $_GET['id'],
        $user_id,
        $_POST['comment']
    ]);
    header("Location: index.php");
}
