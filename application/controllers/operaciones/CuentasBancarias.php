<?php

class CuentasBancarias extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('ctabancarias'));
    }

public function obtenerCuentasBancarias(){
    // $id = $_POST['id'];
    echo "TESTING";
}

}