<?php

namespace Mariia\Iab\Model\Entity;

class Role extends Entity
{
    private string $name;

    public function __construct(?int $id = null, string $name = '')
    {
        parent::__construct($id);
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}