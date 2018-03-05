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
                $x = 0;
                while ($this->getValueCell($sheet, 'A' . $row) > 0 && ($row < $limit)) {
                    foreach ($engineers as $value) {
                        //porcentaje de similar entre primer nombre de db y primera palabra (nombre) del excel
                        similar_text(explode(" ", $value->ingenieros)[0], explode(" ", $this->getValueCell($sheet, 'AB' . $row))[0], $pName);
                        //porcentaje de similar entre primer apellido de db y segunda palabra (apellido) del excel
                        similar_text(explode(" ", $value->ingenieros)[0], explode(" ", $this->getValueCell($sheet, 'AB' . $row))[1], $pLastname1);
                        //porcentaje de similar entre primer apellido de db y tercera (apellido) del excel
                        similar_text(explode(" ", $value->ingenieros)[0], explode(" ", $this->getValueCell($sheet, 'AB' . $row))[2], $pLastname2);
                        //porcentaje de similar entre primer apellido de db y cuarta (apellido) del excel
                        similar_text(explode(" ", $value->ingenieros)[0], explode(" ", $this->getValueCell($sheet, 'AB' . $row))[3], $pLastname3);
                        if ($pName > 70) {
                            if ($pLastname1 > 69 || $pLastname2 > 69 || $pLastname3 > 69) {
                                $x++;
                            }
                        }
                    }
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
                    "seleccionados" => $x
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

}
