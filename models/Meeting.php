<?php

require_once __DIR__ . '/../config/database.php';

class Meeting {
    private $conn;
    private $table_name = "meetings";

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createMeeting($title, $description, $startTime, $endTime, $creatorId) {
        $query = "INSERT INTO " . $this->table_name . " (title, description, start_time, end_time, creator_id) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssii", $title, $description, $startTime, $endTime, $creatorId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getMeetingsForUser($userId) {
        $query = "SELECT m.id, m.title, m.description, m.start_time, m.end_time, m.creator_id 
                  FROM " . $this->table_name . " m
                  LEFT JOIN meeting_participants mp ON m.id = mp.meeting_id
                  WHERE m.creator_id = ? OR mp.user_id = ?
                  GROUP BY m.id
                  ORDER BY m.start_time ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $userId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addParticipant($meetingId, $userId) {
        $query = "INSERT INTO meeting_participants (meeting_id, user_id, status) VALUES (?, ?, 'pending')";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $meetingId, $userId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateParticipantStatus($meetingId, $userId, $status) {
        $query = "UPDATE meeting_participants SET status = ? WHERE meeting_id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sii", $status, $meetingId, $userId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPendingInvitationsForUser($userId) {
        $query = "SELECT m.id, m.title, m.description, m.start_time, m.end_time, u.name as creator_name
                  FROM " . $this->table_name . " m
                  JOIN meeting_participants mp ON m.id = mp.meeting_id
                  JOIN users u ON m.creator_id = u.id
                  WHERE mp.user_id = ? AND mp.status = 'pending'
                  ORDER BY m.start_time ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>