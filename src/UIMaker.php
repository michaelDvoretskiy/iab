<?php

namespace Mariia\Iab;

use Mariia\Iab\Model\Entity\User;

class UIMaker
{
    public function __construct(private ?User $currentUser)
    {
    }

    public function render(string $template, array $params = []): void
    {
        $params['currentUser'] = $this->currentUser;
        $template = __DIR__ . '/templates/' . $template . '.php';
        include __DIR__ . '/templates/layout.php';
    }
}
