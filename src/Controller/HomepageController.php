<?php

namespace Mariia\Iab\Controller;

use Mariia\Iab\Model\Repository\UserRepository;

class HomepageController extends Controller
{
    public static array $routes = [
        ['path' => '', 'method' => 'GET', 'action' => 'index'],
        ['path' => 'login', 'method' => 'GET', 'action' => 'showLogin'],
        ['path' => 'login', 'method' => 'POST', 'action' => 'login'],
    ];

    public function index(): void
    {
        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('home');
    }

    public function showLogin()
    {
        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('login', ['showMenu' => false, 'showHead' => false]);
    }

    public function login()
    {
        $login = $_POST['username'];
        $password = $_POST['password'];
        $model = $this->app->getModel();
        $uiMaker = $this->app->getUIMaker();
        /** @var UserRepository $userRepo */
        $userRepo = $model->getRepository('User');
        $user = $userRepo->findByLogin($login);
        if (!$user || !$user->checkPassword($password)) {
            $uiMaker->render('error', [
                'errorText' => 'Login data is incorrect',
                'showMenu' => false,
                'showHead' => false,
            ]);

            return;
        }
        header('Location: /');
    }
}