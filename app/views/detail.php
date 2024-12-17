<?php if (!empty($product)): ?>
    
    <h2><?= htmlspecialchars($product->getName()); ?></h2>
    <img src="<?= $_SERVER['BASE_URI'] ?>assets/images/<?= htmlspecialchars($product->getPicture()) ?>" alt="<?= htmlspecialchars($product->getName()) ?>">


    <p><?= htmlspecialchars($product->getDescription()); ?></p>
    <p>Prix : <?= htmlspecialchars($product->getPrice()); ?> €</p>

    <!-- Bouton Ajouter au panier -->
    <form action="panier.php" method="POST">
        <input type="hidden" name="product_id" value="<?= $product->getId(); ?>">
        <button type="submit">Ajouter au panier</button>
    </form>

    <!-- Bouton Retour vers la catégorie -->
    <a href="index.php?route=catalogue&category_id=<?= htmlspecialchars($_GET['category_id']); ?>">
        <button>Retour</button>
    </a>
<?php else: ?>
    <p>Produit non trouvé.</p>
<?php endif; ?>
