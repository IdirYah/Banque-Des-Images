<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Register Page</title>
</head>
<body>
    <?php if (isset($_SESSION['error'])): ?>
        <script>
            alert("<?= addslashes($_SESSION['error']) ?>");
        </script>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <div id="side"><p>Bienvenue dans notre banque d'images</p></div>
    <div id="register">
        <h1>Bienvenue dans notre banque d'images</h1>
        <p>Inscription</p>
        <form method="POST" action="../../../controllers/registerController.php">
            <div>
                <input type="text" name="nom" placeholder="Nom">
                <input type="text" name="prenom" placeholder="Prénom">
                <input type="text" name="email" placeholder="Email">
                <input type="text" name="login" placeholder="Login">
                <input type="password" name="password" placeholder="Mot de passe">
                <button type="submit">S'inscrire</button>
                <span>Avez-vous déjà un compte ? <a href="../login/login.php">Connectez-vous ici</a></span>
            </div>
        </form>
    </div>
</body>
</html>