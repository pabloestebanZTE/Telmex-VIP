<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_ot_hija_model extends CI_Model {

    protected $session;

    public function __construct() {
        $this->load->model('dto/OtHijaModel');
    }

    public function getAll() {
        try {
            $otHija = new OtHijaModel();
            $datos = $otHija->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function findByOrdenTrabajoHija($idOrdenTrabajoHija) {
        try {
            $db = new DB();
            $sql = "SELECT * FROM ot_hija  WHERE id_orden_trabajo_hija = $idOrdenTrabajoHija  AND fecha_actual = DATE(DATE(NOW())-1)";
            $data = $db->select($sql)->first();
//            echo $db->getSql();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($data);
            return $data;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function insertOtHija($request) {
        try {
            $otHija = new OtHijaModel();
            $datos = $otHija->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getOtsAssigned() {
        try {
            $db = new DB();
            $condicion = "";
            $usuario_session = Auth::user()->n_name_user . " " . Auth::user()->n_last_name_user;
            if (Auth::user()->n_role_user == 'ingeniero') {
                $condicion = "AND usuario_asignado like '%$usuario_session%'";
            }
            $datos = $db->select("SELECT oh.*, eo.k_id_tipo 
                                FROM ot_hija oh
                                INNER JOIN estado_ot eo ON oh.k_id_estado_ot = eo.k_id_estado_ot
                                WHERE fecha_actual = CURDATE() 
                                $condicion ORDER BY n_days DESC")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function updateStatusOt($request) {
        try {
            $otHija = new OtHijaModel();
            $datos = $otHija->where("k_id_register", "=", $request->k_id_register)
                    ->update([
                                "observaciones" => $request->observaciones,
                                "k_id_estado_ot" => $request->k_id_estado_ot,
                                "estado_orden_trabajo_hija" => $request->estado_orden_trabajo_hija
                            ]);
//            echo $otHija->getSQL();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function getOtsFiteenDays() {
        try {
            $db = new DB();
            $condicion = "";
            $usuario_session = Auth::user()->n_name_user . " " . Auth::user()->n_last_name_user;
            if (Auth::user()->n_role_user == 'ingeniero') {
                $condicion = "AND usuario_asignado like '%$usuario_session%'";
            }
            $datos = $db->select("SELECT * 
                                FROM ot_hija
                                WHERE ADDDATE(fecha_actual, INTERVAL 15 DAY) = CURDATE() 
                                $condicion")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function getCountOtsFiteenDays() {
        try {
            $db = new DB();
            $condicion = "";
            $usuario_session = Auth::user()->n_name_user . " " . Auth::user()->n_last_name_user;
            if (Auth::user()->n_role_user == 'ingeniero') {
                $condicion = "AND usuario_asignado like '%$usuario_session%'";
            }
            $datos = $db->select("SELECT count(*) as cont
                                FROM telmex_vip.ot_hija
                                WHERE ADDDATE(fecha_actual, INTERVAL 15 DAY) = CURDATE()
                                $condicion")->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    

}

?>
