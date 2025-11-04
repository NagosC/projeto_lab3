<?php
require_once 'config/database.php';
require_once 'controllers/UserController.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

?>
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
            </ul>
        </nav>
    </header>

    <main>
        <?php
        switch ($page) {
            case 'users':
                $userController = new UserController();
                $userController->index();
                break;
            default:
                include 'views/home.php';
                break;
        }
        ?>
    </main>

    <footer>
        <p>&copy; 2025 Projeto Lab 3</p>
    </footer>
</body>
</html>
