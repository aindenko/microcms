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


    public function getArticlesByUser($user, $route){

        $sql = sprintf("SELECT * from %s", $this->table_name);
        $res = mysqli_query($this->db->link,$sql);
        $menu = array();
        while($row = mysqli_fetch_assoc($res)){
            $menu[]=$row;
            if($row['route'] == $route) $curent = $row;

        }
        return array('tree'=>$menu, 'curent'=>$curent);
    }

    /*function formatTree($tree, $parent){
        $tree2 = array();
        foreach($tree as $i => $item){
            if($item['parent_id'] == $parent){
                $tree2[$item['id']] = $item;
                $tree2[$item['id']]['submenu'] = $this->formatTree($tree, $item['id']);
            }
        }

        return $tree2;
    }*/
} 