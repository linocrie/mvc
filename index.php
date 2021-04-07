<?php

$req_uri = $_SERVER['REQUEST_URI'];
$parts = explode('/', ltrim($req_uri, '/'));

$cntrl_class = ucfirst($parts[0]);

if (file_exists("Controllers/" . $cntrl_class . ".php")) {
    spl_autoload_register(function ($class_name) {
        include(str_replace("\\", "/", $class_name) . ".php");
    });
    $cntrl_class = "Controllers\\" . $cntrl_class;
    if (class_exists($cntrl_class)) {
        $class = $cntrl_class;
        $class_obj = new $class;
        $method = $parts[1];
        if (method_exists($class_obj, $method)) {
            $cntrl_obj->$method();
        } else {
            echo "Not found";
        }
    } else {
        echo "Not found";
    }
} else {
    echo 'Not found';
}
