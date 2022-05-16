<?php

declare(strict_types=1);

namespace MVC\Controller;

use MVC\Core\BaseController;
use MVC\Core\Request;
use MVC\Core\View;
use MVC\Model\UserModel;

class RegisterController extends BaseController
{
    //(Example/Testing Controller To Test Model)

    private Request $request;
    private UserModel $model;

    public function __construct()
    {
        $this->model = new UserModel;
        $this->request = new Request;
    }

    public function index(): string
    {
        return View::render('Register/index');
    }

    public function register(): string
    {
        $post = $this->request->getPost();
        $this->model->loadData($post);
        $this->dump($this->model);
        return "Success";
    }
}