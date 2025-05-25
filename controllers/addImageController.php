<?php
session_start();
require_once '../config/db.php'; 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = $_SESSION['login'];
    $description = $_POST['description'] ?? '';
    $uploadDir = '../uploads/';
    if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
        $tmpName = $_FILES['image']['tmp_name'];
        $originalName = basename($_FILES['image']['name']);
        $ext = pathinfo($originalName,PATHINFO_EXTENSION);
        $newName = uniqid('img_').'.'.$ext;
        $targetPath = $uploadDir.$newName;
        $check = getimagesize($tmpName);
        if($check === false){
            $_SESSION['error'] = "Le fichier n'est pas une image valide.";
            header("Location: ../views/pages/ajoutImage/ajoutImage.php");
            exit();
        }
        if(move_uploaded_file($tmpName,$targetPath)){
            $sql = "INSERT INTO Image (login,lien,description) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss",$login,$newName,$description);
            if($stmt->execute()){
                header("Location: ../views/pages/homePage/homePage.php?login={$_SESSION['login']}");
                exit();
            }else{
                $_SESSION['error'] = "Erreur lors de l'enregistrement dans la base.";
                header("Location: ../views/pages/ajoutImage/ajoutImage.php");
                exit();
            }
        }else{
            $_SESSION['error'] = "Erreur lors du téléchargement du fichier.";
            header("Location: ../views/pages/ajoutImage/ajoutImage.php");
            exit();
        }
    }else{
        $_SESSION['error'] = "Aucun fichier envoyé ou erreur.";
        header("Location: ../views/pages/ajoutImage/ajoutImage.php");
        exit();
    }
}
?>