<?php

declare(strict_types=1);

namespace MVC\Controller;

class HomeController
{
    public function index(): string
    {
        return 'Home/homepage';
    }
}