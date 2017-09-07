<?php

namespace litemerafrukt\Navbar;

use Anax\DI\InjectionAwareInterface;
use Anax\DI\InjectionAwareTrait;
use Anax\Common\ConfigureInterface;
use Anax\Common\ConfigureTrait;

class Navbar implements InjectionAwareInterface, ConfigureInterface
{
    use InjectionAwareTrait;
    use ConfigureTrait;

    /**
     * Routes
     *
     * @return array
     */
    public function navroutes()
    {
        return array_map(function ($route) {
            return [
                'route' => $this->di->get("url")->create($route['route']),
                'label' => $route['label'],
            ];
        }, $this->config['routes']);
    }

    /**
     * Navbar brand if set
     *
     * @return string
     */
    public function navbarBrand()
    {
        $navbarBrand = $this->config['navbarBrand'] ?? ['label' => '', 'route' => ''];

        return [
            'label' => $navbarBrand['label'],
            'route' => $this->di->get("url")->create($navbarBrand['route']),
        ];
    }

    /**
     * Get routes as json object
     *
     * @return string
     */
    public function asJson()
    {
        return json_encode($this->navroutes());
    }
}
