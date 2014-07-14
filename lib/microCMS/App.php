<?php

namespace microCMS;

use controllers;

class App{

    public $settings = array();
    public $path;
    public $db;
    public $user;
    public $query;

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


        //check user login
        if(isset($_SESSION['user'])){
            $this->user = $_SESSION['user'];
            $this->view->userlogin = $this->user->login;
            $this->view->login = $this->view->render('loginscs.phtml');
        } else {
            $this->view->login = $this->view->render('login.phtml');
        }

        $actionName  = 'indexAction';
        $templateName = 'index.phtml';

        $paramsArr = explode('/',$params['path']);
        if($paramsArr[1] && $paramsArr[1]!="index.php"){
            $controllerName = "controllers\\".$availableRoutes[$paramsArr[1]].'Controller';
            if(!empty($paramsArr[2])&&$paramsArr[1]!='article'){
                $actionName = $paramsArr[2].'Action';
                $templateName = $paramsArr[2].'.phtml';

            }
        } else {

            $controllerName = "controllers\\".'IndexController';
        }

        if($paramsArr[1]=='article'){
            $this->query = array();
            if(isset($paramsArr[2])&&!empty($paramsArr[2])){
                $this->query['param1']=$paramsArr[2];
            }
            if(isset($paramsArr[3])&&!empty($paramsArr[3])){
                $this->query['param2']=$paramsArr[3];
            }
            if(isset($paramsArr[4])&&!empty($paramsArr[4])){
                $this->query['param3']=$paramsArr[4];
            }
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
       echo  $this->view->render($this->view->layoutName);



    }

}