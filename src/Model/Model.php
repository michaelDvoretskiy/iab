<?php

namespace Mariia\Iab\Model;

use Exception;
use Mariia\Iab\Model\Repository\Repository;
use mysqli;

class Model
{
    public ?mysqli $dbConnection = null;
    private string $host = 'localhost';
    private string $user = 'root';
    private string $password = '';
    private string $dbName = 'iab';
    private int $port = 3306;

    public function __construct()
    {
        try {
            $this->connect();
        } catch (Exception $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }
    
    private function connect(): void
    {
        $this->dbConnection = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->dbName,
            $this->port
        );
    }
}
