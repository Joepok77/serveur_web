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

<!-- Affichage des produits en fonction de la catégorie sélectionnée -->
<h2>Produits</h2>
<?php 

if (!empty($selected_category) && !empty($products)): ?>
    <p>Produits dans la catégorie : <strong><?= htmlspecialchars($categories[array_search($selected_category, array_column($categories, 'id'))]->name) ?></strong></p>
    <?php 
    foreach ($products as $product): ?>
       
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <h3><?= htmlspecialchars($product->getName()) ?></h3>
            <img src="assets/images/macbookpro.jpeg.jpeg" 
                 alt="Image du produit" 
                 style="max-width: 150px; height: auto;">
                 <p>Prix : <?= htmlspecialchars($product->getPrice()) ?> €</p>
            
       



            <!-- Lien vers les détails du produit -->
            <a href="?category_id=<?= $selected_category ?>&product_id=<?= $product->id ?>">
                <button>Voir le produit</button>
            </a>

            <!-- Formulaire pour ajouter au panier -->
            <form action="index.php?route=panier" method="POST">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="product_id" value="<?= $product->id ?>">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product->name) ?>">
                <input type="hidden" name="product_price" value="<?= htmlspecialchars($product->price) ?>">
                <button type="submit">Ajouter au panier</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php elseif (!empty($selected_category)): ?>
    <p>Aucun produit trouvé pour cette catégorie.</p>
<?php else: ?>
    <p>Sélectionnez une catégorie pour afficher ses produits.</p>
<?php endif; ?>

<!-- Affichage des détails d'un produit si sélectionné -->
<?php if (!empty($productDetails)): ?>
    <h2>Détails du produit</h2>
    <div>
        <h3><?= htmlspecialchars($productDetails->name) ?></h3>
        <img src="assets/images/macbookpro.jpeg" 
             alt="Image du produit" 
             style="max-width: 150px; height: auto;">
        <p>Prix : <?= htmlspecialchars($productDetails->price) ?> €</p>
        <p>Description : <?= htmlspecialchars($productDetails->description) ?></p>
    </div>
<?php endif; ?>