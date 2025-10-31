<?php

namespace Mariia\Iab\Controller;

class HomepageController extends Controller
{
    public static array $routes = [
        ['path' => '', 'method' => 'GET', 'action' => 'index'],
    ];

    public function index(): void
    {
        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('home');
    }
}