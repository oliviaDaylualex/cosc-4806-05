<?php
class Secret extends Controller {
    public function __construct() {
        parent::__construct();
        

     
        if (empty($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
    }

    public function index() {
     
        $this->view('secret/index');
    }
}
