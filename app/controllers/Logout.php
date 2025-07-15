<?php
class Logout extends Controller {
    public function index(): void {
        $_SESSION = [];
        session_destroy();
        $this->redirect('/login');
    }
}
