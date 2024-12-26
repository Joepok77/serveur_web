<h2>Votre panier</h2>
<?php
 if (!empty($panier)): ?>
    <table border="1" cellspacing="0" cellpadding="10" style="width: 100%; text-align: left; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $totalPrice = 0;
            foreach ($panier as $item): 
                $totalPrice += $item['price'] * $item['quantity'];
            ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= htmlspecialchars(number_format($item['price'], 2)) ?> €</td>
                    <td>
                        <a href="/panier?action=update&product_id=<?= $item['id'] ?>&quantity=<?= $item['quantity'] - 1 ?>" 
                           <?= $item['quantity'] <= 1 ? 'style="pointer-events: none; color: gray;"' : '' ?>>-</a>
                        <span style="margin: 0 10px;"><?= $item['quantity'] ?></span>
                        <a href="/panier?action=update&product_id=<?= $item['id'] ?>&quantity=<?= $item['quantity'] + 1 ?>">+</a>
                    </td>
                    <td><?= htmlspecialchars(number_format($item['price'] * $item['quantity'], 2)) ?> €</td>
                    <td>
                        <a href="/panier?action=remove&product_id=<?= $item['id'] ?>" style="color: red;">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="margin-top: 20px; text-align: right;">
        <strong>Prix total : <?= htmlspecialchars(number_format($totalPrice, 2)) ?> €</strong>
    </div>

    <!-- Boutons -->
    <div style="margin-top: 20px;">
        <a href="/panier?action=validate">
            <button style="padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Valider le panier
            </button>
        </a>

        <a href="/">
            <button style="padding: 10px 15px; background-color: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">
                Retour à l'accueil
            </button>
        </a>

        <a href="/catalogue">
            <button style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">
                Retour au catalogue
            </button>
        </a>
    </div>
<?php else: ?>
    <p>Votre panier est vide.</p>
<?php endif; ?>
