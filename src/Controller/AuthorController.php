<?php

namespace Mariia\Iab\Controller;

use Mariia\Iab\Model\Entity\Author;

class AuthorController extends Controller
{
    public static array $routes = [
        ['path' => 'authors', 'method' => 'GET', 'action' => 'list', 'security' => 'canEdit'],
        ['path' => 'authors/view', 'method' => 'GET', 'action' => 'view', 'security' => 'canEdit'],
        ['path' => 'authors/add', 'method' => 'GET', 'action' => 'addForm', 'security' => 'canEdit'],
        ['path' => 'authors/add', 'method' => 'POST', 'action' => 'add', 'security' => 'canEdit'],
        ['path' => 'authors/edit', 'method' => 'GET', 'action' => 'editForm', 'security' => 'canEdit'],
        ['path' => 'authors/edit', 'method' => 'POST', 'action' => 'edit', 'security' => 'canEdit'],
        ['path' => 'authors/delete', 'method' => 'POST', 'action' => 'delete', 'security' => 'canEdit'],
    ];

    public function list(): void
    {
        $model = $this->app->getModel();
        $authors = $model->getRepository('Author')->findAll();

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('authors/list', ['authors' => $authors]);
    }

    public function view(): void
    {
        $authorId = $_GET['id'] ?? null;

        $model = $this->app->getModel();
        $author = $model->getRepository('Author')->findById($authorId);

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('authors/view', ['author' => $author]);
    }

    public function addForm(): void
    {
        $model = $this->app->getModel();
        $users = $model->getRepository('User')->findAll();
        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('authors/add', ['users' => $users]);
    }

    public function add(): void
    {
        $model = $this->app->getModel();

        $user = null;
        if ($_POST['user_id']) {
            $user = $model->getRepository('User')->findById($_POST['user_id']);
        }

        $author = new Author(null, $_POST['author_name'] ?? '', $user, 0);
        $model->getRepository('Author')->save($author);

        header('Location: /authors');
    }

    public function editForm(): void
    {
        $authorId = $_GET['id'] ?? null;
        $model = $this->app->getModel();
        $author = $model->getRepository('Author')->findById($authorId);
        $users = $model->getRepository('User')->findAll();

        $uiMaker = $this->app->getUIMaker();
        $uiMaker->render('authors/edit', [
            'author' => $author,
            'users' => $users,
        ]);
    }

    public function edit(): void
    {
        $authorId = $_GET['id'] ?? null;

        $model = $this->app->getModel();

        $user = null;
        if ($_POST['user_id']) {
            $user = $model->getRepository('User')->findById($_POST['user_id']);
        }

        $authorRepo = $model->getRepository('Author');
        /** @var Author $author */
        $author = $authorRepo->findById($authorId);
        $author->setName($_POST['author_name'] ?? '');
        $author->setUser($user);
        $authorRepo->save($author);

        header('Location: /authors');
    }

    public function delete(): void
    {
        $authorId = $_GET['id'] ?? null;

        $model = $this->app->getModel();
        $model->getRepository('Author')->delete($authorId);
    }
}
