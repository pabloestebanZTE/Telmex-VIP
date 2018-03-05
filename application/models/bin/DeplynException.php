<?php

/*
 * @author = Starlly Software - https://starlly.com.
 * @licence = GNU
 * @description = Este archivo es propiedad de Deplyn Framework (https://deplyn.com) 
 * recuerda que para usarlo debes incluir en tu proyecto la licencia del framework.
 */

class DeplynException extends Exception {

    var $code;
    var $message;
    var $data;
    var $original_message;

    function __construct($code = null, $message = null, $data = null) {
        if (isset($code) && empty($message)) {
            $eMessages = EMessages::getResponse($code);
            $this->code = $eMessages->code;
            $this->message = $eMessages->message;
            $this->data = $eMessages->data;
            return $this;
        }
        $this->code = $code;
        $this->message = $message;
        return $this;
    }

    function setCode($code) {
        $this->code = $code;
        return $this;
    }

    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }

    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    function getOriginal_message() {
        return $this->original_message;
    }

    function setOriginalMessage($original_message) {
        $this->original_message = $original_message;
        return $this;
    }

}
