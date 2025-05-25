<?php
require_once '../../../middleware/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../components/sideBar/sideBar.css">
    <link rel="stylesheet" href="ajoutImage.css">
    <title>Ajouter une image</title>
</head>
<body>
    <?php if(isset($_SESSION['error'])):?>
        <script>
            alert("<?=addslashes($_SESSION['error'])?>");
        </script>
        <?php unset($_SESSION['error']);?>
    <?php endif;?>
    <div id="bar">
        <?php include_once '../../components/sideBar/sideBar.php'; ?>
    </div>
    <div id="upload-container">
        <form class="upload-box" method="POST" action="../../../controllers/addImageController.php" enctype="multipart/form-data">
            <p>Glissez et déposez votre image ici</p>
            <input type="file" name="image" id="image-upload">
            <label for="image-upload" class="select-btn">Sélectionner une image</label>
            <span id="file-name">Aucun fichier sélectionné</span>
            <textarea name="description" placeholder="Description de l'image..."></textarea>
            <button type="submit">Publier</button>
        </form>
    </div>
    <script>
        const input = document.getElementById("image-upload");
        const fileNameDisplay = document.getElementById("file-name");
        input.addEventListener("change",()=>{
            if(input.files && input.files.length>0){
                fileNameDisplay.textContent = input.files[0].name;
            }else{
                fileNameDisplay.textContent = "Aucun fichier sélectionné";
          }
        });
    </script>
</body>
</html>