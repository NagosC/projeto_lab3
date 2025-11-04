<?php
require_once 'models/User.php';

class UserController {
    public function index() {
        $user = new User();
        $users = $user->getAllUsers();
        include 'views/users/index.php';
    }
}
?>
