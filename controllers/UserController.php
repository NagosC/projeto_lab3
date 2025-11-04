<?php
session_start();
require_once 'models/User.php';

class UserController {
    public function index() {
        $user = new User();
        $users = $user->getAllUsers();
        include 'views/users/index.php';
    }

    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $user->createUser($name, $email, $password);

            header('Location: index.php?page=login');
            exit();
        }
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->findUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                header('Location: index.php?page=dashboard');
                exit();
            } else {
                header('Location: index.php?page=login');
                exit();
            }
        }
    }

    public function handleLogout() {
        session_destroy();
        header('Location: index.php?page=home');
        exit();
    }

    public function showProfile() {
        include 'views/pages/profile.php';
    }
}
?>
