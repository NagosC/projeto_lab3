<?php

require_once __DIR__ . '/../models/User.php';

class UserController {
    public function handleRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $userModel = new User();
            $userModel->createUser($name, $email, $hashedPassword);

            // Redirect to login page after successful registration
            header('Location: /views/pages/login.php');
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
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];

                header('Location: /views/pages/dashboard.php');
                exit();
            } else {
                // Handle login error (e.g., display error message)
                header('Location: /views/pages/login.php?error=invalid_credentials');
                exit();
            }
        }
    }

    public function handleLogout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /views/pages/login.php');
        exit();
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $userController = new UserController();

    switch ($action) {
        case 'register':
            $userController->handleRegister();
            break;
        case 'login':
            $userController->handleLogin();
            break;
        case 'logout':
            $userController->handleLogout();
            break;
        // Add other cases for logout, etc.
    }
}

?>