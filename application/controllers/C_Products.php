<?php 
// --
class C_Products extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->set_js('index');
        $this->view->set_view('index');
    }

    // 🔥 ESTE ES EL IMPORTANTE
    public function get_products() {

        $request = $_SERVER['REQUEST_METHOD'];

        if ($request === 'GET') {

            $obj = $this->load_model('Products');
            $response = $obj->get_products_limit();

            switch ($response['status']) {

                case 'OK':
                    $json = array(
                        'status' => 'OK',
                        'type' => 'success',
                        'msg' => 'Productos encontrados',
                        'data' => $response['result']
                    );
                    break;

                case 'ERROR':
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'warning',
                        'msg' => 'No hay productos',
                        'data' => array()
                    );
                    break;

                case 'EXCEPTION':
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'error',
                        'msg' => $response['result']->getMessage(),
                        'data' => array()
                    );
                    break;
            }

        } else {
            $json = array(
                'status' => 'ERROR',
                'type' => 'error',
                'msg' => 'Método no permitido',
                'data' => array()
            );
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }
    
}