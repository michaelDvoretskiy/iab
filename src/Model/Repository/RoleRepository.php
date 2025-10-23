<?php

namespace Mariia\Iab\Model\Repository;

use Mariia\Iab\Model\Entity\Entity;
use Mariia\Iab\Model\Entity\Role;

class RoleRepository extends Repository
{
    public function findAll(): array
    {
        $stmt = $this->dbConnection->prepare('SELECT id, name FROM roles order by name');
        $stmt->execute();
        $result = $stmt->get_result();

        $dataFromDb = $result->fetch_all(MYSQLI_ASSOC);

        $roles = [];
        foreach ($dataFromDb as $row) {
            $roles[] = $this->mapRowToEntity($row);
        }

        return $roles;
    }

    public function findById(int $id): ?Role
    {
        $stmt = $this->dbConnection->prepare('SELECT id, name FROM roles WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $this->mapRowToEntity($row);
    }

    public function save(Entity $role): void
    {        
        /** @var Role $role */
        return;
    }

    public function delete(int $id): void
    {
        return;
    }

    protected function mapRowToEntity(array $row): Role
    {
        return new Role($row['id'], $row['name']);
    }
}
