<?php

declare(strict_types=1);

function dd (mixed $value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    die();
}

function escapeData (mixed $value) :string
{
//    echo   "=== escapeData";
//    $ret = htmlspecialchars($value);
//    echo   $value;
//    echo   $ret;
//    return $ret;
//    exit(0);

    $ret = htmlspecialchars($value);
    return $ret;
}