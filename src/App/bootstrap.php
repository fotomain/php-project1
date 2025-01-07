<?php

# load files and confs

declare(strict_types=1);

include __DIR__ . '/../../vendor/autoload.php';

use Framework\App;
use function App\Config\registerRoutes;
$app = new App();

registerRoutes($app);

//$app->get('/',['App\Controllers\HomeController','home']);

//dd($app);

return $app;

