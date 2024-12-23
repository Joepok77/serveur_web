<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!empty($product)): ?>
    <h2><?= htmlspecialchars($product->getName() ?? 'Nom indisponible'); ?></h2>
    
    <!-- Gestion de l'image avec une vérification si le chemin est null -->
    <?php 
        $picture = $product->getPicture();
        $imagePath = !empty($picture) ? $_SERVER['BASE_URI'] . "assets/images/" . htmlspecialchars($picture) 
                                     : $_SERVER['BASE_URI'] . "assets/images/macbookpro.jpg"; 
    ?>
    <img src="<?= $imagePath; ?>" alt="<?= htmlspecialchars($product->getName() ?? 'Image indisponible'); ?>" style="max-width: 300px; height: auto;">

    <p><?= htmlspecialchars($product->getDescription() ?? 'Description non disponible'); ?></p>
    <p>Prix : <?= htmlspecialchars($product->getPrice() !== null ? $product->getPrice() : '0.00'); ?> €</p>

    <form action="index.php?route=panier" method="POST">
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="product_id" value="1">
    <input type="hidden" name="product_name" value="Produit 1">
    <input type="hidden" name="product_price" value="100">
    <button type="submit">Ajouter au panier</button>
</form>








    <!-- Bouton Retour vers la catégorie -->
    <a href="index.php?route=catalogue&category_id=<?= htmlspecialchars($_GET['category_id'] ?? ''); ?>">
        <button>Retour</button>
    </a>
<?php else: ?>
    <p>Produit non trouvé.</p>
<?php endif; ?> 