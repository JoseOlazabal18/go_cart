<?php 
abstract class Controller {

    protected $view;
    protected $session;

    public function __construct() {
        $this->view = new View(new Request);

        session_start();
        $this->session = $_SESSION;
    }

    abstract public function index();

    public function load_model($model) {
        $model = 'M_' . $model;
        $route_model = ROOT . 'application/models/' . $model . '.php';

        if (is_readable($route_model)) {
            require_once $route_model;
            return new $model;
        } else {

            throw new Exception('Error loading model');
            
        }
    }
}