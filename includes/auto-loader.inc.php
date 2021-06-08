  
<?php
spl_autoload_register('autoLoader');

    function autoLoader($className){
        $path = "../classes/";
        $ext = ".class.php";
        $fullPath = $path.$className.$ext;

        if(!file_exists($fullPath)){
            return false;
        }
        require_once $fullPath;
    }