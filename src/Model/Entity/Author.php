<?php

namespace Mariia\Iab\Model\Entity;

class Author extends Entity
{
    public function __construct(
        ?int $id = null,
        private string $name = '',
        private ?User $user = null,
        private int $itemsCount = 0
    ) {
        parent::__construct($id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    public function getItemsCount(): int
    {
        return $this->itemsCount;
    }

    public function setItemsCount(int $itemsCount): void
    {
        $this->itemsCount = $itemsCount;
    }
}
