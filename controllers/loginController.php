<?php
session_start();
require_once '../config/db.php';
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
if(empty($login) || empty($password)){
    $_SESSION['error'] = "Tous les champs sont obligatoires.";
    header("Location: ../views/pages/login/login.php");
    exit();
}
$sql = "SELECT * FROM Utilisateur WHERE login = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0){
    $_SESSION['error'] = "Login ou mot de passe incorrect.";
    header("Location: ../views/pages/login/login.php");
    exit();
}
$row = $result->fetch_assoc();
if(password_verify($password,$row['password'])){
    $_SESSION['login'] = $login;
    header("Location: ../views/pages/homePage/homePage.php?login={$_SESSION['login']}");
    exit();
}else{
    $_SESSION['error'] = "Login ou mot de passe incorrect.";
    header("Location: ../views/pages/login/login.php");
    exit();
}
$stmt->close();
$conn->close();
?>