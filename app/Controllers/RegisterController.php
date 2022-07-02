<?php

declare(strict_types=1);

namespace MVC\Controller;

use MVC\Core\BaseController;
use MVC\Core\Request;
use MVC\Core\View;
use MVC\Model\UserModel;
use PDO;

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
        $model = new UserModel($_POST);
    /*
        $tb = $model->tableName;
        $model->query("INSERT INTO $tb (username,password) VALUES(:username, :password)");
        $model->bind(":username", $model->username);
        $model->bind(":password", password_hash($model->password,PASSWORD_BCRYPT));
        $model->execute();
    */
        return "Registered";
    }
}