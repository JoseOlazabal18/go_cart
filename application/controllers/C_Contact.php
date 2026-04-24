<?php 
// --
class C_Contact extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->set_js('index');
        $this->view->set_view('index');
    }
}