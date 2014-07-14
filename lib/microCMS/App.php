<?php

namespace microCMS;

use controllers;

class App{

    public $settings = array();
    public $path;
    public $db;

    public function __construct($path, $iniPath){
        //set settings
        $this->path = $path;
        $this->settings = parse_ini_file($path . $iniPath,true);

        if($this->settings===false){
           throw new Exception('incorrect config');
        }
        //construct db
        $this->db = new Db($this->settings['db']);
        $this->db->getConnection();

        $this->view = new View();
        $this->view->path = $this->path.'/views/';
        $this->view->layoutName = 'layout.phtml';
        $this->view->templateName = 'index.phtml';



    }


    public function run(){
        //get routes
        $availableRoutes = $this->settings['routes'];

        $URLParams = $_SERVER['REQUEST_URI'];
        $params = parse_url($URLParams);



        $paramsArr = explode('/',$params['path']);
        if($paramsArr[1]){
            $controllerName = "controllers\\".$availableRoutes[$paramsArr[1]].'Controller';
        } else {
            $controllerName = "controllers\\".'IndexController';
            $actionName  = 'indexAction';
            $templateName = 'index.phtml';
        }



        if(!empty($paramsArr[2])){
            $actionName = $paramsArr[2].'Action';
            $templateName = $paramsArr[2].'.phtml';
        }

        try{
            $this->view->templateName = $templateName;
            $controller = new $controllerName ($this);
            $controller->$actionName();


        }catch (Exception $e){

        }

        //render view
        $this->view->content = $this->view->render();
        //render layout
       echo  $this->view->render($this->view->path.$this->view->layoutName);



       // $controller->settings = $params;

    }

}