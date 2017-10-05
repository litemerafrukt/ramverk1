<?php

namespace litemerafrukt\Controllers;

use litemerafrukt\User\UserLevels;
use Anax\DI\InjectionAwareInterface;
use Anax\DI\InjectionAwareTrait;

/**
 * Controller for admin stuff
 */
class AdminUsersController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    private $userHandler;
    private $usersHandler;

    public function __construct($userHandler, $usersHandler)
    {
        $this->userHandler = $userHandler;
        $this->usersHandler = $usersHandler;
    }

    /**
     * Show users admin page
     */
    public function users()
    {
        $userLevels = new UserLevels();
        $users = $this->usersHandler
            ->all()
            ->map(function ($user) use ($userLevels) {
                $user['userlevel'] = $userLevels->levelToString($user['userlevel']);
                return $user;
            })
            ->toArray();
        $this->di->get('pageRender')->quick('admin/users', "Administrera användare", \compact('users'));
    }

    /**
     * Show register page
     */
    public function register()
    {
        $this->di->get('pageRender')->quick('admin/user/register', "Registrera ny användare");
    }

    /**
     * Register and login new user
     */
    public function handleRegister()
    {
        $name = \trim($this->di->get('request')->getPost('username', ''));
        $email = \trim($this->di->get('request')->getPost('email', ''));

        if ($name === '' || $email === '') {
            $this->di->get('flash')->setFlash('Både användernamn och e-postadress måste anges.', 'flash-info');
            $this->di->get('tlz')->redirectBack();
        }

        $password1 = \trim($this->di->get('request')->getPost('password1', ''));
        $password2 = \trim($this->di->get('request')->getPost('password2', ''));

        if ($password1 === '' || $password2 === '') {
            $this->di->get('flash')->setFlash('Lösenord får inte vara tomt.', 'flash-info');
            $this->di->get('tlz')->redirectBack();
        }

        if ($password1 !== $password2) {
            $this->di->get('flash')->setFlash('Lösenorden stämmer inte med varandra.', 'flash-warning');
            $this->di->get('tlz')->redirectBack();
        }

        list($ok, $userOrMessage) = $this->userHandler->register($name, $password1, $email);

        if (! $ok) {
            $this->di->get('flash')->setFlash($userOrMessage, 'flash-danger');
            $this->di->get('tlz')->redirectBack();
        }
        $this->di->get('flash')->setFlash("Användare $name lades till", 'flash-success');
        $this->di->get('tlz')->redirect('admin/users');
    }

    /**
     * Show admin user edit profile
     *
     * @param int $id
     */
    public function edit($id)
    {
        $user = $this->usersHandler->fetchUser($id);
        if (! $user) {
            $this->di->get('flash')->setFlash("Hittar inte användare med id: $id", 'flash-danger');
            $this->di->get('tlz')->redirectBack();
        }
        $this->di->get('pageRender')->quick('admin/user/editprofile', "Uppdatera {$user['username']}", \compact('user'));
    }

    /**
     * Handle edit user profile
     *
     * @param int $id
     */
    public function handleEdit($id)
    {
        $user = $this->usersHandler->fetchUser($id);
        if (! $user) {
            $this->di->get('flash')->setFlash("Hittar inte användare med id: $id", 'flash-danger');
            $this->di->get('tlz')->redirectBack();
        }

        $name = \trim($this->di->get('request')->getPost('username', ''));
        $email = \trim($this->di->get('request')->getPost('email', ''));

        if ($name === '' || $email === '') {
            $this->di->get('flash')->setFlash('Både användernamn och e-postadress måste anges.', 'flash-info');
            $this->di->get('tlz')->redirectBack();
        }

        list($ok, $message) = $this->userHandler->update($user['id'], $name, $email);

        if (! $ok) {
            $this->di->get('flash')->setFlash($message, "flash-danger");
            $this->di->get('tlz')->redirectBack();
        }
        $this->di->get('flash')->setFlash($message, "flash-success");
        $this->di->get('tlz')->redirect("admin/users");
    }

    /**
     * Delete user with id
     *
     * @param int $id
     */
    public function delete($id)
    {
        list($ok, $message) = $this->usersHandler->deleteUser($id);

        if (! $ok) {
            $this->di->get('flash')->setFlash($message, "flash-danger");
            $this->di->get('tlz')->redirectBack();
        }
        $this->di->get('flash')->setFlash($message, "flash-success");
        $this->di->get('tlz')->redirectBack();
    }

    /**
     * Delete user with id
     *
     * @param int $id
     */
    public function activate($id)
    {
        list($ok, $message) = $this->usersHandler->activateUser($id);

        if (! $ok) {
            $this->di->get('flash')->setFlash($message, "flash-danger");
            $this->di->get('tlz')->redirectBack();
        }
        $this->di->get('flash')->setFlash($message, "flash-success");
        $this->di->get('tlz')->redirectBack();
    }

    /**
     * Make user with id admin
     *
     * @param int $id
     */
    public function makeAdmin($id)
    {
        list($ok, $message) = $this->usersHandler->makeAdmin($id);

        if (! $ok) {
            $this->di->get('flash')->setFlash($message, "flash-danger");
            $this->di->get('tlz')->redirectBack();
        }
        $this->di->get('flash')->setFlash($message, "flash-success");
        $this->di->get('tlz')->redirectBack();
    }
}
