<?php

namespace Anax\App;

/**
 * An App class to wrap the resources of the framework.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class App
{
    public function redirect($url)
    {
        $this->response->redirect($this->url->create($url));
        exit;
    }


    /**
     * Go back to previous route
     */
    public function redirectBack()
    {
        $previousRoute = \explode(
            "?",
            $this->request->getServer('HTTP_REFERER', $this->url->create(""))
        )[0];

        $this->redirect($previousRoute);
    }

    /**
     * Render a standard web page using a specific layout.
     */
    public function renderPage($data = [], $status = 200)
    {
//        $data["stylesheets"] = ["css/style.css"];

        if ($this->flash->hasMessage()) {
            $this->view->add("layout/flash", [
                "message" => \htmlspecialchars($this->flash->message()),
                "class" => $this->flash->class()
            ], "flash");
        }
        // Add common header, navbar and footer
        //$this->view->add("default1/header", [], "header");
        $this->view->add("navbar/navbar", [], "navbar");
        $this->view->add("footer/footer", [], "footer");

        // Add layout, render it, add to response and send.
        $this->view->add("layout/layout", $data, "layout");
        $body = $this->view->renderBuffered("layout");
        $this->response->setBody($body)
                       ->send($status);
        exit;
    }
}
