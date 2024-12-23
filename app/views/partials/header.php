<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?=$absoluteURL?>/assets/css/styles.css">
  <title>Edenskin</title>
</head>

<body>
<header>
    <div class="logo">
        <h1>Edenskin</h1>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="user-welcome">
            Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?> !
        </div>
    <?php endif; ?>

    <nav class="nav">
        <ul>
            <li><a href="/">Accueil</a></li>
            <li><a href="/catalogue">Catalogue</a></li>
            <li><a href="/panier">Panier</a></li>

            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="/logout">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="/login">Connexion</a></li>
                <li><a href="/register">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
</body>
</html>