<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 13.07.14
 * Time: 16:05
 */

namespace models;


use microCMS\Db;

class ArticleModel extends  Db{
    private $db;
    private $table_name = 'article';

    public function __construct($db){
        $this->db = $db;
    }


    /**
     * @param $user
     * @param $route
     * @return array
     */
    public function getArticlesByUser($user, $route){

        $curent = '';
        $where = "WHERE is_protected=0";
        if($user) $where = '';

        $sql = sprintf("SELECT * from %s %s", $this->table_name, $where);
        $res = mysqli_query($this->db->link,$sql);
        $menu = array();
        while($row = mysqli_fetch_assoc($res)){
            $menu[]=$row;
            if($row['route'] == $route) $curent = $row;

        }
        return array('tree'=>$menu, 'curent'=>$curent);
    }

    /**
     * @param $article
     * @return int|string
     */
    public function updateArticle($article){
        $sql = sprintf(
            "UPDATE %s SET body='%s', title='%s' WHERE id=%d",
            $this->table_name,
            mysqli_real_escape_string($this->db->link,$article['body']),
            mysqli_real_escape_string($this->db->link,$article['title']),
            $article['id']);
        mysqli_query($this->db->link,$sql);
        return mysqli_insert_id($this->db->link);
    }


} 