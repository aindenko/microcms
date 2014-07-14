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

        $this->app->view->templateName = 'index.phtml';
    }

    private function _checkLogin($login, $password){
        $userModel = new UserModel($this->app->db);
        $user = $userModel->getUserByLogin($login);
        if(md5($password.$this->salt)== $user->hash){
            return $user;
        } else {
            return false;
        }
    }

    public function loginAction(){

        if(isset($_POST['submit'])){

            $login = $_POST['login'];
            $password = $_POST['password'];
            if($user = $this->_checkLogin($login,$password)){
                 $_SESSION['user'] = $user;
                 $this->app->view->userlogin = $user->login;
                 $this->app->view->login = $this->app->view->render('loginscs.phtml');
            }
        }
        header('Location: /');
    }


    public function logoutAction(){
       unset($_SESSION['user']);
        header('Location: /');
    }
} 