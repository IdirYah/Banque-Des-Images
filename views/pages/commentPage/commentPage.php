<?php
require_once '../../../config/db.php';
require_once '../../../middleware/auth.php';
$login = $_GET['login'] ?? null;
if(!$login || empty($login)){
    header("Location: ../homePage/homePage.php?login={$_SESSION['login']}");
    exit();
}
$sql = "SELECT * FROM Commentaire WHERE login = ? ORDER BY date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$login);
$stmt->execute();
$result = $stmt->get_result();
$comments = [];
if($result && $result->num_rows>0){
    $comments = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaires</title>
    <link rel="stylesheet" href="../../components/sideBar/sideBar.css">
    <link rel="stylesheet" href="commentPage.css">
</head>
<body>
    <div id="bar">
        <?php include_once '../../components/sideBar/sideBar.php'; ?>
    </div>
    <div id="main">
        <div id="comment">
            <h1>Commentaires de <?=htmlspecialchars($login)?> : </h1>
            <?php if(count($comments)>0):?>
                <?php foreach($comments as $row):?>
                <div class="commentaire">
                    <p><?=htmlspecialchars($row['comment'])?></p>
                    <span><?=date("d/m/Y",strtotime($row['date']))?></span>
                </div>
                <?php endforeach;?>
            <?php else:?>
                <p>Aucun commentaire trouvé pour cet utilisateur.</p>
            <?php endif;?>
        </div>
    </div>
</body>
</html>
