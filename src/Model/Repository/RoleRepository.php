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
        if ($role->getId() === null) {
            $stmt = $this->dbConnection->prepare('INSERT INTO roles (name) VALUES (?)');
            $stmt->bind_param('s', $role->getName());
            $stmt->execute();
            $role->setId($this->dbConnection->insert_id);
        } else {
            $stmt = $this->dbConnection->prepare('UPDATE roles SET name = ? WHERE id = ?');
            $stmt->bind_param('si', $role->getName(), $role->getId());
            $stmt->execute();
        }
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
