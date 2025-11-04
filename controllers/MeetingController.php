<?php

require_once __DIR__ . '/../models/Meeting.php';

class MeetingController {
    public function createMeeting() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
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

            header('Location: index.php?page=dashboard');
            exit();
        }
    }

    public function inviteParticipant() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $meetingId = $_POST['meeting_id'];
            $userId = $_POST['user_id'];

            $meetingModel = new Meeting();
            $meetingModel->addParticipant($meetingId, $userId);

            header('Location: index.php?page=dashboard');
            exit();
        }
    }

    public function updateParticipantStatus() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $meetingId = $_POST['meeting_id'];
            $status = $_POST['status'];
            $userId = $_SESSION['user_id'];

            $meetingModel = new Meeting();
            $meetingModel->updateParticipantStatus($meetingId, $userId, $status);

            header('Location: index.php?page=dashboard');
            exit();
        }
    }
}
?>