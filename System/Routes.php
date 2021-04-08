<?php

namespace System;

class Routes
{
    function __construct($path)
    {
        if (!empty($path[0])) {
            $cntrl_class = ucfirst($path[0]);
        }
        if (file_exists("Controllers/" . DIRECTORY_SEPARATOR . $cntrl_class . ".php")) {
            $cntrl_class = "Controllers\\" . $cntrl_class;
            if (class_exists($cntrl_class)) {
                $class = $cntrl_class;
                $cntrl_obj = new $class;
                if (!empty($path[1])) {
                    $method = $path[1];
                    if (method_exists($cntrl_obj, $method)) {
                        $params = array_slice($path, 2);
                        call_user_func_array(array($cntrl_obj, $method), $params);
                    } else {
                        echo "Not found";
                    }
                }
            } else {
                echo "Not found";
            }
        } else {
            echo 'Not found';
        }
    }
}
