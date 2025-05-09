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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $group_id = $_POST['group_id'];
    $stmt = $pdo->prepare("INSERT INTO students (name, email, group_id) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $group_id]);
    echo "<p>✅ Студент добавлен.</p>";
}
?>

<div class="container">
    <h2>Добавить студента</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Имя" required>
        <input type="email" name="email" placeholder="Email" required>
        <select name="group_id" required>
            <option value="">Выберите группу</option>
            <?php foreach ($groups as $g): ?>
                <option value="<?= $g['id'] ?>"><?= htmlspecialchars($g['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Добавить</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
