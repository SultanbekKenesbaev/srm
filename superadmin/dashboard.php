<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/header.php';
require_once '../includes/sidebar.php';

// Проверка роли
if ($_SESSION['role'] !== 'superadmin') {
    header('Location: /auth/login.php');
    exit;
}

// Получаем список групп с менторами и количеством учеников
$stmt = $pdo->query("
    SELECT g.id, g.name AS group_name, u.name AS mentor_name, 
        (SELECT COUNT(*) FROM students WHERE group_id = g.id) AS student_count
    FROM groups g
    LEFT JOIN users u ON g.mentor_id = u.id
");
$groups = $stmt->fetchAll();
?>

<div class="container">
    <h2>Панель Супер-Админа</h2>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Группа</th>
                <th>Ментор</th>
                <th>Количество учеников</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groups as $group): ?>
                <tr>
                    <td><?= htmlspecialchars($group['group_name']) ?></td>
                    <td><?= htmlspecialchars($group['mentor_name'] ?? 'Не назначен') ?></td>
                    <td><?= $group['student_count'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
