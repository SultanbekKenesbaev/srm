<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CRM-система</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
<header>
    <h1>CRM-система</h1>
    <p>Привет, <?= $_SESSION['name'] ?? 'Гость' ?></p>
</header>
