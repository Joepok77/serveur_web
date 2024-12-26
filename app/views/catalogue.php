<h1>Catégories des produits</h1>

<div style="margin-bottom: 20px;">
    <?php foreach ($categories as $category): ?>
        <form action="" method="GET" style="display: inline;">
            <input type="hidden" name="category_id" value="<?= $category->getId() ?>">
            <button type="submit" style="padding: 10px 15px; margin: 5px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                <?= htmlspecialchars($category->getName()) ?>
            </button>
        </form>
    <?php endforeach; ?>
</div>

<?php if ($selected_category): ?>
    <h2>Produits par catégorie</h2>
    <?php if (!empty($products)): ?>
        <p>Produits dans la catégorie : <strong><?= htmlspecialchars($categories[array_search($selected_category, array_column($categories, 'id'))]->getName()) ?></strong></p>
        <?php foreach ($products as $product): ?>
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <h3><?= htmlspecialchars($product->getName()) ?></h3>
                <p><?= htmlspecialchars($product->getDescription()) ?></p>
                <img src="assets/images/<?= htmlspecialchars($product->getPicture()) ?>" 
                     alt="<?= htmlspecialchars($product->getName()) ?>" 
                     style="max-width: 150px; height: auto;">
                <p>Prix : <?= htmlspecialchars($product->getPrice()) ?> €</p>

                <!-- Boutons -->
                <div style="margin-top: 10px;">
                    <!-- Bouton Voir le produit -->
                    <a href="detail.php?product_id=<?= $product->getId() ?>">
                        <button style="padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            Voir le produit
                        </button>
                    </a>

                    <!-- Bouton Ajouter au panier -->
                    <form action="panier.php" method="POST" style="display: inline;">
                        <input type="hidden" name="product_id" value="<?= $product->getId() ?>">
                        <input type="hidden" name="product_name" value="<?= htmlspecialchars($product->getName()) ?>">
                        <input type="hidden" name="product_price" value="<?= htmlspecialchars($product->getPrice()) ?>">
                        <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            Ajouter au panier
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun produit trouvé pour cette catégorie.</p>
    <?php endif; ?>

    <!-- Bouton Retour au catalogue -->
    <form action="" method="GET">
        <button type="submit" style="padding: 10px 15px; margin: 5px; background-color: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Retour au catalogue
        </button>
    </form>
<?php else: ?>
    <h2>Tous les produits</h2>
    <section class="produits">
        <?php foreach ($allProducts as $product): ?>
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <h3><?= htmlspecialchars($product->getName()) ?></h3>
                <p><?= htmlspecialchars($product->getDescription()) ?></p>
                <img src="assets/images/<?= htmlspecialchars($product->getPicture()) ?>" 
                     alt="<?= htmlspecialchars($product->getName()) ?>" 
                     style="max-width: 150px; height: auto;">
                <p>Prix : <?= htmlspecialchars($product->getPrice()) ?> €</p>

                <!-- Boutons -->
                <div style="margin-top: 10px;">
                    <!-- Bouton Voir le produit -->
                    <a href="detail.php?product_id=<?= $product->getId() ?>">

                        <button style="padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            Voir le produit
                        </button>
                    </a>

                    <!-- Bouton Ajouter au panier -->
                    <form action="panier.php" method="POST" style="display: inline;">
                        <input type="hidden" name="product_id" value="<?= $product->getId() ?>">
                        <input type="hidden" name="product_name" value="<?= htmlspecialchars($product->getName()) ?>">
                        <input type="hidden" name="product_price" value="<?= htmlspecialchars($product->getPrice()) ?>">
                        <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            Ajouter au panier
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
<?php endif; ?>
