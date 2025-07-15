<?php
require_once __DIR__ . '/../database.php';

class Reminder {
    private PDO $db;

    public function __construct() {
        $this->db = db_connect();
    }

    
    public function allForUser(int $userId): array {
        $stmt = $this->db->prepare(
            "SELECT id, subject, created_at, completed
               FROM reminders
              WHERE user_id = :uid
                AND deleted = 0
              ORDER BY created_at DESC"
        );
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  
    public function create(int $userId, string $subject): bool {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO reminders
                    (user_id, subject, created_at, completed, deleted)
                 VALUES
                    (:uid, :sub, NOW(), 0, 0)"
            );
            $stmt->execute([
                'uid' => $userId,
                'sub' => $subject
            ]);
            return true;
        } catch (PDOException $e) {
           
            error_log('Reminder::create failed — ' . $e->getMessage());
            return false;
        }
    }

    
    public function markCompleted(int $id): bool {
        $stmt = $this->db->prepare(
            "UPDATE reminders
                SET completed = 1
              WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }

   
    public function delete(int $id): bool {
        $stmt = $this->db->prepare(
            "UPDATE reminders
                SET deleted = 1
              WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }
}
