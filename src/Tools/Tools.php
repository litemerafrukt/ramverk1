<?php

namespace litemerafrukt\Tools;

use Anax\DI\InjectionAwareInterface;
use Anax\DI\InjectionAwareTrait;

/**
 * Collection of helpfull tools.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class Tools implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    public function redirect($url)
    {
        $this->di->get("response")->redirect(
            $this->di->get("url")->create($url)
        );
        exit;
    }

    /**
     * Go back to previous route
     */
    public function redirectBack()
    {
        $httpReferer =  $this->referer();
        $previousRoute = \explode("?", $httpReferer)[0];

        $this->redirect($previousRoute);
    }

    /**
     * Get referer or start page if not exists
     *
     * @return string
     */
    public function referer()
    {
        return $this->di->get("request")->getServer('HTTP_REFERER', $this->di->get('url')->create(""));
    }
}
