<?php

declare(strict_types=1);

namespace Framework;

use ReflectionClass; //PHP native
use ReflectionNamedType; //PHP native
use Framework\Exceptions\ContainerException;

class Container
{
    private array $definitions = [];
    private array $resolved = [];

    public function addDefinitions(array $newDefinitions = [])
    {
//        $this->definitions = array_merge($this->definitions, $newDefinitions);
        $this->definitions = [...$this->definitions, ...$newDefinitions];
//        dd($this->definitions);
    }

    public function resolve(string $className)
    {
        $reflectionClass = new ReflectionClass($className);
        if(!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Class name {$className} is not instantiable");
        }

        $constructor = $reflectionClass->getConstructor();
        if(!$constructor) {
            return new $className;
        }

        $params = $constructor->getParameters();
        if(count($params) === 0) {
            return new $className;
        }

//        dd($params);

        $dependencies = [];
        foreach($params as $param) {
            $name = $param->getName();
            $type = $param->getType();
            if($type === null) {
                throw new ContainerException("Failed to resolve class because parameter {$param->getName()} is required");
            }

            if(!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Failed to resolve class because type no instanceof ReflectionNamedType  {$param->getName()}  ");
            }

            $dependencies[] = $this->get($type->getName());

        }

//        dd($dependencies);

        return $reflectionClass->newInstanceArgs($dependencies);

    }

    public function get(string $id)
    {
        if(!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("Class {$id} does not exist in container");
        }

        if(array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        $factory=$this->definitions[$id];
            $dependency = $factory();

                $this->resolved[$id]=$dependency;

                return $dependency;
    }

}