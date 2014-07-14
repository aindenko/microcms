<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 13.07.14
 * Time: 16:00
 */

namespace microCMS;


class View {

    public $path = '';
    public $templateName = '';
    public $layoutName = '';
    public function __construct(){

    }

    public function __set($name,$value){
        $this->$name = $value;
    }

    public function __get($name){

    }
    public function render($templateName = null){
        $path = $this->path . $this->templateName;

        if($templateName){
            $path = $this->path . $templateName;
        }
        ob_start();
        include $path;

        return ob_get_clean();

    }
} 