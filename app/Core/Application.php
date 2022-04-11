<?php

declare(strict_types=1);

namespace MVC\Core;


class Application extends Router
{

    public function resolve(): void
    {
        echo $this->match() ? "Route Found" : "Route Not Found";
    }

    public function get(string $uri, string $action): Application
    {
        $this->add('get', $uri, $action);

        return $this;
    }

    public function post(string $uri, string $action): Application
    {
        $this->add('post', $uri, $action);

        return $this;
    }
}