<?php
declare(strict_types=1);

namespace MVC\Core;

class Request
{
    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }

    public function getPost(): array
    {
        return $_POST;
    }
}