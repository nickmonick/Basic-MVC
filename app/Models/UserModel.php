<?php

declare(strict_types=1);

namespace MVC\Model;

use MVC\Core\Model;

class UserModel extends Model
{
    /**
     * The tablename is used to find which table to take informations to and from
     *
     * @var string
     */
    public string $tableName = "users";
    /**
     * This property exists to filter and limit what can be put into the model object
     *
     * @var array|string[]
     */
    public array $allowedFields = ["username", "password"];

    public array $errorMessages = [
        'username' => [
            'minlength' => 'The username must be more than % characters',
            'maxlength' => 'The username must be under % characters',
            'required' => 'This field is required',
        ],
        'password' => [
            'minlength' => 'The password must be more than % characters',
            'maxlength' => 'The password must be under % characters',
            'required' => 'This field is required',
        ],
    ];
}