<?php

namespace Mariia\Iab\Controller;

class RoleController extends Controller
{
    public function listRoles(): void
    {
        $model = $this->app->getModel();
        $roles = $model->getRepository('Role')->findAll();

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('roles/list', ['roles' => $roles]);
    }

    public function viewRole(): void
    {
        $roleId = $_GET['id'] ?? null;

        $model = $this->app->getModel();
        $role = $model->getRepository('Role')->findById($roleId);

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('roles/view', ['role' => $role]);
    }
}
