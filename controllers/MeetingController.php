<?php

require_once __DIR__ . '/../models/Meeting.php';

class MeetingController {
    public function createMeeting() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /views/pages/login.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $startTime = $_POST['start_time'];
            $endTime = $_POST['end_time'];
            $creatorId = $_SESSION['user_id'];

            $meetingModel = new Meeting();
            $meetingModel->createMeeting($title, $description, $startTime, $endTime, $creatorId);

            header('Location: /views/pages/dashboard.php');
            exit();
        }
    }

    public function inviteParticipant() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /views/pages/login.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $meetingId = $_POST['meeting_id'];
            $userId = $_POST['user_id'];

            $meetingModel = new Meeting();
            $meetingModel->addParticipant($meetingId, $userId);

            header('Location: /views/pages/dashboard.php');
            exit();
        }
    }

    public function updateStatus() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /views/pages/login.php');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $meetingId = $_POST['meeting_id'];
            $userId = $_POST['user_id'];
            $status = $_POST['status'];

            $meetingModel = new Meeting();
            $meetingModel->updateParticipantStatus($meetingId, $userId, $status);

            header('Location: /views/pages/dashboard.php');
            exit();
        }
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $meetingController = new MeetingController();

    switch ($action) {
        case 'create':
            $meetingController->createMeeting();
            break;
        case 'invite':
            $meetingController->inviteParticipant();
            break;
        case 'update_status':
            $meetingController->updateStatus();
            break;
        // Add other cases for showing calendar, etc.
    }
}

?>