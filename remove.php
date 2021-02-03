<?php
require "db.php";
if(isset($_GET['id']))
{
    $stmt = $pdo->prepare('select * from posts where id = ?');
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();
}
if($post) {
    $stmt = $pdo->prepare('delete from posts where id = ?');
    $stmt->execute([$_GET['id']]);
    if($post) {

    } else {
    unlink(dirname(__FILE__).'/'.$post['img'] );}
}
header('Location: index.php');
?>
