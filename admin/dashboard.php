<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/header.php';
require_once '../includes/sidebar.php';

if ($_SESSION['role'] !== 'admin') {
    header('Location: /auth/login.php');
    exit;
}
?>

<div class="container">
    <h2>Добро пожаловать, <?= $_SESSION['name'] ?>!</h2>
    <p>Это ваша админ-панель.</p>
</div>

<?php require_once '../includes/footer.php'; ?>
