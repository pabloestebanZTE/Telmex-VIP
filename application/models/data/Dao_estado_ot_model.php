<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_estado_ot_model extends CI_Model {

    protected $session;

    public function __construct() {
        $this->load->model('dto/EstadoOtModel');
    }

    public function getAll() {
        try {
            $estadoOt = new EstadoOtModel();
            $datos = $estadoOt->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getStatusByTypeOtAndStatusName($idTipo, $estadoNombre1, $estadoNombre2) {
        try {
            $db = new DB();
            $sql = "SELECT * FROM estado_ot WHERE k_id_tipo = $idTipo AND 
                    (n_name_estado_ot = '$estadoNombre1' OR n_name_estado_ot = '$estadoNombre2')";
            $data = $db->select($sql)->get();
//            echo $db->getSql();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($data);
            return $data;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

}

?>
