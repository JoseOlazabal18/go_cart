<?php 
// application/core/Controller.php

abstract class Controller {

    protected $view;
    protected $session;
    protected $segment; // -- Aquí se guardará el segmento

    public function __construct() {
        // 1. Instanciar la Vista
        $this->view = new View(new Request);

        // 2. Configurar Aura Session (o similar)
        // Asegúrate de que el autoload de vendor esté cargando esta librería
        $session_factory = new \Aura\Session\SessionFactory;
        $session = $session_factory->newInstance($_COOKIE);
        
        // Tiempo de vida: 10 horas (36000 segundos)
        $session->setCookieParams(array('lifetime' => '36000')); 

        $this->session = $session;
        
        // 3. Crear el segmento específico para tu app
        // Esto aísla los datos de JB Tech de otras posibles apps en el mismo servidor
        $this->segment = $session->getSegment('jb_tech\storage');
    }

    abstract public function index();

    public function load_model($model) {
        $modelName = 'M_' . $model;
        $route_model = ROOT . 'application' . DS . 'models' . DS . $modelName . '.php';

        if (is_readable($route_model)) {
            require_once $route_model;
            return new $modelName;
        } else {

            throw new Exception('Error loading model');
            
        }
    }
}