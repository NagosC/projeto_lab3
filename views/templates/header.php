<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Projeto Lab 3</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>
    <header>
        <h1>Projeto Lab 3</h1>
        <nav>
            <ul>
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="index.php?page=users">Users</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="index.php?page=profile">Profile</a></li>
                    <li><a href="index.php?action=logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="index.php?page=login">Login</a></li>
                    <li><a href="index.php?page=register">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
