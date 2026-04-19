<?php

class C_Login extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->set_view('index');
    }
}
