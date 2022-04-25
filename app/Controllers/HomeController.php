<?php

declare(strict_types=1);

namespace MVC\Controller;

use MVC\Core\Request;
use MVC\Core\View;

class HomeController
{
    private Request $request;
    public function __construct()
    {
        $this->request = new Request;
    }

    public function index(): string
    {
        if ($this->request->isPost()) {
            return json_encode('Post');
        }

        return View::render('Home/index');
    }
}