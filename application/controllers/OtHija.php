<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class OtHija extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ot_hija_model');
    }

        public function getOtsAssigned() {
        //Se comprueba si no hay sesión.
        if (!Auth::check()) {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }

        $response = null;
        if (Auth::check()) {
            $otHijaModel = new Dao_ot_hija_model();
            $res = $otHijaModel->getOtsAssigned();
            $this->json($res);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }
}
