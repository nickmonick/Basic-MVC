<?php
declare(strict_types=1);

namespace MVC\Core;

abstract class Request
{
    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getPost(): array
    {
        return $_POST;
    }

    public function getGet(): array
    {
        return $_GET;
    }

    public function getIp(): string
    {
        return $_SERVER['REMOTE_ADDR'];
    }
}