<?php
class Reports extends Controller {
    public function __construct() {
        session_start();
        if (!isset($_SESSION['auth']) || $_SESSION['auth']['role'] !== 'admin') {
            header('Location: /home');
            exit;
        }
    }

    public function index() {
        $remindersModel = $this->model('Reminder');
        $userModel = $this->model('User');

        $allReminders = $remindersModel->getAllReminders();
        $mostRemindersUser = $remindersModel->getUserWithMostReminders();
        $logins = $userModel->getLoginsCountByUser();

        $this->view('reports/index', [
            'allReminders' => $allReminders,
            'mostRemindersUser' => $mostRemindersUser,
            'logins' => $logins
        ]);
    }
}