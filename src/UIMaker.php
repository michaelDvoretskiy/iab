<?php

namespace Mariia\Iab;

class UIMaker
{
    public function render(string $template, array $params = []): void
    {
        $template = __DIR__ . '/templates/' . $template . '.php';
        include __DIR__ . '/templates/layout.php';
    }
}
