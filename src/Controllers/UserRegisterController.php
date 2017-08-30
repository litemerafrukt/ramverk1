<?php

namespace litemerafrukt\Controllers;

use litemerafrukt\User\UserLevels;
use litemerafrukt\Gravatar\Gravatar;
use Anax\DI\InjectionAwareInterface;
use Anax\DI\InjectionAwareTrait;

/**
 * Controller for user stuff, login, logout, register etc.
 */
class UserRegisterController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    private $userHandler;

    public function __construct($userHandler)
    {
        $this->userHandler = $userHandler;
    }

    /**
     * Show register page
     */
    public function register()
    {
        $this->di->get('pageRender')->quick('user/register', "Registrera ny användare");
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

        $this->di->get('session')->set('user', $userOrMessage);
        $this->di->get('tlz')->redirect('user/login');
    }
}
