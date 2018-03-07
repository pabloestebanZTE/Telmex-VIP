<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

    class Dao_ot_hija_model extends CI_Model{

        protected $session;

        public function __construct(){
           $this->load->model('dto/OtHijaModel');

        }

        public function getAll(){
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

        public function findByOrdenTrabajoHija($idOrdenTrabajoHija){
          try {
            $otHija = new OtHijaModel();
            $datos = $otHija->where("id_orden_trabajo_hija","=",$idOrdenTrabajoHija)
                          ->where("fecha_actual", "=", "DATE(DATE(NOW())-1)")
                          ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
          } catch (DeplynException $ex) {
            return $ex;
          }
        }

    }
?>
