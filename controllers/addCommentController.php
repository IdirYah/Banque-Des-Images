<?php
session_start();
require_once '../config/db.php'; 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_GET['id'] ?? null;
    $login = $_SESSION['login'];
    if(!$id){
        header("Location: ../views/pages/homePage/homePage.php?login={$_SESSION['login']}");
        exit();
    }
    $comment = $_POST['commentaire'] ?? '';
    if(empty($comment)){
        $_SESSION['error'] = 'Le champs commentaire est obligatoire';
        header("Location: ../views/pages/imageDetails/imageDetails.php?id={$id}");
        exit();
    }
    $sql = "INSERT INTO Commentaire (comment,login,idImage) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",$comment,$login,$id);
    $stmt->execute();
    header("Location: ../views/pages/imageDetails/imageDetails.php?id={$id}");
    exit();
}
?>