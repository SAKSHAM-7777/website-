<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['news_title'])) {
        $title = $_POST['news_title'];
        $content = $_POST['news_content'];
        $imagePath = null;

        if (isset($_FILES['news_image'])) {
            $imagePath = 'assets/img/' . basename($_FILES['news_image']['name']);
            move_uploaded_file($_FILES['news_image']['tmp_name'], $imagePath);
        }

        $stmt = $pdo->prepare('INSERT INTO newSaksham (title, content, image) VALUES (?, ?, ?)');
        $stmt->execute([$title, $content, $imagePath]);
    }

    if (isset($_POST['product_name'])) {
        $name = $_POST['product_name'];
        $description = $_POST['product_description'];
        $price = $_POST['product_price'];
        $imagePath = 'assets/img/' . basename($_FILES['product_image']['name']);
        move_uploaded_file($_FILES['product_image']['tmp_name'], $imagePath);

        $stmt = $pdo->prepare('INSERT INTO productSaksham (name, description, price, image) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $description, $price, $imagePath]);
    }
}
?>

<?php include 'header.php'; ?>
<h2>Admin Page</h2>
<form action="admin.php" method="post" enctype="multipart/form-data">
    <h3>Add News</h3>
    <label for="news_title">Title:</label>
    <input type="text" id="news_title" name="news_title" required>
    <label for="news_content">Content:</label>
    <textarea id="news_content" name="news_content" required></textarea>
    <label for="news_image">Image:</label>
    <input type="file" id="news_image" name="news_image">
    <button type="submit">Add News</button>
</form>

<form action="admin.php" method="post" enctype="multipart/form-data">
    <h3>Add Product</h3>
    <label for="product_name">Name:</label>
    <input type="text" id="product_name" name="product_name" required>
    <label for="product_description">Description:</label>
    <textarea id="product_description" name="product_description" required></textarea>
    <label for="product_price">Price:</label>
    <input type="number" id="product_price" name="product_price" step="0.01" required>
    <label for="product_image">Image:</label>
    <input type="file" id="product_image" name="product_image" required>
    <button type="submit">Add Product</button>
</form>
<?php include 'footer.php'; ?>
