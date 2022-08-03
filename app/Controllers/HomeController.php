<?php

declare(strict_types=1);

namespace MVC\Controller;

use MVC\Core\BaseController;
use MVC\Core\Request;
use MVC\Model\UserModel;

class HomeController extends BaseController
{

    public function index(): string
    {
        $model = new UserModel();
        return self::render('Home/index',['title' => "Welcome ".$_ENV["NAME"]]);
    }

    public function post(): string
    {
        echo $this->getIp();
        return json_encode('Hello World!');
    }
}