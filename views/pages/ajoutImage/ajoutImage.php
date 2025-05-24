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
    <div id="bar">
        <?php include_once '../../components/sideBar/sideBar.php'; ?>
    </div>
    <div id="upload-container">
        <form class="upload-box" method="POST">
            <p>Glissez et déposez votre image ici</p>
            <input type="file" name="image" id="image-upload">
            <label for="image-upload" class="select-btn">Sélectionner une image</label>
            <span id="file-name">Aucun fichier sélectionné</span>
            <textarea name="description" placeholder="Description de l'image..."></textarea>
            <button type="submit">Publier</button>
        </form>
    </div>
</body>
</html>