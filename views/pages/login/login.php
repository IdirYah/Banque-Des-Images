<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login Page</title>
</head>
<body>
    <?php if (isset($_SESSION['error'])): ?>
        <script>
            alert("<?= addslashes($_SESSION['error']) ?>");
        </script>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <div id="side"><p>Bienvenue dans notre banque d'images</p></div>
    <div id="login">
        <h1>Bienvenue dans notre banque d'images</h1>
        <p>Connexion</p>
        <form method="POST" action="../../../controllers/loginController.php">
            <div>
                <input type="text" name="login" placeholder="Login">
                <input type="password" name="password" placeholder="Mot de passe">
                <button type="submit">Se connecter</button>
                <span>Pas encore inscrit ? <a href="../register/register.php">Inscrivez-vous ici</a></span>
            </div>
        </form>
    </div>
</body>
</html>