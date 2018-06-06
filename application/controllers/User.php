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
            Redirect::redirect(URL::to("principal"));
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
        Redirect::to(URL::to("login"));
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

    public function routingVerification() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        if (Auth::isEvaluador()) {
            $daoEvaluador = new Dao_evaluador_model();
            $this->load->view('principal', ["stadistics" => $daoEvaluador->getAllStadistics()->data]);
        } else {
          $this->load->view('dataValidation');
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

    //arma la cadena de trexto de los prefijos
    public function getPrefijo(){

        $prefijos = $this->input->post('pref');
        // header('Content-Type: text/plain');
        // print_r($prefijos);


        for ($i=0; $i < count($prefijos) ; $i++) { 
          if (is_numeric($prefijos[$i][3])) {
            $pref[substr($prefijos[$i], 0, 3)][$i] = substr($prefijos[$i], 3);      
          } else {
            if (is_numeric($prefijos[$i][4])) {
            $pref[substr($prefijos[$i], 0, 4)][$i] = substr($prefijos[$i], 4);
            } else {
              $pref[substr($prefijos[$i], 0, 5)][$i] = substr($prefijos[$i], 5);
            }

          }  
        }

  /************************************************************************************************************/
        $j = 0;
        foreach ($pref as $i => $valores) {
            $res[$j] = "$i";
            $j++;
        }
        $respuesta = "";
        for($i = 0; $i < count($res); $i++){
          $string[$i] = $res[$i];
          $flag = 0;
          sort($pref[$res[$i]]);
          $pref[$res[$i]][0] = $this->fixZeros($pref[$res[$i]][0]);
          //RECORRE EL ARREGLO
          for($j = 0; $j < count($pref[$res[$i]]); $j++){
            //VERIFICA SI EL ARREGLO TIENE MAS DE UN ELEMENTO
            if(count($pref[$res[$i]]) != 1){
            //  echo "$flag<br>";
              //VERIFICA QUE NO LLEGUE AL ULTIMO ELEMENTO DEL ARREGLO
              if($j != (count($pref[$res[$i]])-1)){
                //COMPARA SI EL NUMERO VA PARA UNA SUCESION
                if($pref[$res[$i]][$j+1] == ($pref[$res[$i]][$j]) + 1){
                  //echo "com =  1<br>";
                  if($flag == 0){
                    //NO VIENE DE SUCESION Y VA PARA SUCESION, PINTA NUMERO -
                      $string[$i] = $string[$i].$pref[$res[$i]][$j]."_";
                  } else {
                    //NO HACE NADA PORQUE VIENE DE SUCESION Y SIGUE EN SUCESION
                  }
                  $flag = 1;
                } else {
                  //echo "com =  0<br>";
                  //VERIFICA SI VIENE DE UNA SUCESION
                  if($flag == 0){
                      //NO VIENE DE SUCESION Y NO VA PARA SUCESION, NUMERO,
                      $string[$i] = $string[$i].$pref[$res[$i]][$j].".";
                  } else {
                    //NO VIENE DE SUCESION Y NO VA PARA SUCESION, NUMERO,
                      $string[$i] = $string[$i].$pref[$res[$i]][$j].".";
                  }
                  $flag = 0;
                }
              } else {
                //COMO ES EL ULTIMO VALOR, SE PINTA EL NUMERO SOLO
                $string[$i] = $string[$i].$pref[$res[$i]][$j];
              }
            } else {
              $string[$i] = $string[$i].$pref[$res[$i]][0];
            }
          }
          if($i != (count($res)-1)){
            $respuesta = $respuesta.$string[$i].".";
          } else {
              $respuesta = $respuesta.$string[$i];
          }
        }
        $this->json($respuesta);
    }

    public function fixZeros($x){
      if(strlen($x) == 1){
      $x = "000".$x;
      }
      if(strlen($x) == 2){
      $x = "00".$x;
      }
      if(strlen($x) == 3){
      $x = "0".$x;
      }
      return $x;
    }

}

?>
