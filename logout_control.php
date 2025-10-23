<?php
session_start();

session_destroy();

$_SESSION['logout_error'] = "Anda berhasil logout";

header('location:login.php');
?>