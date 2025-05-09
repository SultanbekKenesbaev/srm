<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';

if ($_SESSION['role'] !== 'superadmin') {
    die("Доступ запрещен");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $password, $role]);

    echo "<p>Пользователь успешно зарегистрирован!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация пользователя</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Создать пользователя</h2>
        <form method="post">
            <input type="text" name="name" placeholder="Имя" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Пароль" required><br>
            <select name="role" required>
                <option value="admin">Админ</option>
                <option value="mentor">Ментор</option>
            </select><br>
            <button type="submit">Создать</button>
        </form>
    </div>
</body>
</html>
