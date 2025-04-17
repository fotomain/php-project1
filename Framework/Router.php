<?php

namespace Framework;
use App\controllers\ErrorController;

class Router {
    protected $routes = [];

    public function registerRoute($method,$uri,$action)
    {
        list($controller,$controllerMethod) = explode('@',$action);
        $this->routes[] = [
            "method" => $method,
            "uri" => $uri,
            "controller" => $controller,
            "controllerMethod" => $controllerMethod,
        ];
    }

    public function registerRoute000($method,$uri,$controller)
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


    public function route000($uri, $method){
        foreach($this->routes as $route){
            if($route["uri"] === $uri && $route["method"] === $method){
                require basePath('App/' . $route["controller"]);
                return;
            }
        }

        $this->error(404,$uri);
    }
    public function route($uri, $method){
        foreach($this->routes as $route){
            if($route["uri"] === $uri && $route["method"] === $method){

                $controller = 'App\\Controllers\\' . $route["controller"];
                $controllerMethod = $route["controllerMethod"];
                //=== class + call method
                $controllerInstance = new $controller();
                $controllerInstance->$controllerMethod();

                // $listing = new ListingController();
                // $listing->index();

                return;
            }
        }

        ErrorController::notFound();

    }

}

