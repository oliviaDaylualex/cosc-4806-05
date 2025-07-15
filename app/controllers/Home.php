<?php
class Home extends Controller {
    public function index() {
        
        $username  = $_SESSION['username']   ?? 'Guest';
        $loginTime = $_SESSION['login_time'] ?? null;

        $this->view('home/index', [
            'username'  => $username,
            'loginTime' => $loginTime
        ]);
    }
}
