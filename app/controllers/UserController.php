<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 13.07.14
 * Time: 17:43
 */

namespace controllers;


use microCMS\Controller;
use models\UserModel;

class UserController extends Controller {

    private $app;
    private $salt = '$@lt';
    function __construct($app){
        $this->app = $app;
    }

    private function _checkLogin($login, $password){
        $userModel = new UserModel($this->app->db);
        $user = $userModel->getUserByLogin($login);
        if(md5($password.$this->salt)== $user->hash){
            return true;
        }
    }

    public function loginAction(){

        $this->app->view->templateName = 'index.phtml';
        if(isset($_POST['submit'])){

            $login = $_POST['login'];
            $password = $_POST['password'];
            if($user = $this->_checkLogin($login,$password)){
                $_SESSION['user'] = $user;
            }
        }


    }

    public function logoutAction(){

    }
} 