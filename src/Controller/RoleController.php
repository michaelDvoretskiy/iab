<?php

namespace Mariia\Iab\Controller;

class RoleController extends Controller
{
    public function listRoles(): void
    {
        $model = $this->app->getModel();
        $roles = $model->getRepository('Role')->findAll();

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('roles', ['roles' => $roles]);
    }
}