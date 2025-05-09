<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/header.php';
require_once '../includes/sidebar.php';

if ($_SESSION['role'] !== 'mentor') {
    header('Location: /auth/login.php');
    exit;
}
?>

<div class="container">
    <h2>Панель ментора</h2>
    <p>Добро пожаловать, <?= $_SESSION['name'] ?>!</p>
</div>

<?php require_once '../includes/footer.php'; ?>
