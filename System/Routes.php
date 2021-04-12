<?php
    namespace System;

    class Routes
{
    function __construct($path)
    {
        if (!empty($path[0])) {
            $ctrl_class = ucfirst($path[0]);
        } else {
            $ctrl_class = "Home";
        }
        if (file_exists("Controllers" . DIRECTORY_SEPARATOR . $ctrl_class . ".php")) {
            $ctrl_class = "Controllers\\" . $ctrl_class;
            if (class_exists($ctrl_class)) {
                $ctrl_obj = new $ctrl_class;
                if (!empty($path[1])) {
                    $method = $path[1];
                    if (method_exists($ctrl_obj, $method)) {
                        $params = array_slice($path, 2);
                        call_user_func_array(array($ctrl_obj, $method), $params);
                    } else {
                        echo "404 ERROR";
                    }
                } else {
                    if (method_exists($ctrl_obj, "index")) {
                        $ctrl_obj->index();
                    } else {
                        echo "Method not found";
                    }
                }
            } else {
                echo "ERROR 404";
            }
        } else {
            echo "File doesn't exist";
        }
    }
}
