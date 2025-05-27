<?php
session_start();
require_once '../config/db.php';
$nom = $_POST['nom'] ?? '';
$prenom = $_POST['prenom'] ?? '';
$email = $_POST['email'] ?? '';
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
if(empty($nom) || empty($prenom) || empty($email) || empty($login) || empty($password)){
    $_SESSION['error'] = "Tous les champs sont obligatoires.";
    header("Location: ../views/pages/register/register.php");
    exit();
}
if(strlen($login)>10){
    $_SESSION['error'] = "Le login doit contenir au plus 10 caractères.";
    header("Location: ../views/pages/register/register.php");
    exit();
}
if(strlen($password)<8){
    $_SESSION['error'] = "Le mot de passe doit contenir au moins 8 caractères.";
    header("Location: ../views/pages/register/register.php");
    exit();
}
$sql = "SELECT * FROM Utilisateur WHERE login = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$login);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows>0){
    $_SESSION['error'] = "Ce login existe déjà.";
    header("Location: ../views/pages/register/register.php");
    exit();
}
$sql = "SELECT * FROM Utilisateur WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$email);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows>0){
    $_SESSION['error'] = "Cet email existe déjà.";
    header("Location: ../views/pages/register/register.php");
    exit();
}
$sql = "SELECT * FROM Utilisateur WHERE nom = ? AND prenom = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss",$nom,$prenom);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows>0){
    $_SESSION['error'] = "Ces nom et prénom existent déjà.";
    header("Location: ../views/pages/register/register.php");
    exit();
}
$passwordHash = password_hash($password,PASSWORD_BCRYPT);
$sql = "INSERT INTO Utilisateur (login,nom,prenom,email,password) VALUES (?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $login, $nom, $prenom, $email, $passwordHash);
if($stmt->execute()){
    echo "Inscription réussie !";
    $_SESSION['login'] = $login;
    header("Location: ../views/pages/homePage/homePage.php?login={$_SESSION['login']}");
    exit();
}else{
    $_SESSION['error'] = "Erreur lors de l'inscription : ".$stmt->error;
    header("Location: ../views/pages/register/register.php");
    exit();
}
$stmt->close();
$conn->close();
?>