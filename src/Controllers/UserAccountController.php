<?php

namespace litemerafrukt\Controllers;

use Anax\DI\InjectionAwareInterface;
use Anax\DI\InjectionAwareTrait;
use litemerafrukt\Gravatar\Gravatar;
use litemerafrukt\User\UserLevels;

/**
 * Controller for user account stuff, change profile, change password etc.
 */
class UserAccountController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    private $userHandler;

    public function __construct($userHandler)
    {
        $this->userHandler = $userHandler;
    }

    /**
     * Show user profile and logout option
     */
    public function profile()
    {
        $user = $this->di->get('user');
        $user->gravatar = new Gravatar($user->email());
        $user->isAdmin = $user->isLevel(UserLevels::ADMIN);
        $this->di->get('pageRender')->quick('user/profile', "Användare {$user->name()}", \compact('user'));
    }

    /**
     * Show user edit profile
     */
    public function editProfile()
    {
        $user = $this->di->get('user');
        $this->di->get('pageRender')->quick('user/editprofile', "Uppdatera {$user->name()}", \compact('user'));
    }

    /**
     * Show change password
     */
    public function changePassword()
    {
        $this->di->get('pageRender')->quick('user/changepassword', "Ändra lösenord");
    }

    /**
     * Handle edit user profile
     */
    public function handleEditProfile()
    {
        $name = \trim($this->di->get('request')->getPost('username', ''));
        $email = \trim($this->di->get('request')->getPost('email', ''));

        if ($name === '' || $email === '') {
            $this->di->get('flash')->setFlash('Både användernamn och e-postadress måste anges.', 'flash-info');
            $this->di->get('tlz')->redirectBack();
        }

        $user = $this->di->get('user');

        list($ok, $message) = $this->userHandler->update($user->id(), $name, $email);

        $this->di->get('session')->set('user', $user->newFromThis(\compact('name', 'email')));

        if (! $ok) {
            $this->di->get('flash')->setFlash($message, "flash-danger");
            $this->di->get('tlz')->redirectBack();
        }
        $this->di->get('flash')->setFlash($message, "flash-success");
        $this->di->get('tlz')->redirect("user/account/profile");
    }

    /**
     * Handle password change
     */
    public function handleChangePassword()
    {
        $password1 = \trim($this->di->get('request')->getPost('password1', ''));
        $password2 = \trim($this->di->get('request')->getPost('password2', ''));

        if ($password1 === '' || $password2 === '') {
            $this->di->get('flash')->setFlash('Lösenord får inte vara tomt.', 'flash-info');
            $this->di->get('tlz')->redirectBack();
        }

        if ($password1 !== $password2) {
            $this->di->get('flash')->setFlash('Lösenorden stämmer inte med varandra.', 'flash-info');
            $this->di->get('tlz')->redirectBack();
        }

        $user = $this->di->get('user');

        list($ok, $message) = $this->userHandler->changePassword($user->id(), $password1);

        if (! $ok) {
            $this->di->get('flash')->setFlash($message, "flash-danger");
            $this->di->get('tlz')->redirectBack();
        }
        $this->di->get('flash')->setFlash($message, "flash-success");
        $this->di->get('tlz')->redirect("user/account/profile");
    }
}
