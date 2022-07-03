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

    public function __construct()
    {
        $this->request = new Request;
    }

    public function index(): string
    {
        return  self::render('Register/index');
    }

    public function register(): string
    {
        $model = new UserModel($_POST);

        $canPostUsername = ($model->required('username', $model->username) && $model->minLength("username",8,$model->username) && $model->maxLength('username', 16,$model->username));
        $canPostPassword = ($model->required('password',$model->password) && $model->minLength("password",8,$model->password) && $model->maxLength("password",16,$model->password));

        if (!$canPostUsername || !$canPostPassword) {
            return self::render('Register/index',[
                'usernameError' => $model->errors['username'] ?? "",
                'passwordError' => $model->errors['password'] ?? "",
            ]);
        }

        $query = $model->db->prepare("INSERT INTO $model->tableName (username,password) VALUES(:username, :password)");
        $query->bindParam(":username", $model->username,PDO::PARAM_STR);
        $hash = password_hash($model->password,PASSWORD_BCRYPT);
        $query->bindParam(":password", $hash, PDO::PARAM_STR);
        $query->execute();

        return "Successfully Registered";
    }
}