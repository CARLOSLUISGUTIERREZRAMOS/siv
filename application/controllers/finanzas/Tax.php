<?php

/**
 * Description of tax
 *
 * @author C_GGUTIERREZ
 */
class Tax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!isset($this->session->username)):
             redirect('/');
         endif;
        $this->load->model('finanzas/Tax_model');
    }

    public function RegistrarTaxDelDia() {

        $date_today = (new DateTime())->format('Y-m-d');
        $xss_post = $this->input->post(NULL, TRUE);
        $data = array(
            'tipo_cambio_compra' => $xss_post['tipo_cambio_compra'],
            'costo_libra' => $xss_post['costo_libra'],
            'fecha_ingreso' => $date_today
        );
        $inserto_tipo_cambio = $this->Tax_model->RegistrarNuevoTaxDelDia($data);
        if ($inserto_tipo_cambio === TRUE) {
            $this->session->set_flashdata('msg_tipo_cambio', 'Se registro el tipo de cambio');
            $this->session->set_flashdata('INSERTO', $inserto_tipo_cambio);
            redirect("/interno/Main");
        } else {
            $this->session->set_flashdata('msg_tipo_cambio', 'Ya existe un tipo de cambio para hoy');
            $this->session->set_flashdata('INSERTO', $inserto_tipo_cambio);
            redirect("/interno/Main");
        }
    }

    public function ValidarExistenciaTipoCambio() {

        $existe_tipo_cambio = $this->Tax_model->VerificarExisteTipoCambioDelDia();
        echo ($existe_tipo_cambio) ? 'EXISTE_TIPOCAMBIO' : 'NOEXISTE_TIPOCAMBIO';
    }
    public function ObtenerCostoPorLibraDelDia() {

        $costo_libra = $this->Tax_model->ObtenerCostoPorLibraDelDia();
        echo $costo_libra;
//        echo ($existe_tipo_cambio) ? 'EXISTE_TIPOCAMBIO' : 'NOEXISTE_TIPOCAMBIO';
    }

}
