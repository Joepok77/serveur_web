<h1>Votre Panier</h1>

<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!empty($_SESSION['panier'])): ?>
    <ul>
        <?php foreach ($_SESSION['panier'] as $index => $item): ?>
            <li>
                <?= htmlspecialchars($item['name']) ?> - 
                <?= $item['quantity'] ?> x <?= number_format($item['price'], 2) ?> €

                <!-- Bouton pour ajouter une unité -->
<form action="index.php?route=panier_modifier" method="POST" style="display:inline;">
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="product_index" value="<?= $index ?>">
    <button type="submit">+</button>
</form>

<!-- Bouton pour retirer une unité -->
<form action="index.php?route=panier_modifier" method="POST" style="display:inline;">
    <input type="hidden" name="action" value="remove">
    <input type="hidden" name="product_index" value="<?= $index ?>">
    <button type="submit">-</button>
</form>

            </li>
        <?php endforeach; ?>
    </ul>
    <p>Total : <?= number_format(array_sum(array_map(function($item) {
        return $item['price'] * $item['quantity'];
    }, $_SESSION['panier'])), 2) ?> €</p>
<?php else: ?>
    <p>Votre panier est vide.</p>
<?php endif; ?>
