<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/header.php';
require_once '../includes/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

$groups = $pdo->query("SELECT * FROM groups")->fetchAll();
$mentors = $pdo->query("SELECT * FROM users WHERE role = 'mentor'")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $group_id = $_POST['group_id'];
    $mentor_id = $_POST['mentor_id'];
    $stmt = $pdo->prepare("UPDATE groups SET mentor_id = ? WHERE id = ?");
    $stmt->execute([$mentor_id, $group_id]);
    echo "<p>✅ Ментор назначен группе.</p>";
}
?>

<div class="container">
    <h2>Назначить ментора группе</h2>
    <form method="post">
        <select name="group_id" required>
            <option value="">Выберите группу</option>
            <?php foreach ($groups as $g): ?>
                <option value="<?= $g['id'] ?>"><?= htmlspecialchars($g['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <select name="mentor_id" required>
            <option value="">Выберите ментора</option>
            <?php foreach ($mentors as $m): ?>
                <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Назначить</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
