<?php


class Reminders extends Controller {
    public function __construct() {
        parent::__construct();

        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    
    public function index(): void {
        $this->requireLogin();

        $userId    = $_SESSION['user_id'];
        $reminderM = $this->model('Reminder');
        $list      = $reminderM->allForUser($userId);

        $this->view('reminders/index', ['list' => $list]);
    }

    
    public function create(): void {
        $this->requireLogin();
        if ($this->isPost()) {
            $subject = trim($_POST['subject'] ?? '');
            if ($subject !== '') {
                $this->model('Reminder')
                     ->create($_SESSION['user_id'], $subject);
            }
            $this->redirect('/reminders');
        }
        $this->view('reminders/create');
    }

    
    public function complete(int $id): void {
        $this->requireLogin();
        $this->model('Reminder')->markCompleted($id);
        $this->redirect('/reminders');
    }

    
    public function delete(int $id): void {
        $this->requireLogin();
        $this->model('Reminder')->delete($id);
        $this->redirect('/reminders');
    }

    
    private function requireLogin(): void {
        if (empty($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
    }

    
    private function isPost(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
