<?php

namespace Mariia\Iab\Service;

use Mariia\Iab\Model\Entity\User;
use Mariia\Iab\Model\Repository\UserRepository;

class UserService extends Service
{
    public function saveUserIdentifier(string $userIdentifier)
    {
        $_SESSION['user_identifier'] = $userIdentifier;
    }

    public function getCurrentUser(): ?User
    {
        if (!isset($_SESSION['user_identifier']) || !$_SESSION['user_identifier']) {
            return null;
        }
        $model = $this->app->getModel();
        /** @var UserRepository $userRepo */
        $userRepo = $model->getRepository('User');
        $user = $userRepo->findByLogin($_SESSION['user_identifier']);

        return $user;
    }

    public function clearCurrentUser()
    {
        unset($_SESSION['user_identifier']);
        $this->app->currentUser = null;
    }
}
