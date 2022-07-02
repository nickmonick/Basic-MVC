<?php

declare(strict_types=1);

namespace MVC\Core;

use PDO;
use PDOException;

abstract class Database
{
    private string $host = 'localhost';
    private string $dbUsername = 'root';
    private string $dbPassword = '';
    protected string $database = 'swift';

    protected PDO $dbh;

    public function __construct()
    {
        try {
            $this->dbh = new PDO("mysql:host=$this->host;dbname=$this->database",$this->dbUsername,$this->dbPassword);
        } catch (PDOException $e) {
            echo "DB ERROR: $e";
            die();
        }
    }

}

