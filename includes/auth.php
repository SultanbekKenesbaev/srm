<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /auth/login.php");
    exit;
}

// Функции для проверки ролей
function is_superadmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'superadmin';
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function is_mentor() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'mentor';
}
