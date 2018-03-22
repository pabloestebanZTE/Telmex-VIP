<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class OtHija extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ot_hija_model');
    }

    public function getOtsAssigned() {
        $response = null;
        if (Auth::check()) {
            $otHijaModel = new Dao_ot_hija_model();
            $res = $otHijaModel->getOtsAssigned();
            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }
    
    public function updateStatusOt() {
        //Se comprueba si no hay sesión.
        $response = null;
        if (Auth::check()) {
            $otHijaModel = new Dao_ot_hija_model();
            $res = $otHijaModel->updateStatusOt($this->request);
            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }

}
