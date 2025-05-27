<?php
require_once '../../../config/db.php'; 
require_once '../../../middleware/auth.php';
$query = $_GET['recherche'] ?? '';
$images = [];
if(!empty($query)){
    $motsCles = preg_split('/\s+/',trim($query));
    $conditions = [];
    $params = [];
    foreach($motsCles as $mot){
        $conditions[] = "(description LIKE ?)";
        $params[] = "%" .$mot ."%";
    }
    $whereClause = implode("OR",$conditions);
    $sql = "SELECT idImage, lien, description, login,(".implode("+",array_fill(0,count($motsCles),"CASE WHEN description LIKE ? THEN 1 ELSE 0 END")).") AS pertinence FROM Image WHERE $whereClause ORDER BY pertinence DESC";
    $allParams = array_merge($params,$params);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('s',count($allParams)),...$allParams);
    $stmt->execute();
    $images = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recherche.css">
    <title>Recherche</title>
</head>
<body>
    <h1>Recherche</h1>
    <form id="recherche-form">
        <div id="recherche">
            <input type="text" placeholder="Rechercher..." name="recherche" method="GET" action="recherche.php">
            <button type="submit">Rechercher</button>
        </div>
    </form>
    <div id="results">
        <?php if(!empty($query)):?>
            <h2>Résultats pour "<?=htmlspecialchars($query)?>"</h2>
            <?php if(count($images)>0):?>
                <div id="list">
                <?php foreach($images as $image):?>
                    <div class="image">
                        <a href="../imageDetails/imageDetails.php?id=<?=urlencode($image['idImage'])?>"><img src="../../../uploads/<?=htmlspecialchars($image['lien'])?>" alt="Image" height="150" width="200"></a>
                        <p><?=htmlspecialchars($image['description'])?></p>
                        <a href="../homePage/homePage.php?login=<?=urlencode($image['login'])?>">Voir la page de <?=htmlspecialchars($image['login'])?></a>
                    </div>
                <?php endforeach;?>
                </div>
            <?php else:?>
                <p>Aucune image trouvée.</p>
            <?php endif;?>
        <?php endif;?>
    </div>
</body>
</html>