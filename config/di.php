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
            // "callback" => "\Anax\Response\Response",
            "callback" => function () {
                $obj = new \Anax\Response\ResponseUtility();
                $obj->setDI($this);
                return $obj;
            }

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
            "active" => true,
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
                $obj = new \litemerafrukt\Render\Render();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "olddb" => [
            "shared" => true,
            "callback" => function () {
                $db = new litemerafrukt\Database\Database();
                $db->configure('olddatabase.php');
                $db->connect();
                return $db;
            }
        ],
        "db" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Database\DatabaseQueryBuilder();
                $obj->configure("database.php");
                return $obj;
            }
        ],
        "user" => [
            "shared" => true,
            "callback" => function () {
                return $this->get('session')->get(
                    'user',
                    new \litemerafrukt\User\User(null, 'Gäst', '', litemerafrukt\User\UserLevels::GUEST)
                );
            }
        ],
        "loginButton" => [
            "shared" => true,
            "callback" => function () {
                $loginButton = new \litemerafrukt\LoginButton\LoginButton();
                $loginButton->setDI($this);
                return $loginButton;
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
            "shared" => true,
            "callback" => function () {
                $commentModel = new litemerafrukt\Comments\CommentModel();
                $commentModel->setDb($this->get('db'));
                $commentsSupplier = new litemerafrukt\Comments\Comments($commentModel);
                $textFormatter = function ($rawText) {
                    return $this->get('textfilter')->markdown(htmlspecialchars($rawText));
                };
                $commentsController = new litemerafrukt\Comments\CommentsController($commentsSupplier, $textFormatter);
                $commentsController->setDi($this);
                return $commentsController;
            }
        ],
        "userController" => [
            "shared" => true,
            "callback" => function () {
                $userHandler = new litemerafrukt\User\UserHandler($this->get('olddb'));
                $userController = new litemerafrukt\Controllers\UserController($userHandler);
                $userController->setDI($this);
                return $userController;
            }
        ],
        "userAccountController" => [
            "shared" => true,
            "callback" => function () {
                $userHandler = new litemerafrukt\User\UserHandler($this->get('olddb'));
                $userController = new litemerafrukt\Controllers\UserAccountController($userHandler);
                $userController->setDI($this);
                return $userController;
            }
        ],
        "userRegisterController" => [
            "shared" => true,
            "callback" => function () {
                $userHandler = new litemerafrukt\User\UserHandler($this->get('olddb'));
                $userController = new litemerafrukt\Controllers\UserRegisterController($userHandler);
                $userController->setDI($this);
                return $userController;
            }
        ],
        "adminController" => [
            "shared" => true,
            "callback" => function () {
                $userController = new litemerafrukt\Controllers\AdminController();
                $userController->setDI($this);
                return $userController;
            }
        ],
        "adminUsersController" => [
            "shared" => true,
            "callback" => function () {
                $userHandler = new litemerafrukt\User\UserHandler($this->get('olddb'));
                $usersHandler = new litemerafrukt\Admin\UsersHandler($this->get('olddb'));
                $userController = new litemerafrukt\Controllers\AdminUsersController($userHandler, $usersHandler);
                $userController->setDI($this);
                return $userController;
            }
        ],
        "bookController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \litemerafrukt\Book\BookController();
                $obj->setDI($this);
                return $obj;
            }
        ],
    ],
];
