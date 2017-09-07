<?php

namespace litemerafrukt\Controllers;

use litemerafrukt\User\UserLevels;
use litemerafrukt\Gravatar\Gravatar;
use Anax\DI\InjectionAwareInterface;
use Anax\DI\InjectionAwareTrait;

/**
 * Controller for user stuff, login, logout and guard.
 */
class UserController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    private $userHandler;

    public function __construct($userHandler)
    {
        $this->userHandler = $userHandler;
    }

    /**
     * Show login
     */
    public function login()
    {
        $user = $this->di->get('session')->get('user');
        if ($user) {
            $this->di->get('tlz')->redirect("user/account/profile");
        }
        $this->di->get('pageRender')->quick('user/login', 'Logga in');
    }

    /**
     * Logout user by deleting user in session.
     */
    public function logout()
    {
        $this->di->get('session')->delete('user');
        $this->di->get('tlz')->redirect('user/login');
    }

    /**
     * Handle login attempt
     */
    public function loginAttempt()
    {
        $username = \trim($this->di->get('request')->getPost('username', ''));
        $password = \trim($this->di->get('request')->getPost('password', ''));

        if ($username === '' || $password === '') {
            $this->di->get('flash')->setFlash('Fel i användarnamn eller lösenord', 'flash-info');
            $this->di->get('tlz')->redirect('user/login');
        }

        list($ok, $userOrMessage) = $this->userHandler->login($username, $password);

        if (! $ok) {
            $this->di->get('session')->delete('user');
            $this->di->get('flash')->setFlash($userOrMessage, "flash-info");
            $this->di->get('tlz')->redirectBack();
        }
        $this->di->get('session')->set('user', $userOrMessage);
        $this->di->get('flash')->setFlash("Inloggad som $username", "flash-success");
        $this->di->get('tlz')->redirectBack();
    }

    /**
     * Guard
     *
     * Only users is allowed, otherwise redirect.
     */
    public function guard()
    {
        if ($this->di->get('user')->isLevel(UserLevels::USER)) {
            return;
        }

        $this->di->get('flash')->setFlash("Endast tillgänglig för inloggade användare", "flash-danger");
        $this->di->get('tlz')->redirect("");
    }
}
