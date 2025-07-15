<?php
class Controller {
    public function __construct() {}

    protected function model(string $modelName) {
        require_once MODELS . DS . $modelName . '.php';
        return new $modelName;
    }

    protected function view(string $viewPath, array $data = []) {
        extract($data);
        require_once VIEWS . DS . str_replace('/', DS, $viewPath) . '.php';
    }

    protected function redirect(string $url) {
        header("Location: {$url}");
        exit;
    }
}