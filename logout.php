<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['role']);
unset($_SESSION['session_username']);
session_destroy();
header("Location: index.php");
