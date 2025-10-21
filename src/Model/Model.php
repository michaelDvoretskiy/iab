<?php

namespace Mariia\Iab\Model;

use Exception;
use Mariia\Iab\Model\Repository\Repository;
use mysqli;

class Model
{
    private ?mysqli $dbConnection = null;
    private string $host = 'localhost';
    private string $user = 'root';
    private string $password = '';
    private string $dbName = 'iab';
    private int $port = 3306;

    private array $repositories = [];

    public function __construct()
    {
        try {
            $this->connect();
        } catch (Exception $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function getRepository(string $name): Repository
    {
        if (!isset($this->repositories[$name])) {
            $this->repositories[$name] = $this->createRepository($name);
        }

        return $this->repositories[$name];
    }

    private function createRepository(string $name): ?Repository
    {
        $repositoryClass = 'Mariia\\Iab\\Model\\Repository\\' . $name . 'Repository';

        if (class_exists($repositoryClass)) {
            return new $repositoryClass($this->dbConnection);
        }

        return null;
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
