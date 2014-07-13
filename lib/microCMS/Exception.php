<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 13.07.14
 * Time: 16:11
 */

namespace microCMS;


class Exception extends \Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {

        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

} 