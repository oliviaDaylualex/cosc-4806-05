<?php
class Verify extends Controller {
    public function index(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        $u     = trim($_POST['username'] ?? '');
        $pw    = $_POST['password'] ?? '';
        $userM = $this->model('User');


        $fails = $userM->getLastFailed($u, 60);
        if ($fails >= 3) {
            $lastFail  = $userM->getLastFailed($u);
            $remaining = (strtotime($lastFail) + 60) - time();
            $this->view('login/index', [
                'error'    => "Account locked. Try again in {$remaining}s.",
                'username' => $u
            ]);
            return;
        }

        $user = $userM->findByUsername($u);
        if (!$user || !password_verify($pw, $user['password_hash'])) {
            $userM->recordLoginAttempt($u, 'failure');
            $this->view('login/index', [
                'error'    => 'Invalid credentials.',
                'username' => $u
            ]);
            return;
        }


        $userM->recordLoginAttempt($u, 'success');

        $_SESSION['auth'] = [
            'id'       => $user['id'],
            'username' => $user['username'],
            'role'     => $user['role'], 
        ];

        $this->redirect('/home');
    }
}