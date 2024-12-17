<h1>Catalogue des Produits</h1>

<h2>Catégories</h2>
<ul>
    <?php foreach ($categories as $category) : ?>
        <li>
            <a href="?category_id=<?= $category->getId(); ?>">
                <?= htmlspecialchars($category->getName()); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<h2>Produits</h2>
<?php if (!empty($products)): ?>
    <h2>Produits</h2>
    <?php foreach ($products as $product): ?>
        <!-- Si un produit est sélectionné, affiche les détails -->
        <?php if (isset($_GET['product_id']) && $_GET['product_id'] == $product->getId()): ?>
            <h3><?= htmlspecialchars($product->getName()) ?></h3>
            <p><?= htmlspecialchars($product->getDescription()) ?></p>
            <img src="<?= htmlspecialchars($product->getPicture()) ?>" alt="<?= htmlspecialchars($product->getName()) ?>" style="max-width: 200px; height: auto;">
            <p>Prix : <?= htmlspecialchars($product->getPrice()) ?> €</p>

            <!-- Bouton Ajouter au panier -->
            <form action="panier.php" method="POST" style="display:inline;">
                <input type="hidden" name="product_id" value="<?= $product->getId() ?>">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product->getName()) ?>">
                <input type="hidden" name="product_price" value="<?= htmlspecialchars($product->getPrice()) ?>">
                <button type="submit">Ajouter au panier</button>
            </form>

            <!-- Bouton Retour vers la catégorie -->
            <a href="catalogue.php?category_id=<?= htmlspecialchars($_GET['category_id']) ?>">
                <button>Retour</button>
            </a>

        <?php else: ?>
            <!-- Affichage général des produits avec le lien Voir le produit -->
            <div>
                <h3><?= htmlspecialchars($product->getName()) ?></h3>
                <img src="<?= htmlspecialchars($product->getPicture()) ?>" alt="<?= htmlspecialchars($product->getName()) ?>" style="max-width: 150px; height: auto;">
                <p>Prix : <?= htmlspecialchars($product->getPrice()) ?> €</p>
                
                <!-- Bouton Voir le produit -->
                <a href="index.php?route=detail&product_id=<?= $product->getId(); ?>">
                    <button>Voir le produit</button>
                </a>

                <!-- Bouton Ajouter au panier -->
                <form action="index.php?route=panier" method="POST" style="display:inline;">
                    <input type="hidden" name="product_id" value="<?= $product->getId() ?>">
                    <input type="hidden" name="product_name" value="<?= htmlspecialchars($product->getName()) ?>">
                    <input type="hidden" name="product_price" value="<?= htmlspecialchars($product->getPrice()) ?>">
                    <button type="submit">Ajouter au panier</button>
                </form>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun produit trouvé pour cette catégorie.</p>
<?php endif; ?>
