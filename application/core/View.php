<?php 
// application/core/View.php

class View {
    
    private $controller;
    private $js;
    private $menu;

    public function __construct(Request $request) {
        $this->controller = strtolower($request->get_controller());
        $this->js = array();
        $this->menu = array();
    }

    // -- Añadimos $data = [] como tercer parámetro
    public function set_view($view, $partial = false, $data = []) {
        
        // --- PROCESAMIENTO DE DATOS ---
        // Si el controlador envía ['productos' => $array], aquí se crea la variable $productos
        if (!empty($data)) {
            extract($data);
        }

        $params = array(
            'js' => $this->js,
            'menu' => $this->menu
        );

        $route_view = ROOT . 'application/views' . DS . $this->controller . DS . $view . '.php';

        if (is_readable($route_view)) {
            if (!$partial) {
                // Estructura de Layout Completo
                include_once ROOT . 'application/views/layout/head.php';
                include_once ROOT . 'application/views/layout/header.php';
                
                include_once $route_view; 

                // Sección de beneficios (Why Choose Us)
                $why_path = ROOT . 'application/views/layout/why_choose.php';
                if (is_readable($why_path)) { include_once $why_path; }

                include_once ROOT . 'application/views/layout/footer.php';
            } else {
                // Solo la vista (útil para AJAX)
                include_once $route_view;
            }
        } else {
            throw new Exception('Error: La vista ' . $view . ' no existe.');
        }
    }

    public function set_js($js) { 
        if ($js) {
            $this->js[] = BASE_URL . 'application/views/' . $this->controller . '/js/' . $js . '.js';
        }
    }

    public function set_menu($menu) {
        if ($menu) { $this->menu = $menu; }
    }
} 