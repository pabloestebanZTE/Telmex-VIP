<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_tipo_ot_hija_model extends CI_Model {

    protected $session;

    public function __construct() {
        $this->load->model('dto/TipoOtHijaModel');
    }

    public function getAll() {
        try {
            $tipoOtHija = new TipoOtHijaModel();
            $datos = $tipoOtHija->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getIdTypeByNameType($nombreTipo) {
        try {
            $db = new DB();
            $sql = "SELECT 
                    n_name_tipo,
                    CASE
                        WHEN i_referencia IS NULL THEN k_id_tipo
                        ELSE i_referencia
                    END AS id_tipo
                    FROM tipo_ot_hija WHERE n_name_tipo = '$nombreTipo'";
            $data = $db->select($sql)->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($data);
            return $data;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

}

?>
