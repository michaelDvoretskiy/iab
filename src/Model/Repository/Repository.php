<?php

namespace Mariia\Iab\Model\Repository;

use Mariia\Iab\Model\Entity\Entity;
use mysqli;

abstract class Repository
{
    public function __construct(protected mysqli $dbConnection)
    {
    }
    
    abstract public function findAll(): array;

    abstract public function findById(int $id): ?Entity;
    
    abstract public function save(Entity $entity): void;

    abstract public function delete(int $id): void;

    abstract protected function mapRowToEntity(?array $row): ?Entity;
}