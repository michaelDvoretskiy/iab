<?php

namespace Mariia\Iab;

use Exception;
use mysqli;

class DBReader
{
    private ?mysqli $dbConnection = null;
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

    public function getRoles(): array
    {
        try {
            $stmt = $this->dbConnection->prepare('SELECT id, name FROM roles order by name');
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            die('sql failed: ' . $e->getMessage());
        }
    }
}
