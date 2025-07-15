<?php
class Register extends Controller {
    public function index(array $data = []): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $u      = trim($_POST['username']   ?? '');
            $pw     = $_POST['password']        ?? '';
            $errors = [];

            if (!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $u)) {
                $errors[] = 'Username must be 4–20 chars: letters, numbers, or underscore.';
            }
            if (strlen($pw) < 8
                || !preg_match('/[A-Z]/', $pw)
                || !preg_match('/[0-9]/', $pw)
                || !preg_match('/[\W]/', $pw)
            ) {
                $errors[] = 'Password must be ≥8 chars, include uppercase, number & special char.';
            }

            $userM = $this->model('User');
            if ($userM->findByUsername($u)) {
                $errors[] = 'That username is already taken.';
            }

            if (empty($errors)) {
                $userM->create($u, $pw);
                $this->redirect('/login');
                return;
            }

            $data = ['errors' => $errors, 'username' => $u];
        }

        $this->view('register/index', $data);
    }
}