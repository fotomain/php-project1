<?php

function basePath($path='')
{
    return __DIR__.'/'.$path;
}

function loadView($name='')
{
    require basePath("views/{$name}.view.php");
}
function loadPartial($name='')
{
    require basePath("views/partials/{$name}.php");
}