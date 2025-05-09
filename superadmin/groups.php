<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/header.php';
require_once '../includes/sidebar.php';

if ($_SESSION['role'] !== 'superadmin') {
    header('Location: /auth/login.php');
    exit;
}

$groups = $pdo->query("
    SELECT g.*, u.name AS mentor_name
    FROM groups g
    LEFT JOIN users u ON g.mentor_id = u.id
")->fetchAll();
?>

<div class="container">
    <h2>Все группы</h2>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Ментор</th>
                <th>Создал</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groups as $g): ?>
                <tr>
                    <td><?= $g['id'] ?></td>
                    <td><?= htmlspecialchars($g['name']) ?></td>
                    <td><?= htmlspecialchars($g['mentor_name'] ?? 'Не назначен') ?></td>
                    <td><?= $g['created_by'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
