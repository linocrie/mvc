<?php

spl_autoload_register(function ($class_name) {
    include DIRECTORY_SEPARATOR . $class_name . ".php";
});
