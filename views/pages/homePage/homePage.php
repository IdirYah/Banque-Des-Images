<?php
require_once '../../../config/db.php';
require_once '../../../middleware/auth.php';
$login = $_GET['login'] ?? null;
if(!$login){
    header("Location: ../login/login.php");
    exit();
}
$sql = "SELECT * FROM Image WHERE login = ? ORDER BY date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$login);
$stmt->execute();
$result = $stmt->get_result();
$images = [];
if($result && $result->num_rows>0){
    $images = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homePage.css">
    <link rel="stylesheet" href="../../components/sideBar/sideBar.css">
    <title>Home Page</title>
</head>
<body>
    <div id="bar">
        <?php include_once '../../components/sideBar/sideBar.php'; ?>
    </div>
    <div id="main">
        <h1>Images</h1>
        <div id="contenu">
            <?php if(count($images)>0):?>
                <?php foreach($images as $row):?>
                    <a href="../../pages/imageDetails/imageDetails.php?id=<?=urlencode($row['idImage'])?>"><div class="card" data-image="<?=htmlspecialchars($row['idImage'])?>">
                        <img src="../../../uploads/<?=htmlspecialchars($row['lien'])?>" alt="Image">
                        <p><?=date("d/m/Y",strtotime($row['date']))?></p>
                    </div></a>
                <?php endforeach;?>
            <?php else:?>
                <p>Aucune image trouvée pour cet utilisateur.</p>
            <?php endif;?>
        </div>
    </div>
</body>
</html>