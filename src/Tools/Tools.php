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
        $httpReferer =  $this->di->get("request")->getServer('HTTP_REFERER', $this->di->get('url')->create(""));
        $previousRoute = \explode("?", $httpReferer)[0];

        $this->redirect($previousRoute);
    }

    /**
     * Render a standard web page using a specific layout.
     */
//     public function renderPage($data = [], $status = 200)
//     {
// //        $data["stylesheets"] = ["css/style.css"];

//         $flash = $this->di->get("flash");
//         $view = $this->di->get("view");

//         if ($flash->hasMessage()) {
//             $view->add("layout/flash", [
//                 "message" => \htmlspecialchars($flash->message()),
//                 "class" => $flash->class()
//             ], "flash");
//         }
//         // Add common header, navbar and footer
//         //$this->view->add("default1/header", [], "header");
//         $view->add("navbar/navbar", [], "navbar");
//         $view->add("footer/footer", [], "footer");

//         // Add layout, render it, add to response and send.
//         $view->add("layout/layout", $data, "layout");
//         $body = $view->renderBuffered("layout");

//         $this->di->get("response")->setBody($body)->send($status);
//         exit;
//     }
}
