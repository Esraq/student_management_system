<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['role']);
session_destroy();
header("Location: login.php");
?>