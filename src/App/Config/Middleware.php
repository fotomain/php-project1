<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\TemplateDataMiddleware;
use App\Middleware\ValidationExceptionMiddleware;

function registerMiddleware(App $app): void
{
    $app->addMiddleware(TemplateDataMiddleware::class);
//    $app->addMiddleware(ValidationExceptionMiddleware::class);
}