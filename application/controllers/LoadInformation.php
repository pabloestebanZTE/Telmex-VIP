<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoadInformation extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function uploadfile() {
        $request = $this->request;
        $storage = new Storage();
        //Se activa la asignación de un prefijo para nuestro archivo...
        $storage->setPrefix(true);
        //Seteamos las extenciones válidas...
        $storage->setValidExtensions("xlsx", "xls");
        //Subimos el archivo...
        $storage->process($request);
        //Obtenemos el log de los archivos subidos...
        $files = $storage->getFiles();
        $response = null;
        if (count($files) > 0) {
            $project = $files[0];
            $response = new Response(EMessages::SUCCESS, "Se ha subido el archivo correctamente", $project);
        } else {
            $response = new Response(EMessages::ERROR_ACTION, "No se pudo subir el archivo.");
        }
        $this->json($response);
    }

    public function countLinesFile() {
        error_reporting(E_ERROR);
        $request = $this->request;
        $file = $request->file;
        $response = new Response(EMessages::SUCCESS);
        if (file_exists($file)) {
            try {
                //Se procesa el archivo de comentarios...
                set_time_limit(-1);
                ini_set('memory_limit', '1500M');
                require_once APPPATH . 'models/bin/PHPExcel-1.8.1/Classes/PHPExcel/Settings.php';
                $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
                $cacheSettings = array(' memoryCacheSize ' => '15MB');
                PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
                PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
                $this->load->model('bin/PHPExcel-1.8.1/Classes/PHPExcel');

                $inputFileType = PHPExcel_IOFactory::identify($file);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setReadDataOnly(true);
                $objPHPExcel = $objReader->load($file);

                //Obtenemos la página.
                $sheet = $objPHPExcel->getSheet(0);
                $row = 1;
                $validator = new Validator();
                while ($validator->required("", $this->getValueCell($sheet, "A" . $row))) {
                    $row++;
                }
                $highestRowSheet1 = $row;

                $lines = [
                    "sheet1" => $highestRowSheet1
                ];

                $response->setData($lines);
                $this->json($response);
            } catch (DeplynException $ex) {
                $this->json($ex);
            }
        }
    }

    public function processData() {
        error_reporting(E_ERROR);
        $request = $this->request;
        $response = new Response(EMessages::SUCCESS);
        $file = $request->file;

        //Verificamos si el archivo existe...
        if (file_exists($file)) {
            //Iniciamos el procedimiento de carga de datos...
            set_time_limit(-1);
            ini_set('memory_limit', '1500M');
            require_once APPPATH . 'models/bin/PHPExcel-1.8.1/Classes/PHPExcel/Settings.php';
            require_once APPPATH . 'models/bin/PHPExcel-1.8.1/Classes/PHPExcel/IOFactory.php';
            $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
            $cacheSettings = array(' memoryCacheSize ' => '15MB');
//            if (intval(phpversion()) <= 5) {
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
//            }
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
//            include_once('PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php');
//            $this->load->model('bin/PHPExcel-1.8.1/Classes/PHPExcel/IOFactory.php');

            try {
                $validator = new Validator();
                $userModel = new Dao_user_model();
                $otHijaModel = new Dao_ot_hija_model();
                $estadoOtModel = new Dao_estado_ot_model();
                $tipoOtHijaModel = new Dao_tipo_ot_hija_model();
                
                $inputFileType = PHPExcel_IOFactory::identify($file);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setReadDataOnly(true);
                //Leer el archivo...
                $objPHPExcel = $objReader->load($file);

                //Cambiar el archivo...
//                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExce, $inputFileTypel);
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

                //Obtenemos la página.
                $sheet = $objPHPExcel->getSheet(0);
                //Obtenemos el highestRow...
                $highestRow = 0;
                $row = $request->index;
                $limit = $row + $request->limit;
                $idTicket = 0;
                $imported = 0;
                $inconsistencies = 0;
                $inconsistenciesFull = [];
                $cellInconsistencies = [];
                $engineers = $userModel->getAllEngineers();

                //Inicializamos un objeto de PHPExcel para escritura...
//                $objPHPWriter = $this->createErrorsFileExcel();
                $rowWriter = 1;
                $x1 = 0;
                $x2 = 0;
                while ($this->getValueCell($sheet, 'A' . $row) > 0 && ($row < $limit)) {
                    foreach ($engineers as $value) {
                        //porcentaje de similar entre primer nombre de db y primera palabra (nombre) del excel
                        similar_text(explode(" ", $value->ingenieros)[0], explode(" ", $this->getValueCell($sheet, 'AB' . $row))[0], $pName);
                        //porcentaje de similar entre primer apellido de db y segunda palabra (apellido) del excel
                        similar_text(explode(" ", $value->ingenieros)[1], explode(" ", $this->getValueCell($sheet, 'AB' . $row))[1], $pLastname1);
                        //porcentaje de similar entre primer apellido de db y tercera (apellido) del excel
                        similar_text(explode(" ", $value->ingenieros)[1], explode(" ", $this->getValueCell($sheet, 'AB' . $row))[2], $pLastname2);
                        //porcentaje de similar entre primer apellido de db y cuarta (apellido) del excel
                        similar_text(explode(" ", $value->ingenieros)[1], explode(" ", $this->getValueCell($sheet, 'AB' . $row))[3], $pLastname3);
                        if ($pName > 70) {
                            if ($pLastname1 > 69 || $pLastname2 > 69 || $pLastname3 > 69) {
                                //consultamos si la ot ya fue registrada en la DB el dia de ayer
                                $otHija = $otHijaModel->findByOrdenTrabajoHija($this->getValueCell($sheet, 'AW' . $row));
                                print_r($otHija);
                                if ($otHija->data) {
                                    //validamos que el estado de la ot del excel sea igual al estado del registro en DB
                                    if ($this->getValueCell($sheet, 'AZ' . $row) != $otHija->estado_orden_trabajo) {
                                        //consultamos el id del tipo de trabajo de la ot
                                        $tipoOtHija = $tipoOtHijaModel->getIdTypeByNameType($this->getValueCell($sheet, 'AV' . $row));
                                        print_r($otHija->data);
                                        //validamos que el estado de la ot del excel sea mayor al estado de del registro en DB
                                        $estadosOt = $estadoOtModel->getStatusByTypeOtAndStatusName($tipoOtHija[0]->id_tipo, $otHija->ot_hija, $this->getValueCell($sheet, 'AV' . $row));
                                        //si el estado de la ot del excel es mayor insertamos el registro del excel de lo contrario insertamos el registro que esta en la DB con el campo fecha_actual de hoy
//                                        if (true) {
//                                            
//                                        }
                                    } else {
                                        //se inserta el registro de excel con el campo n_days sumandole 1 a lo que contenga
                                        $res = $this->insertRecord($sheet, $row);
                                    }
                                } else {
                                    //se inserta el registro de excel con el campo n_days en 0
                                    $res = $this->insertRecord($sheet, $row);
                                }
                            }
                        }
                    }
                    $row++;
                }

                if (($limit - $row) >= 2) {
                    $response->setCode(2);
                }

                $filename = null;

                $response->setData([
                    "id" => $idTicket,
                    "imported" => $imported,
                    "inconsistencies" => $inconsistencies,
                    "inconsistenciesFull" => $inconsistenciesFull,
                    "data" => $this->objs,
                    "errors_filename" => $filename,
                    "row" => ($row - $request->index),
                    "ya existen" => $x1,
                    "nuevas" => $x2
                ]);
            } catch (DeplynException $ex) {
                $response = new Response(EMessages::ERROR, "Error al procesar el archivo.");
            }
        } else {
            $response = new Response(EMessages::ERROR, "No se encontró el archivo " . $file);
        }

        $this->json($response);
    }

    /**
     * @param $sheet
     * @param $cell
     * getValueCell($sheet, $cell)
     */
    private function getValueCell(&$sheet, $cell) {
        $string = str_replace(array("\n", "\r", "\t"), '', $sheet->getCell($cell)->getValue());
        $string = str_replace(array("_x000D_"), "<br/>", $sheet->getCell($cell)->getValue());
        return $string;
    }
    
    /**
     * @param $sheet
     * @param $cell
     * getValueCell($sheet, $cell)
     */
    private function insertRecord(&$sheet, $row) {
        $otHijaModel = new Dao_ot_hija_model();
        $this->request->id_orden_trabajo_hija = $this->getValueCell($sheet, 'AW' . $row);
        $this->request->k_id_estado_ot = null;
        $this->request->id_cliente_onyx = $this->getValueCell($sheet, 'A' . $row);
        $this->request->nombre_cliente = $this->getValueCell($sheet, 'B' . $row);
        $this->request->grupo_objetivo = $this->getValueCell($sheet, 'C' . $row);
        $this->request->segmento = $this->getValueCell($sheet, 'D' . $row);
        $this->request->nivel_atencion = $this->getValueCell($sheet, 'E' . $row);
        $this->request->ciudad = $this->getValueCell($sheet, 'F' . $row);
        $this->request->departamento = $this->getValueCell($sheet, 'G' . $row);
        $this->request->grupo = $this->getValueCell($sheet, 'H' . $row);
        $this->request->consultor_comercial = $this->getValueCell($sheet, 'I' . $row);
        $this->request->grupo2 = $this->getValueCell($sheet, 'J' . $row);
        $this->request->consultor_postventa = $this->getValueCell($sheet, 'K' . $row);
        $this->request->proy_instalacion = $this->getValueCell($sheet, 'L' . $row);
        $this->request->ing_responsable = $this->getValueCell($sheet, 'M' . $row);
        $this->request->id_enlace = $this->getValueCell($sheet, 'N' . $row);
        $this->request->alias_enlace = $this->getValueCell($sheet, 'O' . $row);
        $this->request->orden_trabajo = $this->getValueCell($sheet, 'P' . $row);
        $this->request->nro_ot_onyx = $this->getValueCell($sheet, 'Q' . $row);
        $this->request->servicio = $this->getValueCell($sheet, 'R' . $row);
        $this->request->familia = $this->getValueCell($sheet, 'S' . $row);
        $this->request->producto = $this->getValueCell($sheet, 'T' . $row);
        $this->request->fecha_creacion = $this->getValueCell($sheet, 'U' . $row);
        $this->request->tiempo_incidente = $this->getValueCell($sheet, 'V' . $row);
        $this->request->estado_orden_trabajo = $this->getValueCell($sheet, 'W' . $row);
        $this->request->tiempo_estado = $this->getValueCell($sheet, 'X' . $row);
        $this->request->ano_ingreso_estado = $this->getValueCell($sheet, 'Y' . $row);
        $this->request->mes_ngreso_estado = $this->getValueCell($sheet, 'Z' . $row);
        $this->request->fecha_ingreso_estado = $this->getValueCell($sheet, 'AA' . $row);
        $this->request->usuario_asignado = $this->getValueCell($sheet, 'AB' . $row);
        $this->request->grupo_asignado = $this->getValueCell($sheet, 'AC' . $row);
        $this->request->ingeniero_provisioning = $this->getValueCell($sheet, 'AD' . $row);
        $this->request->cargo_arriendo = $this->getValueCell($sheet, 'AE' . $row);
        $this->request->cargo_mensual = $this->getValueCell($sheet, 'AF' . $row);
        $this->request->monto_moneda_local_arriendo = $this->getValueCell($sheet, 'AG' . $row);
        $this->request->monto_moneda_local_cargo_mensual = $this->getValueCell($sheet, 'AH' . $row);
        $this->request->cargo_obra_civil = $this->getValueCell($sheet, 'AI' . $row);
        $this->request->descripcion = $this->getValueCell($sheet, 'AJ' . $row);
        $this->request->direccion_origen = $this->getValueCell($sheet, 'AK' . $row);
        $this->request->ciudad_incidente = $this->getValueCell($sheet, 'AL' . $row);
        $this->request->direccion_destino = $this->getValueCell($sheet, 'AM' . $row);
        $this->request->ciudad_incidente3 = $this->getValueCell($sheet, 'AN' . $row);
        $this->request->fecha_compromiso = $this->getValueCell($sheet, 'AO' . $row);
        $this->request->fecha_programacion = $this->getValueCell($sheet, 'AP' . $row);
        $this->request->fecha_realizacion = $this->getValueCell($sheet, 'AQ' . $row);
        $this->request->resolucion_1 = $this->getValueCell($sheet, 'AR' . $row);
        $this->request->resolucion_2 = $this->getValueCell($sheet, 'AS' . $row);
        $this->request->resolucion_3 = $this->getValueCell($sheet, 'AT' . $row);
        $this->request->resolucion_4 = $this->getValueCell($sheet, 'AU' . $row);
        $this->request->fecha_creacion_ot_hija = $this->getValueCell($sheet, 'AX' . $row);
        $this->request->proveedor_ultima_milla = $this->getValueCell($sheet, 'AY' . $row);
        $this->request->usuario_asignado4 = $this->getValueCell($sheet, 'BA' . $row);
        $this->request->resolucion_15 = $this->getValueCell($sheet, 'BB' . $row);
        $this->request->resolucion_26 = $this->getValueCell($sheet, 'BC' . $row);
        $this->request->resolucion_37 = $this->getValueCell($sheet, 'BD' . $row);
        $this->request->resolucion_48 = $this->getValueCell($sheet, 'BE' . $row);
        $this->request->ot_hija = $this->getValueCell($sheet, 'AV' . $row);
        $this->request->estado_orden_trabajo_hija = $this->getValueCell($sheet, 'AZ' . $row);
        $this->request->fec_actualizacion_onyx_hija = $this->getValueCell($sheet, 'BF' . $row);
        $this->request->fecha_actual = date('Y-m-d');
        $this->request->n_days = 0;
        
        $response = $otHijaModel->insertOtHija($this->request);
    }

}
