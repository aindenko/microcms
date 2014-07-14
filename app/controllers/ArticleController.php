<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 13.07.14
 * Time: 17:35
 */

namespace controllers;


use microCMS\Controller;
use models\ArticleModel;

class ArticleController extends Controller {
    private $app;
    private $articleModel;
    function __construct($app){
        $this->app = $app;

        $this->app->view->templateName = 'article.phtml';

        if(isset($this->app->user) && ($this->app->user->right==1)){

            $this->app->view->templateName = 'articleedit.phtml';
        }
        $this->articleModel = new ArticleModel($this->app->db);
    }

    public function indexAction(){

        $route ='';
        if(is_array($this->app->query)){
            $route = end($this->app->query);
        }

        $result = $this->articleModel->getArticlesByUser($this->app->user,$route);
        $tree = $result['tree'];
        $current = $result['curent'];
        if(empty($current)||$current==''){
            $current = $result['tree'][0];
        }

        $this->app->view->menuTree = $tree;
        $this->app->view->menu = $this->app->view->render('menu.phtml');
        $this->app->view->article_id = $current['id'];
        $this->app->view->title = $current['title'];
        $this->app->view->body = $current['body'];
        $this->app->view->return = $_SERVER['REQUEST_URI'];

    }

    public function saveAction(){
        if(isset($_POST['submit'])){
            $this->articleModel->updateArticle($_POST);
            header("Location: ".$_POST['return']);
        }
    }

}