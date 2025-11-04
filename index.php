<?php
require_once 'config/database.php';
require_once 'controllers/UserController.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

include 'views/templates/header.php';

switch ($page) {
    case 'users':
        $userController = new UserController();
        $userController->index();
        break;
    default:
        include 'views/home.php';
        break;
}

include 'views/templates/footer.php';

?>
