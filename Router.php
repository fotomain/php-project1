<?php

class Router {
    protected $routes = [];

    public function registerRoute($method,$uri,$controller)
    {
        $this->routes[] = [
            "method" => $method,
            "uri" => $uri,
            "controller" => $controller,
        ];
    }

    public function get($route, $controller)
    {
        $this->registerRoute("GET", $route, $controller);
    }
    public function post($route, $controller)
    {
        $this->registerRoute("POST", $route, $controller);
    }
    public function put($route, $controller)
    {
        $this->registerRoute("PUT", $route, $controller);
    }
    public function delete($route, $controller)
    {
        $this->registerRoute("DELETE", $route, $controller);
    }

    public function error($httpCode=404,$uri)
    {
        http_response_code($httpCode);
//        echo $uri;
        loadView("error/{$httpCode}",[]);
        exit;
    }
    public function route($uri, $method){
        foreach($this->routes as $route){
            if($route["uri"] === $uri && $route["method"] === $method){
                require basePath($route["controller"]);
                return;
            }
        }

        $this->error(404,$uri);
    }
}

