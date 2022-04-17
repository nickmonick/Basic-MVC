<?php

declare(strict_types=1);

namespace MVC\Core;


class Application extends Router
{

    /**
     * Gets the data from the router and outputs the content depending on what is sent back from it
     *
     * @return void
     */
    public function resolve(): void
    {
        if (is_bool($this->match())) {
            echo $this->match() ?? "Route Not Found";
        } else {
            echo $this->match();
        }
    }

    /**
     * Stores a get method with the action in an array
     *
     * @param string $uri
     * @param string $action
     * @return $this
     * @throws \Exception
     */
    public function get(string $uri, string $action): Application
    {
        $this->add('get', $uri, $action);

        return $this;
    }

    /**
     * Stores a post method with the action in an array
     *
     * @param string $uri
     * @param string $action
     * @return $this
     * @throws \Exception
     */
    public function post(string $uri, string $action): Application
    {
        $this->add('post', $uri, $action);

        return $this;
    }
}