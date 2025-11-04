<?php

require_once __DIR__ . '/../config/database.php';

class Meeting {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function createMeeting($title, $description, $startTime, $endTime, $creatorId) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO meetings (title, description, start_time, end_time, creator_id) VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$title, $description, $startTime, $endTime, $creatorId]);
    }

    public function getMeetingsForUser($userId) {
        $stmt = $this->pdo->prepare(
            "SELECT m.id, m.title, m.description, m.start_time, m.end_time, m.creator_id " . 
            "FROM meetings m " . 
            "LEFT JOIN meeting_participants mp ON m.id = mp.meeting_id " . 
            "WHERE m.creator_id = ? OR mp.user_id = ? " . 
            "GROUP BY m.id " . 
            "ORDER BY m.start_time ASC"
        );
        $stmt->execute([$userId, $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addParticipant($meetingId, $userId) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO meeting_participants (meeting_id, user_id, status) VALUES (?, ?, 'pending')"
        );
        return $stmt->execute([$meetingId, $userId]);
    }

    public function getPendingInvitationsForUser($userId) {
        $stmt = $this->pdo->prepare(
            "SELECT m.id, m.title, m.description, m.start_time, m.end_time, u.name as creator_name " . 
            "FROM meetings m " . 
            "JOIN meeting_participants mp ON m.id = mp.meeting_id " . 
            "JOIN users u ON m.creator_id = u.id " . 
            "WHERE mp.user_id = ? AND mp.status = 'pending' " . 
            "ORDER BY m.start_time ASC"
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateParticipantStatus($meetingId, $userId, $status) {
        $stmt = $this->pdo->prepare(
            "UPDATE meeting_participants SET status = ? WHERE meeting_id = ? AND user_id = ?"
        );
        return $stmt->execute([$status, $meetingId, $userId]);
    }
}
?>