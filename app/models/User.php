<?php
require_once __DIR__ . '/../database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    public function findByUsername(string $u) {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE username = :u"
        );
        $stmt->execute(['u' => $u]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(string $u, string $pw) {
        $hash = password_hash($pw, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare(
            "INSERT INTO users (username, password_hash) VALUES (:u, :h)"
        );
        return $stmt->execute(['u' => $u, 'h' => $hash]);
    }

    public function recordLoginAttempt(string $u, string $status) {
        $stmt = $this->db->prepare(
            "INSERT INTO login_attempts (username, attempt_status) VALUES (:u, :s)"
        );
        $stmt->execute(['u' => $u, 's' => $status]);
    }

    public function getLastFailed(string $u) {
        $stmt = $this->db->prepare(
            "SELECT attempted_at
             FROM login_attempts
             WHERE username = :u AND attempt_status = 'failure'
             ORDER BY attempted_at DESC
             LIMIT 1"
        );
        $stmt->execute(['u' => $u]);
        return $stmt->fetchColumn();
    }

    public function countRecentFails(string $u, int $secondsAgo) {
        $since = date('Y-m-d H:i:s', time() - $secondsAgo);
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM login_attempts
             WHERE username = :u
               AND attempt_status = 'failure'
               AND attempted_at >= :since"
        );
        $stmt->execute(['u' => $u, 'since' => $since]);
        return (int)$stmt->fetchColumn();
    }
}
