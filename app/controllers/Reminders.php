<?php
class Reminders extends Controller {
    public function index(): void {
        $uid   = $_SESSION['auth']['id'];
        $m     = $this->model('Reminder');
        $notes = $m->get_all_reminders($uid);
        $this->view('reminders/index', ['notes' => $notes]);
    }

    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject = trim($_POST['subject'] ?? '');
            if ($subject !== '') {
                $this->model('Reminder')
                     ->create_reminder($_SESSION['auth']['id'], $subject);
                $this->redirect('/reminders');
                return;
            }
            $this->view('reminders/create', [
                'error'   => 'Subject required',
                'subject' => $subject
            ]);
        } else {
            $this->view('reminders/create');
        }
    }

    public function delete(int $id): void {
        $this->model('Reminder')->delete_reminder($id);
        $this->redirect('/reminders');
    }

    public function complete(int $id): void {
        $this->model('Reminder')->mark_reminder_complete($id);
        $this->redirect('/reminders');
    }
}