<?php

namespace Mariia\Iab;

use Mariia\Iab\Model\Model;
use Mariia\Iab\Model\Repository\RoleRepository;

class App
{
    public function run(): void
    {
        $model = new Model();
        $roles = $model->getRepository('Role')->findAll();

        $uiMaker = new UIMaker();
        $uiMaker->renderRoles($roles);
    }
}