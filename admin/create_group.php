<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/header.php';
require_once '../includes/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $stmt = $pdo->prepare("INSERT INTO groups (name, created_by) VALUES (?, ?)");
    $stmt->execute([$name, $_SESSION['user_id']]);
    echo "<p>✅ Группа успешно создана.</p>";
}
?>

<div class="container">
    <h2>Создать группу</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Название группы" required>
        <button type="submit">Создать</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
