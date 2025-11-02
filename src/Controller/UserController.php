<?php

namespace Mariia\Iab\Controller;

use Mariia\Iab\Model\Entity\User;

class UserController extends Controller
{
    public static array $routes = [
        ['path' => 'users', 'method' => 'GET', 'action' => 'list', 'security' => 'isAdmin'],
        ['path' => 'users/view', 'method' => 'GET', 'action' => 'view', 'security' => 'isAdmin'],
        ['path' => 'users/add', 'method' => 'GET', 'action' => 'addForm', 'security' => 'isAdmin'],
        ['path' => 'users/add', 'method' => 'POST', 'action' => 'add', 'security' => 'isAdmin'],
        ['path' => 'users/edit', 'method' => 'GET', 'action' => 'editForm', 'security' => 'isAdmin'],
        ['path' => 'users/edit', 'method' => 'POST', 'action' => 'edit', 'security' => 'isAdmin'],
        ['path' => 'users/delete', 'method' => 'POST', 'action' => 'delete', 'security' => 'isAdmin'],
    ];

    public function list(): void
    {
        $model = $this->app->getModel();
        $users = $model->getRepository('User')->findAll();

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('users/list', ['users' => $users]);
    }

    public function view(): void
    {
        $userId = $_GET['id'] ?? null;

        $model = $this->app->getModel();
        $user = $model->getRepository('User')->findById($userId);

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('users/view', ['user' => $user]);
    }

    public function addForm(): void
    {
        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('users/add');
    }

    public function add(): void
    {
        $user = new User(
            null,
            $_POST['user_login'] ?? '',
            $_POST['user_email'] ?? '',
            $_POST['user_password'] ?? ''
        );

        $model = $this->app->getModel();
        $model->getRepository('User')->save($user);

        header('Location: /users');
    }

    public function editForm(): void
    {
        $userId = $_GET['id'] ?? null;
        $model = $this->app->getModel();
        $user = $model->getRepository('User')->findById($userId);

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('users/edit', ['user' => $user]);
    }

    public function edit(): void
    {
        $userId = $_GET['id'] ?? null;

        $model = $this->app->getModel();
        $userRepo = $model->getRepository('User');
        /** @var User $user */
        $user = $userRepo->findById($userId);
        $user->setLogin($_POST['user_login'] ?? '');
        $user->setEmail($_POST['user_email'] ?? '');
        if (!empty($_POST['user_password'])) {
            if ($user->checkPassword($_POST['old_password'])) {
                $user->setPlainPassword($_POST['user_password']);
            } else {
                $uiMaker = $this->app->getUIMaker();
                $uiMaker->render('error', ['errorText' => 'Old password is incorrect']);

                return;
            }
        }
        $userRepo->save($user);

        header('Location: /users');
    }

    public function delete(): void
    {
        $userId = $_GET['id'] ?? null;

        $model = $this->app->getModel();
        $model->getRepository('User')->delete($userId);
    }
}
