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
    function __construct($app){
        $this->app = $app;

        $this->app->view->templateName = 'article.phtml';
    }

    public function indexAction(){

        $articleModel = new ArticleModel($this->app->db);
        $result = $articleModel->getArticlesByUser($this->app->user,end($this->app->query));
        $tree = $result['tree'];
        $current = $result['curent'];

        $this->app->view->menuTree = $tree;
        $this->app->view->menu = $this->app->view->render('menu.phtml');
        $this->app->view->title = $current['title'];
        $this->app->view->body = $current['body'];
    }

}