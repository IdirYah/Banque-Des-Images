<?php
require_once '../../../config/db.php'; 
$sql = "SELECT * FROM Utilisateur";
$result = $conn->query($sql);
?>
<div id="sideBar">
    <a><div><img src="../../../assets/rechercher.png"><span> Rechercher</span></div></a>
    <a href="../../pages/ajoutImage/ajoutImage.php"><div><img src="../../../assets/ajouter.png"><span> Ajouter une image</span></div></a>
    <div><img src="../../../assets/deconnexion.png"><span id="logout"> Déconnexion</span></div>
    <div id="contacts">
        <h1>Contacts</h1>
        <div id="contactsList">
            <?php while ($row = $result->fetch_assoc()):?>
            <div class="contact" data-login="<?=htmlspecialchars($row['login'])?>">
                <p><?=htmlspecialchars($row['prenom'])?> <?= htmlspecialchars($row['nom'])?></p>
                <div>
                    <a href="../../pages/homePage/homePage.php?login=<?=urlencode($row['login'])?>"><img src="../../../assets/contacts.png"></a>
                    <a href="../../pages/commentPage/commentPage.php?login=<?=urlencode($row['login'])?>"><img src="../../../assets/commentaire.png"></a>
                </div>
            </div>
            <?php endwhile;?>
        </div>
    </div>
</div>
