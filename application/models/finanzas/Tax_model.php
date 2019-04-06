<?php

/**
 * Description of Tax_model
 *
 * @author C_GGUTIERREZ
 */
class Tax_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function RegistrarNuevoTaxDelDia($data) {
        $this->db->set($data);
        $db_debug = $this->db->db_debug; //save setting
        $this->db->db_debug = FALSE; //disable debugging for queries
        $result = $this->db->insert('tax');
        $this->db->db_debug = $db_debug;
        return $result;
    }

    public function ObtenerCostoLibraDelDia() {
        $fecha_hoy_inicio = (new DateTime())->format('Y-m-d 00:00:00');
        $fecha_hoy_fin = (new DateTime())->format('Y-m-d 23:59:59');
        $this->db->select('costo_libra');
        $this->db->from('tax');
        $condicion_fecha = "fecha_ingreso BETWEEN '$fecha_hoy_inicio' AND '$fecha_hoy_fin'";
        $this->db->where($condicion_fecha);
        $this->db->limit(1);
        return $this->db->get()->row()->costo_libra;
    }

    public function ObtenerTipoCambioDelDia() {
        $fecha_hoy = (new DateTime())->format('Y-m-d');
        $this->db->select('id,tipo_cambio_compra');
        $this->db->from('tax');
        $this->db->where('fecha_ingreso =', $fecha_hoy);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function ObtenerCostoPorLibraDelDia() {
        $fecha_hoy = (new DateTime())->format('Y-m-d');
        $this->db->select('costo_libra');
        $this->db->from('tax');
        $this->db->where('fecha_ingreso =', $fecha_hoy);
        return $this->db->get()->row()->costo_libra;
    }

    //Refactorizar ya que si se cargo un tax se cargo el otro
    public function VerificarExisteTipoCambioDelDia() {
        $fecha_hoy = (new DateTime())->format('Y-m-d');
        $this->db->where('fecha_ingreso =', $fecha_hoy);
        $query = $this->db->get('tax');
        if ($query->num_rows() > 0) {
            return TRUE;
        }else{
            return FALSE;
        }

//        return $this->db->count_all_results();
//         $this->db->count_all('tax');
//        return $this->db->last_query();
    }

}
