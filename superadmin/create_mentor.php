<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/header.php';
require_once '../includes/sidebar.php';

if ($_SESSION['role'] !== 'superadmin') {
    header('Location: /auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'mentor')");
    $stmt->execute([$name, $email, $password]);
    echo "<p>✅ Ментор успешно создан.</p>";
}
?>

<div class="container">
    <h2>Создать ментора</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Имя" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Создать</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
