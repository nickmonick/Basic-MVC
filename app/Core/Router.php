<?php

declare(strict_types=1);

namespace MVC\Core;

use Exception;

class Router
{
    /**
     * Routing Table
     *
     * @var array
     */
    protected array $routes = [];

    private Request $request;

    /**
     * Current viewing controlller
     *
     * @var string|null
     */
    private ?string $controller  = null;
    /**
     * Current viewing action from the current controller
     *
     * @var string|null
     */
    private ?string $action = null;

    public function __construct()
    {
        $this->request = new Request;
    }

    /**
     * Adds and validates the data given from the application into the routes table and throws exceptions if a method or a class is spelt/typed wrong
     *
     * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     * @throws \Exception
     */
    protected function add(string $method, string $uri, string $action): void
    {
        $valid = match ($method) {
            "get", "post" => true,
            default => false
        };

        if (!$valid)
            throw new Exception('Invalid Method');

        if (!$this->getClassAndMethod("$action"))
            throw new Exception('Invalid Class or Action');

        $this->routes[$method][$uri] = $action;
    }


    /**
     * Loops and sorts through the routing table and validates the actions and returns them to be output as a view
     *
     * @return bool|string
     */
    public function match(): bool | string
    {
        $method = $this->request->getMethod();
        $uri = $this->request->getUri();
        $routes = $this->getRouteMap($method);

        if (!key_exists($method,$this->routes) || !key_exists($uri,$routes))
            return View::errorPage("404");

        $action = $routes[$uri];

        if ($this->getClassAndMethod($action)) {
            $className = "MVC\\Controller\\" . $this->controller;
            $classInstance = new $className;
            $action = $this->action;
            return $classInstance->$action();
        }

        return false;
    }

    /**
     * Validates a given class from the app and adds the controller class and action to the properties
     *
     * @param string $action
     * @return bool
     */
    private function getClassAndMethod(string $action): bool
    {
        $classAndMethod = explode('@', $action);

        $className = "MVC\\Controller\\".$classAndMethod[0];

        $instance = new $className();

        if (class_exists($className) && method_exists($instance, $classAndMethod[1])) {
            $this->controller = $classAndMethod[0];
            $this->action = $classAndMethod[1];
            return true;
        }

        return false;
    }

    /**
     * Returns the keys of the urls in the routes table that are under the given request method
     *
     * @param string $method
     * @return array
     */
    private function getRouteMap(string $method):array
    {
        return $this->routes[$method];
    }

}