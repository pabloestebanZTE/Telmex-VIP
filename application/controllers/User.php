<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_user_model');
    }

    private function validUser($request) {
        return Auth::attempt([
                    "n_mail_user" => $request->username,
                    "n_password" => $request->password,
                    "OR" => [
                        "n_username_user" => $request->username
                    ]
        ]);
    }

    public function loginUser() {
        if (!Auth::check()) {
            $res = $this->validUser($this->request);
        } else {
            $res = true;
        }
        //Comprobamos si el Auth ha encontrado válida las credenciales consultadas...
        if ($res) {
            Redirect::redirect(URL::to("User/principal"));
        } else {
            $answer['error'] = "error";
            $this->load->view('login', $answer);
        }
    }

    public function principal() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $answer['user'] = Auth::user();
        $this->load->view('principal', $answer);
    }

    public function logout() {
        Auth::logout();
        Redirect::to(URL::to("welcome/index"));
    }

    public function comprobarSesion() {
        //Comprobar si existe una sesión...
        if (Auth::check()) {
            $this->json(new Response(EMessages::SESSION_ACTIVE));
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
        }
    }

    public function principalView() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        if (Auth::isEvaluador()) {
            $daoEvaluador = new Dao_evaluador_model();
            $this->load->view('principal', ["stadistics" => $daoEvaluador->getAllStadistics()->data]);
        } else {
            $this->load->view('principal');
        }
    }

    public function loadInformation() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $this->load->view('loadInformation');
    }

    public function editOts() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $estadoOtModel = new Dao_estado_ot_model();
        $estadosOt = $estadoOtModel->getAll();
        $answer['estadosOts'] = json_encode($estadosOt);
        $this->load->view('editOts', $answer);
    }

    public function markings() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $this->load->view('markings');
    }

    public function prueba() {
        $array = array(0,1,3,5,4,6,8,9,10,7,2,13,11);

        for ($i = 1; $i < count($array); $i++) {
            for ($j = 0; $j < count($array) - $i; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    $k = $array[$j + 1];
                    $array[$j + 1] = $array[$j];
                    $array[$j] = $k;
                }
            }
        }

        if (end($array) < 0) {
            echo 1;
        } else {
            for ($k = 1; $k <= end($array); $k++) {
//                echo $k;
                if (!in_array($k, $array)) {
                    echo $k;
                    break;
                } elseif (end($array) == $k) {
                    echo end($array) +1;
                    break;
                }
            }
        }
    }

}

?>
