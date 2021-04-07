<?php

namespace B_dir;

use A_dir\A;

class B extends A
{
    function __construct()
    {
        parent::__construct();
        echo "Class B ";
    }
}
