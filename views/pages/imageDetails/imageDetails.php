<?php
require_once '../../../config/db.php';
require_once '../../../middleware/auth.php';
$id = $_GET['id'] ?? null;
if(!$id || empty($id)){
    header("Location: ../homePage/homePage.php?login={$_SESSION['login']}");
    exit();
}
$sql1 = "SELECT * FROM Commentaire WHERE idImage = ? ORDER BY date DESC";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("s",$id);
$stmt1->execute();
$result1 = $stmt1->get_result();
$sql2 = "SELECT * FROM Image WHERE idImage = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("s",$id);
$stmt2->execute();
$result2 = $stmt2->get_result();
$image = $result2->fetch_assoc();
?>
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
    <?php if(isset($_SESSION['error'])):?>
        <script>
            alert("<?=addslashes($_SESSION['error'])?>");
        </script>
        <?php unset($_SESSION['error']);?>
    <?php endif;?>
    <div id="bar">
        <?php include_once '../../components/sideBar/sideBar.php'; ?>
    </div>
    <div id="main">
        <h1>Détails de l'image</h1>
        <div id="contenu">
            <img src="../../../uploads/<?=htmlspecialchars($image['lien'])?>">
            <p><?=htmlspecialchars($image['description'])?></p>
            <span><?=date("d/m/Y",strtotime($image['date']))?></span>
        </div>
        <div id="comment">
            <h1>Commentaires:</h1>
            <?php while($row = $result1->fetch_assoc()):?>
            <div class="commentaire">
                <div class="cmt">
                    <a href="../homePage/homePage.php?login=<?=urlencode($row['login'])?>"><p><?=htmlspecialchars($row['login'])?></p></a>
                    <span><?=date("d/m/Y",strtotime($row['date']))?></span>
                </div> 
                <p><?=htmlspecialchars($row['comment'])?></p>
                
            </div>
            <?php endwhile;?>
        </div>
        <form method="POST" action="../../../controllers/addCommentController.php?id=<?=urlencode($id)?>">
            <div id="form">
                <input type="text" name="commentaire" id="commentaire" placeholder="Ajouter un commentaire">
                <button type="submit">Envoyer</button>
            </div>
        </form>       
    </div>
</body>
</html>
