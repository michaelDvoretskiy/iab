<?php

namespace Mariia\Iab;

class UIMaker
{
    public function render(string $template, array $params = []): void
    {
        include __DIR__ . '/templates/' . $template . '.php';
    }
}
