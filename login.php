<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM userSaksham WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];

        header('Location: news.php');
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<?php include 'header.php'; ?>
<h2>Login</h2>
<?php if (isset($error)): ?>
    <p><?= $error ?></p>
<?php endif; ?>
<form action="news.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Login</button>
</form>
<?php include 'footer.php'; ?>
