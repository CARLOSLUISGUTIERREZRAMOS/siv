<?php

class testing extends CI_Controller {
    public function __construct() {
        parent::__construct();
        //ACTIVANDO EL CHECKBOX CSS
        $this->template->add_css('css/skins/_all-skins.min.css');
        $this->template->add_css('css/skins/all.css');
        $this->template->add_js('js/ichecked/icheck.min.js');
        $this->template->add_js('js/test.js');

    }
    
    function index(){
        $this->template->set('titulo', 'VIAJE');
        $this->template->load(1,'v_test');
    }
}
