<?php

namespace Mariia\Iab;

class App
{
    public function run(): void
    {
        $dbReader = new DBReader();
        $roles = $dbReader->getRoles();

        $uiMaker = new UIMaker();
        $uiMaker->renderRoles($roles);
    }
}