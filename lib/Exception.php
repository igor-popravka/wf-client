<?php
namespace DC\WFAPI\GUI;


class Exception extends \Exception {
    public static function create($message = '', $code = 0) {
        return new static($message, $code);
    }
}