<?php

function basePath($path='')
{
    return __DIR__.'/'.$path;
}

function loadView($name='')
{
    $path = basePath("views/{$name}.view.php");

    if(file_exists($path)){
        require $path;
    } else {
        echo "Error! View '{$path}' not found";
    }
}
function loadPartial($name='')
{
    $path = basePath("views/partials/{$name}.php");
    if(file_exists($path)){
        require $path;
    } else {
        echo "Error! Partial '{$path}' not found";
    }

}

function inspect($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

function inspectAndDie($value)
{
    echo "<pre>";
    die(var_dump($value));
    echo "</pre>";
}