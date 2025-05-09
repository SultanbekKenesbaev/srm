<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ./auth/login.php');
    exit;
}

switch ($_SESSION['role']) {
    case 'superadmin':
        header('Location: /superadmin/dashboard.php');
        break;
    case 'admin':
        header('Location: /admin/dashboard.php');
        break;
    case 'mentor':
        header('Location: /mentor/dashboard.php');
        break;
    default:
        echo "Неизвестная роль пользователя.";
}
exit;
