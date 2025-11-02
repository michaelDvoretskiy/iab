<?php

namespace Mariia\Iab\Controller;

use Mariia\Iab\App;
use Mariia\Iab\Model\Entity\Author;
use Mariia\Iab\Model\Entity\UserRole;

class UserRoleController extends Controller
{
    public static array $routes = [
        ['path' => 'user-roles', 'method' => 'GET', 'action' => 'list', 'security' => 'isAdmin'],
        ['path' => 'user-roles/view', 'method' => 'GET', 'action' => 'view', 'security' => 'isAdmin'],
        ['path' => 'user-roles/add', 'method' => 'GET', 'action' => 'addForm', 'security' => 'isAdmin'],
        ['path' => 'user-roles/add', 'method' => 'POST', 'action' => 'add', 'security' => 'isAdmin'],
        ['path' => 'user-roles/edit', 'method' => 'GET', 'action' => 'editForm', 'security' => 'isAdmin'],
        ['path' => 'user-roles/edit', 'method' => 'POST', 'action' => 'edit', 'security' => 'isAdmin'],
        ['path' => 'user-roles/delete', 'method' => 'POST', 'action' => 'delete', 'security' => 'isAdmin'],
    ];

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function list(): void
    {
        $userId = $_GET['userId'];
        $model = $this->app->getModel();
        $user = $model->getRepository('User')->findById($userId);
        /** @var UserRoleRepository $userRoleRepo */
        $userRoleRepo = $model->getRepository('UserRole');
        $userRoles = $userRoleRepo->findByUser($userId);

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('userRoles/list', [
            'user' => $user,
            'userRoles' => $userRoles,
        ]);
    }

    public function view(): void
    {
        $userRoleId = $_GET['id'] ?? null;

        $model = $this->app->getModel();
        $userRole = $model->getRepository('UserRole')->findById($userRoleId);

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('userRoles/view', [
            'userRole' => $userRole,
        ]);
    }

    public function addForm(): void
    {
        $userId = $_GET['userId'];
        $model = $this->app->getModel();
        $user = $model->getRepository('User')->findById($userId);
        $roles = $model->getRepository('Role')->findAll();
        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('userRoles/add', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function add(): void
    {
        $userId = $_GET['userId'];
        $model = $this->app->getModel();

        $user = $model->getRepository('User')->findById($userId);
        $role = $model->getRepository('Role')->findById($_POST['role_id']);

        $userRole = new UserRole(null, $user, $role);
        $model->getRepository('UserRole')->save($userRole);

        header('Location: /user-roles?userId=' . $userId);
    }

    public function editForm(): void
    {
        $userRoleId = $_GET['id'] ?? null;
        $model = $this->app->getModel();
        $userRole = $model->getRepository('UserRole')->findById($userRoleId);
        $roles = $model->getRepository('Role')->findAll();

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('userRoles/edit', [
            'userRole' => $userRole,
            'roles' => $roles,
        ]);
    }

    public function edit(): void
    {
        $userRoleId = $_GET['id'] ?? null;

        $model = $this->app->getModel();

        $role = $model->getRepository('Role')->findById($_POST['role_id']);

        $userRoleRepo = $model->getRepository('UserRole');
        /** @var UserRole $userRole */
        $userRole = $userRoleRepo->findById($userRoleId);
        $userRole->setRole($role);
        $userRoleRepo->save($userRole);

        header('Location: /user-roles?userId=' . $userRole->getUser()->getId());
    }

    public function delete(): void
    {
        $userRoleId = $_GET['id'] ?? null;

        $model = $this->app->getModel();
        $model->getRepository('UserRole')->delete($userRoleId);
    }
}
