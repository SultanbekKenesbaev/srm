<?php
// Настройки подключения к базе данных
define('DB_HOST', 'localhost');       // Адрес сервера MySQL (обычно localhost)
define('DB_NAME', 'srm');      // Имя базы данных
define('DB_USER', 'root');            // Имя пользователя MySQL (по умолчанию root)
define('DB_PASS', 'root');                // Пароль пользователя MySQL (по умолчанию пустой)

try {
    // Подключение к базе данных
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Устанавливаем режим ошибок
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // В случае ошибки выводим сообщение
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>
