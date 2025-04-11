<?php

//php -S localhost:8000
//php -S localhost:8000 -t public

require '../helpers.php';

//loadView('home');

$uri = $_SERVER['REQUEST_URI'];

require basePath('router.php');


