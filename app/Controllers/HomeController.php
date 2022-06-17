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
        $model = new UserModel();
        $_SESSION["ID"] = 4;
        if(isset($_SESSION['ID'])) {
            $id = $_SESSION['ID'];
            $model->db->query("SELECT username FROM $model->tableName WHERE id='$id'");
            $name = $model->db->single()[0];
        }
        return View::render('Home/index',['title' => "Welcome $name"]);
    }

    public function post()
    {
        return json_encode('Posted Successfully!');
    }
}