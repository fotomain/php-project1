<?php

# load files and confs

declare(strict_types=1);

include __DIR__ . '/../../vendor/autoload.php';

use Framework\App;
use App\Controllers\HomeController;

$app = new App();
//$app->get('/',['App\Controllers\HomeController','home']);
$app->get('/',[HomeController::class,'home']);

//dd($app);

return $app;

