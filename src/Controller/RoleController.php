<?php

namespace Mariia\Iab\Controller;

use Mariia\Iab\Model\Entity\Role;

class RoleController extends Controller
{
    public static array $routes = [
        ['path' => 'roles', 'method' => 'GET', 'action' => 'listRoles', 'security' => 'isAdmin'],
        ['path' => 'roles/view-one', 'method' => 'GET', 'action' => 'viewRole', 'security' => 'isAdmin'],
        ['path' => 'roles/add', 'method' => 'GET', 'action' => 'addRoleForm', 'security' => 'isAdmin'],
        ['path' => 'roles/add', 'method' => 'POST', 'action' => 'addRole', 'security' => 'isAdmin'],
        ['path' => 'roles/edit', 'method' => 'GET', 'action' => 'editRoleForm', 'security' => 'isAdmin'],
        ['path' => 'roles/edit', 'method' => 'POST', 'action' => 'editRole', 'security' => 'isAdmin'],
        ['path' => 'roles/delete', 'method' => 'POST', 'action' => 'deleteRole', 'security' => 'isAdmin'],
    ];

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

    public function addRoleForm(): void
    {
        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('roles/add');
    }

    public function addRole(): void
    {
        $roleName = $_POST['name'] ?? '';

        $model = $this->app->getModel();
        $role = new Role(null, $roleName);
        $model->getRepository('Role')->save($role);

        header('Location: /roles');
    }

    public function editRoleForm(): void
    {
        $roleId = $_GET['id'] ?? null;
        $model = $this->app->getModel();
        $role = $model->getRepository('Role')->findById($roleId);

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('roles/edit', ['role' => $role]);
    }

    public function editRole(): void
    {
        $roleName = $_POST['name'] ?? '';
        $roleId = $_GET['id'] ?? null;

        $model = $this->app->getModel();
        $roleRepo = $model->getRepository('Role');

        /** @var Role $role */
        $role = $roleRepo->findById($roleId);
        $role->setName($roleName);
        $roleRepo->save($role);

        header('Location: /roles');
    }

    public function deleteRole(): void
    {
        $roleId = $_GET['id'] ?? null;

        $model = $this->app->getModel();
        $model->getRepository('Role')->delete($roleId);
    }
}
