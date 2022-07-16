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

        $model->minLength(['username','password'],[4,8],[$model->username,$model->password])
              ->maxLength(['username','password'],[12,16],[$model->username,$model->password])
              ->required(['username','password'],[$model->username,$model->password]);

        $uniqueQuery = $model->db->prepare("SELECT username FROM $model->tableName WHERE username = :username LIMIT 1");
        $uniqueQuery->bindParam(":username", $model->username, PDO::PARAM_STR);
        $uniqueQuery->execute();
        $result = $uniqueQuery->fetch(PDO::FETCH_ASSOC);

        if ($result)
            return "Username Already Taken";

        if ($model->valid === false) {
            return self::render('Register/index', [
                'usernameError' => $model->errors['username'] ?? "",
                'passwordError' => $model->errors['password'] ?? "",
            ]);
        }

        $query = $model->db->prepare("INSERT INTO $model->tableName (username,password) VALUES(:username, :password);");
        $query->bindParam(":username", $model->username, PDO::PARAM_STR);
        $query->bindValue(":password", password_hash($model->password, PASSWORD_BCRYPT), PDO::PARAM_STR);
        $query->execute();

        $idQuery = $model->db->prepare("SELECT id FROM $model->tableName WHERE username = :username LIMIT 1");
        $idQuery->bindParam(":username", $model->username, PDO::PARAM_STR);
        $idQuery->execute();
        $id = $idQuery->fetch(PDO::FETCH_ASSOC);

        var_dump($id);

        return "Successfully Registered";
    }
}