<?php

namespace litemerafrukt\LoginButton;

use Anax\DI\InjectionAwareInterface;
use Anax\DI\InjectionAwareTrait;
use litemerafrukt\User\UserLevels;
use litemerafrukt\Gravatar\Gravatar;

class LoginButton implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    /**
     * Get login button icon
     *
     * @return string - html
     */
    public function icon()
    {
        $user = $this->di->get('user');
        if ($user->isLevel(UserLevels::USER)) {
            $imageUrl = (new Gravatar($user->email(), 30))->url();
            return "<img style=\"vertical-align: middle; border-radius: 50%;\" src=\"$imageUrl\">";
        }
        return "<i class=\"fa fa-sign-in\"></i>";
    }
}
