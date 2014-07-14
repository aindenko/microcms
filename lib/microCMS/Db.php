<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 13.07.14
 * Time: 16:00
 */

namespace microCMS;


class Db {
    private $settings = array();
    public $link = false;

    public function __construct(array $settings){
        $this->settings = $settings;
    }

    public function getConnection(){
        $this->link = mysqli_connect(
            $this->settings['db_host'],
            $this->settings['db_user'],
            $this->settings['db_password'],
            $this->settings['db_name']
        );

        if($this->link === false){
            throw new Exception('Error connection');
        }

    }
} 