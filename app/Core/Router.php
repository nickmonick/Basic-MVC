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
    public View $view;

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
        $this->view = new View;
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
    protected function add(string $method, string $uri, string $action)
    {
        $valid = match ($method) {
            "get", "post" => true,
            default => false
        };

        if ($valid)
            if ($this->getClassAndMethod("$action"))
                $this->routes[$method][$uri] = $action;
            else
                throw new Exception('Invalid Class or Method');
        else
            throw new Exception('Invalid Method');
    }


    /**
     * Loops and sorts through the routing table and validates the actions and returns them to be output as a view
     *
     * @return bool|string
     */
    public function match(): bool | string
    {
        $uri = $this->request->getUri();
        $method = $this->request->getMethod();

        foreach ($this->routes[$method] as $route => $action) {
            if ($uri === $route) {
                if($this->getClassAndMethod($action)) {
                    $className = "MVC\\Controller\\".$this->controller;
                    $classInstance = new $className;
                    $action = $this->action;
                    return $this->view->view($classInstance->$action());
                }
                else
                    return false;
            }
        }
        return false;
    }

    /**
     * Validates a given class from the app and adds the controller class and action to the properties
     *
     * @param string $action
     * @return void
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
        } else
            return false;
    }

}