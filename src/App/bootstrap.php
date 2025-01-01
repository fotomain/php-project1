<?php

# load files and confs

declare(strict_types=1);

include __DIR__ . '/../../vendor/autoload.php';

use Framework\App;
use App\Controllers\AboutController;
use App\Controllers\HomeController;

$app = new App();
//$app->get('/',['App\Controllers\HomeController','home']);
$app->get('/',[HomeController::class,'home']);
$app->get('/about',[AboutController::class,'about']);

//dd($app);

return $app;

