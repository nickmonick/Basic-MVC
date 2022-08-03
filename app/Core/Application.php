<?php

declare(strict_types=1);

namespace MVC\Core;

use Dotenv;

class Application extends Router
{

    public function __construct()
    {
        parent::__construct();
        $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__,2));
        $dotenv->load();
    }

    /**
     * Gets the data from the router and outputs the content depending on what is sent back from it
     *
     * @return void
     */
    public function resolve(): void
    {
        $content = $this->match();
        if (is_bool($content) && !$this->match())
            echo View::errorPage("error","Something Went Wrong");
        elseif (is_string($content)) {
            echo $content;
        } elseif (is_callable($content)) {
            call_user_func($content);
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

    /**
     * @throws \Exception
     */
    public function put(string $uri, string $action): Application
    {
        $this->add('put', $uri, $action);

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function patch(string $uri, string $action): Application
    {
        $this->add('patch', $uri, $action);

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function delete(string $uri, string $action): Application
    {
        $this->add('delete', $uri, $action);

        return $this;
    }
}