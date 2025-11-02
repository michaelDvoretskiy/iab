<?php

namespace Mariia\Iab\Model\Entity;

class User extends Entity
{
    private string $login;
    private string $email;
    private string $passowrd;
    private array $userRoles;

    public function __construct(
        ?int $id = null,
        string $login = '',
        string $email = '',
        string $passowrd = ''
    ) {
        parent::__construct($id);
        $this->login = $login;
        $this->email = $email;

        if ($id === null) {
            $this->setPlainPassword($passowrd);
        } else {
            $this->setPassowrd($passowrd);
        }
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassowrd(): string
    {
        return $this->passowrd;
    }

    public function setPassowrd(string $password): void
    {
        $this->passowrd = $password;
    }

    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->passowrd = $this->encriptPassword($plainPassword);
    }

    public function checkPassword(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->passowrd);
    }

    public function setUserRoles(array $userRoles): void
    {
        $this->userRoles = $userRoles;
    }

    public function isAdmin(): bool
    {
        /** @var UserRole $role */
        foreach ($this->userRoles as $role) {
            if ($role->getRole()->getName() == 'Admin') {
                return true;
            }
        }

        return false;
    }

    public function canEdit(): bool
    {
        /** @var UserRole $role */
        foreach ($this->userRoles as $role) {
            if ($role->getRole()->getName() == 'Editor') {
                return true;
            }
        }

        return false;
    }

    public function canRead(): bool
    {
        /** @var UserRole $role */
        foreach ($this->userRoles as $role) {
            if (in_array($role->getRole()->getName(), ['Editor', 'Reader'])) {
                return true;
            }
        }

        return false;
    }

    private function encriptPassword(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_BCRYPT);
    }
}
