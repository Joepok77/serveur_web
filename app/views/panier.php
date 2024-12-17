<?php
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Ajouter un produit au panier si les données sont envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = [
        'id' => $_POST['product_id'],
        'name' => $_POST['product_name'],
        'price' => $_POST['product_price'],
        'quantity' => 1, // Par défaut, on ajoute 1 produit
    ];

    // Ajouter le produit au panier
    $_SESSION['panier'][] = $product;

    // Redirection pour éviter le renvoi du formulaire
    header('Location: panier.php');
    exit;
}

// Afficher le panier
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
</head>
<body>
    <h1>Votre Panier</h1>

    <?php if (!empty($_SESSION['panier'])): ?>
        <ul>
            <?php foreach ($_SESSION['panier'] as $item): ?>
                <li>
                    <?= htmlspecialchars($item['name']) ?> - 
                    <?= htmlspecialchars($item['price']) ?> € - 
                    Quantité : <?= $item['quantity'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>

    <a href="catalogue.php">Retour au catalogue</a>
</body>
</html>
