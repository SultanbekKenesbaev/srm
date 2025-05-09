<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/header.php';
require_once '../includes/sidebar.php';

if ($_SESSION['role'] !== 'mentor') {
    header('Location: /auth/login.php');
    exit;
}

$group_id = $_GET['group_id'] ?? null;

// Проверка: принадлежит ли группа этому ментору
$stmt = $pdo->prepare("SELECT * FROM groups WHERE id = ? AND mentor_id = ?");
$stmt->execute([$group_id, $_SESSION['user_id']]);
$group = $stmt->fetch();

if (!$group) {
    echo "<p>❌ Нет доступа к этой группе.</p>";
    require_once '../includes/footer.php';
    exit;
}

$students = $pdo->prepare("SELECT * FROM students WHERE group_id = ?");
$students->execute([$group_id]);
?>

<div class="container">
    <h2>Студенты группы: <?= htmlspecialchars($group['name']) ?></h2>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $s): ?>
                <tr>
                    <td><?= $s['id'] ?></td>
                    <td><?= htmlspecialchars($s['name']) ?></td>
                    <td><?= htmlspecialchars($s['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
