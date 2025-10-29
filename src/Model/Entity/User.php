<?php

namespace Mariia\Iab\Model\Entity;

class User extends Entity
{
    private string $login;
    private string $email;
    private string $passowrd;

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

    private function encriptPassword(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_BCRYPT);
    }
}
