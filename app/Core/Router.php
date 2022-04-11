<?php

declare(strict_types=1);

namespace MVC\Core;

require __DIR__.'/../../vendor/autoload.php';


class Router
{
    protected array $routes = [];
    private Request $request;
    private ?string $controller  = null;
    private ?string $action = null;

    public function __construct()
    {
        $this->request = new Request();
    }

    protected function add(string $method, string $uri, string $action)
    {
        $valid = match ($method) {
            "get", "post" => true,
            default => false
        };

        if ($valid)
            $this->routes[$method][$uri] = $action;
        else
            throw new \Exception('Invalid Method');
    }


    public function match(): bool
    {
        $uri = $this->request->getUri();
        $method = $this->request->getMethod();

        foreach ($this->routes[$method] as $route => $action) {
            if ($uri === $route) {
                $this->getClassAndMethod($action);
                return true;
            }
        }
        return false;
    }

    /**
     *
     *
     * @param string $action
     * @return void
     */
    private function getClassAndMethod(string $action): void
    {
        $classAndMethod = explode('@', $action);

        if (class_exists($classAndMethod[0]) && method_exists($classAndMethod[0], $classAndMethod[1])) {
            $this->controller = $classAndMethod[0];
            $this->action = $classAndMethod[1];
        }


    }

}