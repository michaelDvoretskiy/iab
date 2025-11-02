<?php

namespace Mariia\Iab\Model\Repository;

use Mariia\Iab\Model\Entity\Entity;
use Mariia\Iab\Model\Entity\User;

class UserRepository extends Repository
{
    public function findAll(): array
    {
        $stmt = $this->dbConnection->prepare('SELECT id, login, email, password FROM users order by login');
        $stmt->execute();
        $result = $stmt->get_result();

        $dataFromDb = $result->fetch_all(MYSQLI_ASSOC);

        $users = [];
        foreach ($dataFromDb as $row) {
            $users[] = $this->mapRowToEntity($row);
        }

        return $users;
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->dbConnection->prepare('SELECT id, login, email, password FROM users WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $this->mapRowToEntity($row);
    }

    public function findByLogin(string $login): ?User
    {
        $stmt = $this->dbConnection->prepare('SELECT id, login, email, password FROM users WHERE login = ?');
        $stmt->bind_param('s', $login);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $this->mapRowToEntity($row);
    }

    public function save(Entity $user): void
    {
        /** @var User $user */
        if ($user->getId() === null) {
            $stmt = $this->dbConnection->prepare('INSERT INTO users (login, email, password) VALUES (?, ?, ?)');
            $stmt->bind_param('sss', $user->getLogin(), $user->getEmail(), $user->getPassowrd());
            $stmt->execute();
            $user->setId($this->dbConnection->insert_id);
        } else {
            $stmt = $this->dbConnection->prepare('UPDATE users SET login = ?, email = ?, password = ? WHERE id = ?');
            $stmt->bind_param('sssi', $user->getLogin(), $user->getEmail(), $user->getPassowrd(), $user->getId());
            $stmt->execute();
        }
    }

    public function delete(int $id): void
    {
        $stmt = $this->dbConnection->prepare('DELETE FROM users WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    protected function mapRowToEntity(?array $row): ?User
    {
        if (is_null($row)) {
            return null;
        }

        return new User($row['id'], $row['login'], $row['email'], $row['password']);
    }
}