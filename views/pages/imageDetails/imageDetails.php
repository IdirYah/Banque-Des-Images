<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="imageDetails.css">
    <link rel="stylesheet" href="../../components/sideBar/sideBar.css">
    <title>Image Details</title>
</head>
<body>
    <div id="bar">
        <?php include_once '../../components/sideBar/sideBar.php'; ?>
    </div>
    <div id="main">
        <h1>Détails de l'image</h1>
        <div id="contenu">
            <img src="../../../assets/photo.jpeg">
            <p>description de l'image on est la on n'est plus la paris marseille barcelone</p>
            <span>18/05/2025</span>
        </div>
        <div id="comment">
            <h1>Commentaires:</h1>
            <div class="commentaire">
                <p>Comment aire 1df qgrfz gfzgrza grarga fqezfag agragar gggrfrf efzegr</p>
                <span>18/05/2025</span> 
            </div>
            <div class="commentaire">
                <p>Commentaire 2</p>
                <span>18/05/2025</span>
            </div>
            <div class="commentaire">
                <p>Commentaire 3</p>
                <span>18/05/2025</span>
            </div>
        </div>
        <form method="POST">
            <div id="form">
                <input type="text" name="commentaire" id="commentaire" placeholder="Ajouter un commentaire">
                <button type="submit">Envoyer</button>
            </div>
        </form>       
    </div>
</body>
</html>