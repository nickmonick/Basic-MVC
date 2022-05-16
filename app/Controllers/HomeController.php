<?php

declare(strict_types=1);

namespace MVC\Controller;

use MVC\Core\BaseController;
use MVC\Core\Database;
use MVC\Core\Request;
use MVC\Core\View;
use MVC\Model\UserModel;

class HomeController extends BaseController
{
    private Request $request;
    public function __construct()
    {
        $this->request = new Request;
    }

    public function index(): string
    {
        return View::render('Home/index');
    }

    public function post()
    {
        return json_encode('Posted Successfully!');
    }
}