<?php

namespace Mariia\Iab;

use Mariia\Iab\Model\Model;
use Mariia\Iab\Model\Repository\RoleRepository;

class App
{
    public function run(): void
    {
        $model = new Model();
        $roleRepository = new RoleRepository($model->dbConnection);
        $roles = $roleRepository->findAll();

        $uiMaker = new UIMaker();
        $uiMaker->renderRoles($roles);
    }
}