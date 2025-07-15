<?php
class App {
    protected $controller = 'Login';
    protected $method     = 'index';
    protected $params     = [];

    public function __construct() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        $uri      = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $trimmed  = trim($uri, '/');
        $segments = $trimmed === ''
            ? []
            : array_values(array_filter(explode('/', $trimmed), 'strlen'));


        if (isset($segments[0]) && $segments[0] !== '') {
            $cand = ucfirst(strtolower($segments[0]));
            $file = __DIR__ . '/../controllers/' . $cand . '.php';
            if (is_file($file)) {
                $this->controller = $cand;
                array_shift($segments);
            }
        }


        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;


        if (isset($segments[0]) && method_exists($this->controller, $segments[0])) {
            $this->method = $segments[0];
            array_shift($segments);
        }


        $this->params = $segments;


        call_user_func_array(
            [ $this->controller, $this->method ],
            $this->params
        );
    }
}