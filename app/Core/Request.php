<?php
declare(strict_types=1);

namespace MVC\Core;

class Request
{
    public function getUri(): string
    {
        if (empty(trim($_SERVER['REQUEST_URI'], '/'))) {
            return $_SERVER['REQUEST_URI'];
        }
        return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    public function getPost(): array
    {
        return $_POST;
    }

}