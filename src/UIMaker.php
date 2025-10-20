<?php

namespace Mariia\Iab;

class UIMaker
{
    public function renderRoles(array $roles): void
    {
        $params = ['roles' => $roles];
        include __DIR__ . '/templates/roles.php';
    }
}
