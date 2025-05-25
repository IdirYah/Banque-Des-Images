<?php
session_start();
if(!isset($_SESSION['login'])){
    $_SESSION['error'] = "Vous devez être connecté pour accéder à cette page.";
    header("Location: ../login/login.php");
    exit();
}
