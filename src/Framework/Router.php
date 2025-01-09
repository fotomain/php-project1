<?php

declare(strict_types=1);

namespace Framework;

class Router{
    private $routes = [];
    public function add(string $method, string $path, array $controller)
    {
        $path=$this->normalizePath($path);

        $this->routes[] = [
              'path'=>$path,
              'method'=>strtoupper($method),
              'controller'=>$controller
        ];
    }

    private function normalizePath(string $path):string{
        $path=trim($path,'/');
        $path="/{$path}/";
        $path=preg_replace('#[/]{2,}#','/',$path);
        return $path;
    }

    public function dispatch (string $path, string $method, Container $container = null)
    {
        $path=$this->normalizePath($path);
        $method=strtoupper($method);

//        echo $path . $method;

        foreach ($this->routes as $route) {
            if(
                !preg_match("#^{$route['path']}$#", $path)
                ||
                $method!==$route['method']
            ){
                continue;
            }

//            echo "route found";
//            dd($route);
            [$class,$function]=$route['controller'];

//version1          $controllerInstance = new $class;
                $controllerInstance = $container ?
                    $container->resolve($class) :
                    new $class;

    //            $controllerInstance->$function();
                $controllerInstance->{$function}();

        }
    }
}
