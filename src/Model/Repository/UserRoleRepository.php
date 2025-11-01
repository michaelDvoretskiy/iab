<?php

namespace Mariia\Iab\Model\Repository;

use Mariia\Iab\Model\Entity\Entity;
use Mariia\Iab\Model\Entity\Role;
use Mariia\Iab\Model\Entity\User;
use Mariia\Iab\Model\Entity\UserRole;

class UserRoleRepository extends Repository
{
    public function findAll(): array
    {
        $stmt = $this->dbConnection->prepare('SELECT ur.id, ur.user_id, u.login, ur.role_id, r.name, 
            u.login, u.email, u.password 
            FROM user_roles ur inner join users u on ur.user_id = u.id 
            inner join roles r on ur.role_id = r.id
            order by u.login, r.name');
        $stmt->execute();
        $result = $stmt->get_result();

        $dataFromDb = $result->fetch_all(MYSQLI_ASSOC);

        $userRoles = [];
        foreach ($dataFromDb as $row) {
            $userRoles[] = $this->mapRowToEntity($row);
        }

        return $userRoles;
    }

    public function findByUser(int $userId): array
    {
        $stmt = $this->dbConnection->prepare('SELECT ur.id, ur.user_id, u.login, ur.role_id, r.name, 
            u.login, u.email, u.password 
            FROM user_roles ur inner join users u on ur.user_id = u.id 
            inner join roles r on ur.role_id = r.id
            where ur.user_id = ?
            order by r.name');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        $dataFromDb = $result->fetch_all(MYSQLI_ASSOC);

        $userRoles = [];
        foreach ($dataFromDb as $row) {
            $userRoles[] = $this->mapRowToEntity($row);
        }

        return $userRoles;
    }

    public function findById(int $id): ?UserRole
    {
        $stmt = $this->dbConnection->prepare('SELECT ur.id, ur.user_id, u.login, ur.role_id, r.name, 
            u.login, u.email, u.password 
            FROM user_roles ur inner join users u on ur.user_id = u.id 
            inner join roles r on ur.role_id = r.id
            WHERE ur.id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $this->mapRowToEntity($row);
    }

    public function save(Entity $userRole): void
    {
        /** @var UserRole $userRole */
        if ($userRole->getId() === null) {
            $stmt = $this->dbConnection->prepare('INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)');
            $stmt->bind_param('ii', $userRole->getUser()->getId(), $userRole->getRole()->getId());
            $stmt->execute();
            $userRole->setId($this->dbConnection->insert_id);
        } else {
            $stmt = $this->dbConnection->prepare(
                'UPDATE user_roles SET user_id = ?, role_id = ? WHERE id = ?'
            );
            $stmt->bind_param(
                'iii',
                $userRole->getUser()->getId(),
                $userRole->getRole()->getId(),
                $userRole->getId()
            );
            $stmt->execute();
        }
    }

    public function delete(int $id): void
    {
        $stmt = $this->dbConnection->prepare('DELETE FROM user_roles WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    protected function mapRowToEntity(array $row): UserRole
    {
        $user = new User($row['user_id'], $row['login'], '', '');
        $role = new Role($row['role_id'], $row['name']);

        return new UserRole($row['id'], $user, $role);
    }
}
