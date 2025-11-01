<?php

namespace Mariia\Iab\Model\Entity;

class UserRole extends Entity
{
    public function __construct(
        ?int $id,
        private User $user,
        private Role $role
    ) {
        parent::__construct($id);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(Role $role): void
    {
        $this->role = $role;
    }
}
