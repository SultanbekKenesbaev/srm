<?php
session_start();
require_once '../includes/db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];

        // Редирект по ролям
        if ($user['role'] === 'superadmin') {
            header("Location: /superadmin/dashboard.php");
        } elseif ($user['role'] === 'admin') {
            header("Location: /admin/dashboard.php");
        } elseif ($user['role'] === 'mentor') {
            header("Location: /mentor/dashboard.php");
        } else {
            $error = 'Неизвестная роль';
        }
        exit;
    } else {
        $error = 'Неверный логин или пароль';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Вход</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Вход</h2>
        <?php if ($error): ?>
            <p style="color:red"><?= $error ?></p>
        <?php endif; ?>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Пароль" required><br>
            <button type="submit">Войти</button>
        </form>
    </div>
</body>
</html>
