<?php
require_once 'config/database.php';
require_once 'controllers/UserController.php';
require_once 'controllers/MeetingController.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : null;

if ($action) {
    $userController = new UserController();
    $meetingController = new MeetingController();
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
        case 'create_meeting':
            $meetingController->createMeeting();
            break;
        case 'invite_participant':
            $meetingController->inviteParticipant();
            break;
        case 'update_status':
            $meetingController->updateParticipantStatus();
            break;
    }
} else {
    include 'views/templates/header.php';

    switch ($page) {
        case 'users':
            $userController = new UserController();
            $userController->index();
            break;
        case 'register':
            include 'views/pages/register.php';
            break;
        case 'login':
            include 'views/pages/login.php';
            break;
        case 'dashboard':
            include 'views/pages/dashboard.php';
            break;
        case 'profile':
            $userController = new UserController();
            $userController->showProfile();
            break;
        default:
            include 'views/home.php';
            break;
    }

    include 'views/templates/footer.php';
}

?>
