<?php

declare(strict_types=1);

namespace MVC\Controller;

use MVC\Core\BaseController;
use MVC\Core\Request;
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
        $model = new UserModel();
        return self::render('Home/index',['title' => "Welcome ".$_ENV["NAME"]]);
    }

    public function post(): string
    {
        return json_encode('Hello World!');
    }
}