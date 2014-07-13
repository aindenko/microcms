<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 13.07.14
 * Time: 19:49
 */

namespace microCMS;

class Autoloader
{
    const debug = 1;
    public function __construct(){}

    public static function autoload($file)
    {

        $file = str_replace('\\', '/', $file);
        $path = get_include_path();
        $paths = explode(PATH_SEPARATOR,$path);

        foreach($paths as $path){
            $filepath =  $path .'/'. $file . '.php';
           // var_dump(file_exists($filepath));
            if (file_exists($filepath))
            {
                require_once($filepath);
                return true;
            }
        }
    }

}
\spl_autoload_register('microCMS\Autoloader::autoload');

