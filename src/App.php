<?php

namespace Mariia\Iab;

use Mariia\Iab\Controller\AuthorController;
use Mariia\Iab\Controller\HomepageController;
use Mariia\Iab\Controller\RoleController;
use Mariia\Iab\Controller\UserController;
use Mariia\Iab\Controller\UserRoleController;
use Mariia\Iab\Model\Entity\User;
use Mariia\Iab\Model\Model;
use Mariia\Iab\Service\UserService;

class App
{
    private Model $model;
    private UIMaker $uiMaker;
    private array $routes = [];
    private array $controllers = [
        RoleController::class,
        UserController::class,
        AuthorController::class,
        HomepageController::class,
        UserRoleController::class,
    ];

    public UserService $userService;
    public ?User $currentUser;

    public function __construct()
    {
        session_start();
        $this->attachControllerRoutes();
        $this->model = new Model();
        $this->userService = new UserService($this);
        $this->currentUser = $this->userService->getCurrentUser();
        $this->uiMaker = new UIMaker($this->currentUser);
    }

    public function run(): void
    {
        $url = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($url, PHP_URL_PATH);
        $path = trim($path, '/');
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        foreach ($this->routes as $route) {
            if ($route['path'] === $path && $route['method'] === $method) {
                $actionName = $route['action'];
                $controllerClass = $route['controller'];
                $controller = new $controllerClass($this);
                $controller->$actionName();

                return;
            }
        }
        http_response_code(404);
        echo '404 Not Found';
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function getUIMaker(): UIMaker
    {
        return $this->uiMaker;
    }

    private function attachControllerRoutes(): void
    {
        foreach ($this->controllers as $controller) {
            foreach ($controller::$routes as $route) {
                $route['controller'] = $controller;
                $this->routes[] = $route;
            }
        }
    }
}
