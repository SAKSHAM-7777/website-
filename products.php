<?php
include 'config.php';
include 'header.php';

$query = $pdo->query('SELECT * FROM productSaksham');
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>My Products</h2>
<div class="products">
    <?php foreach ($products as $productSaksham): ?>
        <div class="productSaksham">
            <img src="sql.php?db=test<?= htmlspecialchars($productSaksham['image']) ?>" alt="<?= htmlspecialchars($productSaksham['name']) ?>">
            <h3><?= htmlspecialchars($productSaksham['name']) ?></h3>
            <p><?= htmlspecialchars($productSaksham['description']) ?></p>
            <p>$<?= htmlspecialchars($productSaksham['price']) ?></p>
            <form action="cart.php" method="post">
                <input type="hidden" name="product_id" value="<?= $productSaksham['id'] ?>">
                <input type="number" name="quantity" value="1" min="1">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>
