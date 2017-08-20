<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "tlz" => [
            "shared" => true,
            "callback" => function () {
                $tlz = new litemerafrukt\Tools\Tools();
                $tlz->setDI($this);
                return $tlz;
            }
        ],
        "request" => [
            "shared" => true,
            "callback" => function () {
                $request = new \Anax\Request\Request();
                $request->init();
                return $request;
            }
        ],
        "response" => [
            "shared" => true,
            "callback" => "\Anax\Response\Response",
        ],
        "url" => [
            "shared" => true,
            "callback" => function () {
                $url = new \Anax\Url\Url();
                $request = $this->get("request");
                $url->setSiteUrl($request->getSiteUrl());
                $url->setBaseUrl($request->getBaseUrl());
                $url->setStaticSiteUrl($request->getSiteUrl());
                $url->setStaticBaseUrl($request->getBaseUrl());
                $url->setScriptName($request->getScriptName());
                $url->configure("url.php");
                $url->setDefaultsFromConfiguration();
                return $url;
            }
        ],
        "router" => [
            "shared" => true,
            "callback" => function () {
                $router = new \Anax\Route\Router();
                $router->setDI($this);
                $router->configure("route.php");
                return $router;
            }
        ],
        "view" => [
            "shared" => true,
            "callback" => function () {
                $view = new \Anax\View\ViewCollection();
                $view->setDI($this);
                $view->configure("view.php");
                return $view;
            }
        ],
        "viewRenderFile" => [
            "shared" => true,
            "callback" => function () {
                $viewRender = new \Anax\View\ViewRenderFile2();
                // $viewRender = new litemerafrukt\Render\Render();
                $viewRender->setDI($this);
                return $viewRender;
            }
        ],
        "session" => [
            "shared" => true,
            "callback" => function () {
                $session = new \Anax\Session\SessionConfigurable();
                $session->configure("session.php");
                $session->start();
                return $session;
            }
        ],
        "textfilter" => [
            "shared" => true,
            "callback" => "\Anax\TextFilter\TextFilter",
        ],
        "errorController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\ErrorController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "debugController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\DebugController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "flatFileContentController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\FlatFileContentController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "pageRender" => [
            "shared" => true,
            "callback" => function () {
                $obj = new litemerafrukt\Render\Render();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "navbar" => [
            "shared" => true,
            "callback" => function () {
                $navbar = new \litemerafrukt\Navbar\Navbar();
                $navbar->setDi($this);
                $navbar->configure("navbar.php");
                return $navbar;
            }
        ],
        "flash" => [
            "shared" => true,
            "callback" => function () {
                $flash = new \litemerafrukt\Flash\Flash();
                $flash->setDi($this);
                $flash->init();
                return $flash;
            }
        ],
        "remController" => [
            "shared" => true,
            "callback" => function () {
                $remStorage = new litemerafrukt\RemServer\RemStorage();
                $remStorage->configure("remserver.php");
                $remStorage->inject(['session' => $this->get("session")]);
                $rem = new \litemerafrukt\Controllers\RemServerController($remStorage);
                $rem->setDI($this);
                return $rem;
            }
        ],
        "commentsController" => [
            "shared" => false,
            "callback" => function () {
                $commentsStorage = new litemerafrukt\Comments\CommentSessionStorage($this->get('session'));
                $commentsSupplier = new litemerafrukt\Comments\Comments($commentsStorage);
                $textFormatter = function ($rawText) {
                    return $this->get('textfilter')->markdown(htmlspecialchars($rawText));
                };
                $commentsController = new litemerafrukt\Controllers\CommentsController($commentsSupplier, $textFormatter);
                $commentsController->setDi($this);
                return $commentsController;
            }
        ],
    ],
];
