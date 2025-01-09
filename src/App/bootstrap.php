<?php

# load files and confs

declare(strict_types=1);

include __DIR__ . '/../../vendor/autoload.php';

use Framework\App;
use App\Config\Paths;
use function App\Config\registerRoutes;
$app = new App(Paths::SOURCE."app/container-definitions.php");

registerRoutes($app);

//$app->get('/',['App\Controllers\HomeController','home']);

//dd($app);

return $app;

