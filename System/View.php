<?php

namespace System;
class View
{
    function __get($name) {
        return null;
    }
    public function render ($file_name, $layout = true) {
        if(file_exists("Views" . DIRECTORY_SEPARATOR . $file_name.".php")){
            if($layout) {
                if(file_exists('Views' . DIRECTORY_SEPARATOR . 'layout'. DIRECTORY_SEPARATOR . 'header.php') && file_exists('Views' . DIRECTORY_SEPARATOR . 'layout'. DIRECTORY_SEPARATOR . 'footer.php')){
                    include 'Views' . DIRECTORY_SEPARATOR . 'layout'. DIRECTORY_SEPARATOR . 'header.php';
                    include 'Views' . DIRECTORY_SEPARATOR . $file_name.'.php';
                    include 'Views' . DIRECTORY_SEPARATOR . 'layout'. DIRECTORY_SEPARATOR . 'footer.php';
                }
                else{
                    echo "Header and footer doesn't exist";
                }
            }
            else{
                include 'Views' . DIRECTORY_SEPARATOR . $file_name.'.php';
            }
        }
        else{
            echo "$file_name doesn't exist ";
        }

    }

}