<?php

require_once __DIR__ . '/../config/database.php';

class User {
    private $conn;
    private $table_name = "users";

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createUser($name, $email, $password) {
        $query = "INSERT INTO " . $this->table_name . " (name, email, password) VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email) {
        $query = "SELECT id, name, email, password FROM " . $this->table_name . " WHERE email = ? LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function searchUsers($searchTerm) {
        $searchTerm = "%%" . $searchTerm . "%%";
        $query = "SELECT id, name, email FROM " . $this->table_name . " WHERE name LIKE ? OR email LIKE ? LIMIT 10";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>