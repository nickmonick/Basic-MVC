<?php

declare(strict_types=1);

namespace MVC\Core;

use PDO;
use PDOException;

abstract class Database
{
    private string $host;
    private string $dbUsername;
    private string $dbPassword;
    protected string $database ;

    public PDO $db;

    public function __construct()
    {
        $this->host = $_ENV['db.HOST'];
        $this->dbUsername = $_ENV['db.USERNAME'];
        $this->dbPassword = $_ENV['db.PASSWORD'];
        $this->database = $_ENV['db.DATABASE'];

        try {
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->database",$this->dbUsername,$this->dbPassword);
        } catch (PDOException $e) {
            echo "DATABASE ERROR: $e";
            die();
        }
    }

}

