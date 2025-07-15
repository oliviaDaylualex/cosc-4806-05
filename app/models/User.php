<?php
require_once __DIR__ . '/../database.php';

class User {
    private $db;
    public function __construct() {
        $this->db = db_connect();
    }

    public function findByUsername(string $u): ?array {
        $stmt = $this->db->prepare("
            SELECT id, username, password_hash, role
              FROM users
             WHERE username = :u
        ");
        $stmt->execute(['u' => $u]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function recordLoginAttempt(string $u, string $status): void {
        $stmt = $this->db->prepare("
            INSERT INTO login_attempts (username, attempt_status, attempted_at)
                         VALUES (:u,       :s,             NOW())
        ");
        $stmt->execute(['u' => $u, 's' => $status]);
    }

    public function getLastFailed(string $u) {
        $stmt = $this->db->prepare("
            SELECT attempted_at
              FROM login_attempts
             WHERE username = :u
               AND attempt_status = 'failure'
             ORDER BY attempted_at DESC
             LIMIT 1
        ");
        $stmt->execute(['u' => $u]);
        return $stmt->fetchColumn();
    }

    public function incrementLoginCount(int $userId): void {
        $stmt = $this->db->prepare("
            UPDATE users
               SET login_count = login_count + 1
             WHERE id = :id
        ");
        $stmt->execute(['id' => $userId]);
    }

    public function getLoginCounts(): array {
        $stmt = $this->db->query("
            SELECT username, login_count
              FROM users
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getLoginsCountByUser() {
        $stmt = $this->db->prepare(
            "SELECT username, COUNT(*) as login_count
             FROM login_attempts
             WHERE attempt_status = 'success'
             GROUP BY username"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}