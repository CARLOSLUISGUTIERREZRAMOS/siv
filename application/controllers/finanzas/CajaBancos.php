<?php

/**
 * Description of CajaBancos
 *
 * @author C_GGUTIERREZ
 */
class CajaBancos extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->template->add_js('js/moment/moment.min.js');
        $this->template->add_js('js/bootstrap-daterangepicker/daterangepicker.js');
        $this->template->add_js('js/app/finanzas/caja_bancos.js');
        $this->template->add_css('css/skins/_all-skins.min.css');
        $this->template->add_css('css/skins/all.css');
        $this->template->add_css('css/lte/AdminLTE.min.css');
        $this->template->add_js('js/ichecked/icheck.min.js');
        $this->template->add_css('css/bootstrap-daterangepicker/daterangepicker.css');
        $this->load->model('operaciones/Abono_model');
        
    }
    
    function Index(){
        $this->template->set('titulo', 'CAJA Y BANCOS');
        $campos_pen = 'monto';
        $data['abono_usd'] = $this->Abono_model->GetAbonos($campos_pen);
        $campos_usd = 'monto_pen';
        $data['abono_pen'] = $this->Abono_model->GetAbonos($campos_usd);
        
        $this->template->load(16,'finanzas/v_cajabancos',$data);
        
//        die;
    }
}
