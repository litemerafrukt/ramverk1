<?php

namespace litemerafrukt\Controllers;

use litemerafrukt\User\UserLevels;
use litemerafrukt\Forms\User\Register\RegisterForm;
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
        if ($this->di->get('session')->get('user')) {
            $this->di->get('tlz')->redirect("user/account/profile");
        }

        $form = new RegisterForm($this->di, $this->userHandler);

        $form->check();

        $formHTML = $form->getHTML(['use_fieldset' => false]);

        $this->di->get('pageRender')->quick('user/register', "Registrera ny användare", ['form' => $formHTML]);
    }
}
