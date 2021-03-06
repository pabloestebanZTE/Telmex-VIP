<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_user_model extends CI_Model {

    protected $session;

    public function __construct() {
        $this->load->model('dto/UserModel');
    }

    public function getAll() {
        try {
            $user = new UserModel();
            $datos = $user->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getAllEngineers() {
        try {
            $db = new DB();
            $sql = "SELECT UPPER(CONCAT(n_name_user, ' ', n_last_name_user)) ingenieros
                FROM user WHERE n_role_user = 'ingeniero'";
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
