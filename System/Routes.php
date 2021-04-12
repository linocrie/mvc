<?php

namespace System;

class Routes
{
    function __construct($path)
    {
        if (!empty($path[0])) {
            $cntrl_class = ucfirst($path[0]);
            if (file_exists("Controllers" . DIRECTORY_SEPARATOR . $cntrl_class . ".php")) {
                $cntrl_class = "Controllers\\" . $cntrl_class;
                if (class_exists($cntrl_class)) {
                    $cntrl_obj = new $cntrl_class;
                    if (!empty($path[1])) {
                        $method = $path[1];
                        if (method_exists($cntrl_obj, $method)) {
                            $params = array_slice($path, 2);
                            call_user_func_array(array($cntrl_obj, $method), $params);
                        } else {
                            echo "404 ERROR";
                        }
                    } else {
                        if (method_exists($cntrl_obj, "index")) {
                            $cntrl_obj->index();
                        } else {
                            echo "Method not found";
                        }
                    }
                } else {
                    echo "ERROR 404";
                }
            } else {
                echo 'ERROR 404';
            }
        } else {
            //idk
        }
    }
}
