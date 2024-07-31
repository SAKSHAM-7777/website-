<?php
include 'config.php';
include 'header.php';

$query = $pdo->query('SELECT * FROM newSaksham');
$newsItems = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>News</h2>
<?php if (!empty($newsItems)): ?>
    <ul>
        <?php foreach ($newsItems as $newSaksham): ?>
            <li>
                <h3><?= htmlspecialchars($newSaksham['title']) ?></h3>
                <p><?= htmlspecialchars($newSaksham['content']) ?></p>
                <?php if ($newSaksham['image']): ?>
                    <img src="<?= htmlspecialchars($newSaksham['image']) ?>" alt="<?= htmlspecialchars($newSaksham['title']) ?>">
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No news items found.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>