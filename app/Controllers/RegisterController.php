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
        $this->model->loadData($_POST);
        $tb = $this->model->tableName;
        $this->model->db->query("INSERT INTO $tb (username,password) VALUES(:username, :password)");
        $this->model->db->bind(":username", $this->model->username);
        $this->model->db->bind(":password", password_hash($this->model->password,PASSWORD_BCRYPT));
        $this->model->db->execute();
        return "Registered";
    }
}