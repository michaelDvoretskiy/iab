<?php

namespace Mariia\Iab\Model\Repository;

use Mariia\Iab\Model\Entity\Author;
use Mariia\Iab\Model\Entity\Entity;
use Mariia\Iab\Model\Entity\User;

class AuthorRepository extends Repository
{
    public function findAll(): array
    {
        $stmt = $this->dbConnection->prepare('SELECT a.id, a.name, a.items_count, a.user_id, 
            u.login, u.email, u.password 
            FROM authors a left join users u on a.user_id = u.id 
            order by a.name');
        $stmt->execute();
        $result = $stmt->get_result();

        $dataFromDb = $result->fetch_all(MYSQLI_ASSOC);

        $authors = [];
        foreach ($dataFromDb as $row) {
            $authors[] = $this->mapRowToEntity($row);
        }

        return $authors;
    }

    public function findById(int $id): ?Author
    {
        $stmt = $this->dbConnection->prepare('SELECT a.id, a.name, a.items_count, a.user_id, 
            u.login, u.email, u.password 
            FROM authors a left join users u on a.user_id = u.id 
            WHERE a.id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $this->mapRowToEntity($row);
    }

    public function save(Entity $author): void
    {
        /** @var Author $author */
        if ($author->getId() === null) {
            $stmt = $this->dbConnection->prepare('INSERT INTO authors (name, user_id, items_count) VALUES (?, ?, ?)');
            $stmt->bind_param('sii', $author->getName(), $author->getUser()?->getId(), $author->getItemsCount());
            $stmt->execute();
            $author->setId($this->dbConnection->insert_id);
        } else {
            $stmt = $this->dbConnection->prepare(
                'UPDATE authors SET name = ?, user_id = ?, items_count = ? WHERE id = ?'
            );
            $stmt->bind_param(
                'siii',
                $author->getName(),
                $author->getUser()?->getId(),
                $author->getItemsCount(),
                $author->getId()
            );
            $stmt->execute();
        }
    }

    public function delete(int $id): void
    {
        $stmt = $this->dbConnection->prepare('DELETE FROM authors WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    protected function mapRowToEntity(array $row): Author
    {
        $user = null;
        if ($row['user_id']) {
            $user = new User($row['user_id'], $row['login'], $row['email'], $row['password']);
        }        

        return new Author($row['id'], $row['name'], $user, $row['items_count']);
    }
}