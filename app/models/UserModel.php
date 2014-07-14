<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 13.07.14
 * Time: 16:04
 */

namespace models;

use microCMS\Db;
class UserModel extends Db {

    private $db;
    private $table_name = 'user';

    public function __construct($db){
        $this->db = $db;
    }

    public function getUserByLogin($login){

        $sql = sprintf("SELECT * from %s WHERE login = '%s'", $this->table_name, $login);
        return mysqli_fetch_object(mysqli_query($this->db->link,$sql));
    }

} 