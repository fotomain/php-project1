<?php

declare(strict_types=1);

namespace Framework;

class Router{
    private $routes = [];
    private $middlewares = [];
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
        $path=str_replace('.php','',$path);
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
//                echo "route NOT found {$path}";
//                echo "route        in {$route['path']}";
//                echo "<br>";
//                echo "====================== 1";
//                echo "<br>";
//                echo json_encode($route);
                continue;
            }

//            echo "route found";
//            dd($route);
//            exit(0);

            [$class,$function]=$route['controller'];

//version1          $controllerInstance = new $class;
                $controllerInstance = $container ?
                    $container->resolve($class) :
                    new $class;

//            $controllerInstance->$function();
//verdion2    $controllerInstance->{$function}();
                        //=== prepare last of the stack functions
                        $action = fn() => $controllerInstance->{$function}();
                        //=== prepare stack of function calls
                        foreach ($this->middlewares as $middleware) {
                            //version1 $middlewareInstance = new $middleware;
                            $middlewareInstance = $container?
                                $container->resolve($middleware)
                                :new $middleware;
                            $action = fn() => $middlewareInstance->process($action);
                        }

                        $action();

                        return;
        }
    }

    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}
