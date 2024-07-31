<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: register.php');
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_photo'])) {
    $photoPath = 'assets/img/' . basename($_FILES['profile_photo']['name']);
    move_uploaded_file($_FILES['profile_photo']['tmp_name'], $photoPath);

    $stmt = $pdo->prepare('UPDATE userSaksham SET profile_photo = ? WHERE id = ?');
    $stmt->execute([$photoPath, $userId]);
}

$stmt = $pdo->prepare('SELECT * FROM userSaksham WHERE id = ?');
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>
<h2>FAN Page</h2>
<p>Welcome, <?= htmlspecialchars($user['username']) ?>!</p>
<?php if ($user['profile_photo']): ?>
    <img src="<?= htmlspecialchars($userSaksham['profile_photo']) ?>" alt="Profile Photo">
<?php endif; ?>
<form action="news.php" method="post" enctype="multipart/form-data">
    <label for="profile_photo">Upload Profile Photo:</label>
    <input type="file" id="profile_photo" name="profile_photo">
    <button type="submit">Upload</button>
</form>
<?php include 'footer.php'; ?>

