<?php

declare(strict_types=1);

namespace Framework;
class App {
    private Router $router;
    private Container $container;

    function __construct(string $containerDefinitionsPath=null)
    {
        $this->router = new Router();
        $this->container = new Container();
        if ($containerDefinitionsPath != null) {
            $containerDefinitions = include $containerDefinitionsPath;
            $this->container->addDefinitions($containerDefinitions);
        }
    }

    public function get(string $path, array $controller)
    {
        $this->router->add("GET", $path,$controller);
    }
    public function run() {
//        echo "App running...\n";
        $path = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
        $method = $_SERVER["REQUEST_METHOD"];
        $this->router->dispatch($path,$method,$this->container);
    }
}