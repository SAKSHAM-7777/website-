<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare('INSERT INTO userSaksham (username, password) VALUES (?, ?)');
    $stmt->execute([$username, $password]);

    header('Location: login.php');
    exit();
}
?>

<?php include 'header.php'; ?>
<h2>Become a Fan</h2>
<form action="fan.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Register</button>
</form>
<?php include 'footer.php'; ?>

