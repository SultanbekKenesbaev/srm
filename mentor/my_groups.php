<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/header.php';
require_once '../includes/sidebar.php';

if ($_SESSION['role'] !== 'mentor') {
    header('Location: /auth/login.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM groups WHERE mentor_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$groups = $stmt->fetchAll();
?>

<div class="container">
    <h2>Мои группы</h2>
    <ul>
        <?php foreach ($groups as $group): ?>
            <li>
                <?= htmlspecialchars($group['name']) ?> — 
                <a href="group_students.php?group_id=<?= $group['id'] ?>">Студенты</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php require_once '../includes/footer.php'; ?>
