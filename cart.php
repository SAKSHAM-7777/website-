<?php
include 'config.php';
include 'header.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $productIds = implode(',', array_keys($_SESSION['cart']));
    $query = $pdo->query("SELECT * FROM productSaksham WHERE id IN ($productIds)");
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    $products = [];
}
?>

<h2>Shopping Cart</h2>
<?php if (!empty($products)): ?>
    <ul>
        <?php foreach ($products as $productSaksham): ?>
            <li>
                <?= htmlspecialchars($productSaksham['name']) ?> - <?= $_SESSION['cart'][$productSaksham['id']] ?> x $<?= htmlspecialchars($productSaksham['price']) ?> 
                = $<?= $_SESSION['cart'][$productSaksham['id']] * $productSaksham['price'] ?>
                <form action="remove_from_cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?= $productSaksham['id'] ?>">
                    <button type="submit">Remove</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
