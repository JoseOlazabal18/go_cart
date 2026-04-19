<?php 
// --
class C_Products extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // Cargamos el modelo
        $obj = $this->load_model('Products');
        
        // Obtenemos los 4 productos
        $data['productos'] = $obj->get_products_home();

        // Cargamos recursos y vista pasándole la data
        $this->view->set_js('index');
        $this->view->set_view('index', false, $data);
    }

    
}