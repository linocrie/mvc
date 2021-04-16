<?php /** @noinspection ALL */

define ('SITE_ROOT', realpath(dirname(__FILE__)));


session_start();
spl_autoload_register(function ($class_name) {
    include str_replace("\\", DIRECTORY_SEPARATOR, $class_name . ".php");
});

use System\Routes;

$req_uri = $_SERVER['REQUEST_URI'];
$path = explode('/', ltrim($req_uri, '/'));

new Routes($path);
