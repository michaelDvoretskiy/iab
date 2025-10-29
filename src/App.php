<?php

namespace Mariia\Iab;

use Mariia\Iab\Model\Model;

class App
{
    private Model $model;
    private UIMaker $uiMaker;

    private array $routes = [
        [
            'path' => 'roles',
            'method' => 'GET',
            'controller' => 'RoleController',
            'action' => 'listRoles',
        ],
        [
            'path' => 'roles/view-one',
            'method' => 'GET',
            'controller' => 'RoleController',
            'action' => 'viewRole',
        ],
        [
            'path' => 'roles/add',
            'method' => 'GET',
            'controller' => 'RoleController',
            'action' => 'addRoleForm',
        ],
        [
            'path' => 'roles/add',
            'method' => 'POST',
            'controller' => 'RoleController',
            'action' => 'addRole',
        ],
        [
            'path' => 'roles/edit',
            'method' => 'GET',
            'controller' => 'RoleController',
            'action' => 'editRoleForm',
        ],
        [
            'path' => 'roles/edit',
            'method' => 'POST',
            'controller' => 'RoleController',
            'action' => 'editRole',
        ],
        [
            'path' => 'roles/delete',
            'method' => 'POST',
            'controller' => 'RoleController',
            'action' => 'deleteRole',
        ],
        [
            'path' => 'users',
            'method' => 'GET',
            'controller' => 'UserController',
            'action' => 'list',
        ],
        [
            'path' => 'users/view',
            'method' => 'GET',
            'controller' => 'UserController',
            'action' => 'view',
        ],
        [
            'path' => 'users/add',
            'method' => 'GET',
            'controller' => 'UserController',
            'action' => 'addForm',
        ],
        [
            'path' => 'users/add',
            'method' => 'POST',
            'controller' => 'UserController',
            'action' => 'add',
        ],
        [
            'path' => 'users/edit',
            'method' => 'GET',
            'controller' => 'UserController',
            'action' => 'editForm',
        ],
        [
            'path' => 'users/edit',
            'method' => 'POST',
            'controller' => 'UserController',
            'action' => 'edit',
        ],
        [
            'path' => 'users/delete',
            'method' => 'POST',
            'controller' => 'UserController',
            'action' => 'delete',
        ],
    ];

    public function __construct()
    {
        $this->model = new Model();
        $this->uiMaker = new UIMaker();
    }

    public function run(): void
    {
        $url = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($url, PHP_URL_PATH);
        $path = trim($path, '/');
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        foreach ($this->routes as $route) {
            if ($route['path'] === $path && $route['method'] === $method) {
                $controllerName = $route['controller'];
                $actionName = $route['action'];
                $controllerClass = "Mariia\\Iab\\Controller\\$controllerName";
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
}