<?php
session_start();
require "db.php";
if(isset($_GET['id']))
{
    $stmt = $pdo->prepare('select * from posts where id = ?');
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();

    $stmt1 = $pdo->prepare("select c.*, u.login from comments c join users u on c.user_id=u.id where c.post_id = ?");
    $stmt1->execute([$_GET['id']]);
    $comment = $stmt1->fetchAll();
}
?>
<!DOCTYPE HTML>
<!--
	Future Imperfect by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Single - Future Imperfect by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="single">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="#">Blog</a></h1>
						<nav class="main">
							<ul>
								<li class="menu user">
									<a href="#menu"><img src="images/avatar.jpg"></a>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Menu -->
					<section id="menu">

						<!-- Links -->
							<section>
								<ul class="links">
									<li>
										<a href="#">
											<h3>Add Post</h3>
										</a>
									</li>
                                    <?php if(isset($_SESSION['login'] )) { ?>
									<li>
                                        <p><?=$_SESSION['login']?></p>
										<a href="logout.php"><h3>Log Out</h3></a>
									</li>
                                    <?php ;}?>
								</ul>
							</section>

					</section>

				<!-- Main -->
					<div id="main">

						<!-- Post -->
							<article class="post">
								<header>
									<div class="title">
										<h2><a href="#"><?= $post['title']?></a></h2>
										<p><?= $post['subtitle']?></p>
									</div>
									<div class="meta">
										<time class="published" datetime="2015-11-01"><?= date('d.m.Y', strtotime($post['timestamp']))?></time>
										<a href="#" class="author"><span class="name">Jane Doe</span><img src="images/avatar.jpg" alt="" /></a>
									</div>
								</header>
								<span class="image featured"><img src="<?=$post['img']?>" alt="" /></span>
								<p><?= $post['resume']?></p>
								<p><?= $post['message']?></p>
								<footer>
									<ul class="stats">
										<li><a href="#">Edit</a></li>
                                        <?php if ($_SESSION['login']=='admin') {?>
										<li><a href="remove.php?id=<?= $post['id'] ?>" class="red">Delete</a></li>
                                        <?php }?>
										<li><a href="#" class="red">Blocked</a></li>
										<li><a href="#" class="icon fa-heart">28</a></li>
										<li><a href="#" class="icon fa-comment">128</a></li>
									</ul>
								</footer>
							</article>

						<!-- Comments -->
							<div class="post">
								<section class="comments">
									<h3>Comments</h3>
									<form action="insert_comment.php?id=<?= $post['id'] ?>" method="POST">
										<textarea name="comment"></textarea><br>
										<input type="submit" class="button big fit" value="Add Comment">
									</form>
								</section>
                                <?php foreach ($comment as $com): ?>
								<article class="comment">

									<div class="comment-autor">
										<a href="#"><img src="images/avatar.jpg"></a>
										<a href="#"><?= $com['login'] ?></a>
									</div>
									<p><?= $com['comment'] ?></p>
								</article>
                                <?php endforeach; ?>
							</div>

					</div>

				<!-- Footer -->
					<section id="footer">
						<p class="copyright">&copy; Untitled. Design: <a href="http://html5up.net">HTML5 UP</a>.</p>
					</section>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>