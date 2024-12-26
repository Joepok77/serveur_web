<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['product_id'])) {
    $productId = intval($_GET['product_id']);
    echo "Produit ID : " . $productId;
    // Ajoutez ici le code pour récupérer les détails du produit depuis votre base de données
} else {
    echo "Aucun produit sélectionné.";
    exit();
}

if (!empty($product)): ?>
    <h2><?= htmlspecialchars($product->getName() ?? 'Nom indisponible'); ?></h2>
    
    <!-- Gestion de l'image avec une vérification si le chemin est null -->
    <?php 
        $picture = $product->getPicture();
        $imagePath = !empty($picture) ? "/assets/images/" . htmlspecialchars($picture) 
                                     : "/assets/images/macbookpro.jpg"; 
    ?>
    <img src="<?= $imagePath; ?>" alt="<?= htmlspecialchars($product->getName() ?? 'Image indisponible'); ?>" style="max-width: 300px; height: auto;">

    <p><?= htmlspecialchars($product->getDescription() ?? 'Description non disponible'); ?></p>
    <p>Prix : <?= htmlspecialchars($product->getPrice() !== null ? $product->getPrice() : '0.00'); ?> €</p>

    <!-- Bouton Ajouter au panier -->
    <a href="/panier?action=add&product_id=<?= $product->getId() ?>&product_name=<?= urlencode($product->getName()) ?>&product_price=<?= $product->getPrice() ?>&product_picture=<?= urlencode($product->getPicture()) ?>">
        <button style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Ajouter au panier
        </button>
    </a>
    <br><br>

    <!-- Bouton Retour vers la catégorie -->
    <a href="/catalogue?category_id=<?= htmlspecialchars($_GET['category_id'] ?? ''); ?>">
        <button style="padding: 10px 15px; background-color: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Retour
        </button>
    </a>
<?php else: ?>
    <p>Produit non trouvé.</p>
<?php endif; ?>