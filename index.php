<?php

$req_uri = $_SERVER['REQUEST_URI'];
$parts = explode('/', ltrim($req_uri, '/'));

if (file_exists("Controller/" . $parts[0] . ".php")) {
    require "Controllers/" . $parts[0] . ".php";
} else {
    echo 'Not found';
}
if (class_exists($parts[0])) {
    $class = $parts[0];
    $class_obj = new $class;
} else {
    echo "Not found";
}
$method = $parts[1];
if (method_exists($class_obj, $method)) {
    $control_obj->$method();
} else {
    echo "Not found";
}
