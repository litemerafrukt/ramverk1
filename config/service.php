<?php
/**
 * Add and configure services and return the $app object.
 */

// Add all resources to $app
// $app = new \Anax\App\App();
// $app->request    = new \Anax\Request\Request();
// $app->response   = new \Anax\Response\Response();
// $app->url        = new \Anax\Url\Url();
// $app->router     = new \Anax\Route\RouterInjectable();
// $app->view       = new \Anax\View\ViewContainer();
// $app->textfilter = new \Anax\TextFilter\TextFilter();
// $app->session    = new \Anax\Session\SessionConfigurable();

// Configure request
// $app->request->init();

// Configure router
// $app->router->setApp($app);

// Configure session
// $app->session->configure("session.php");
// $app->session->start();

// Configure url
// $app->url->setSiteUrl($app->request->getSiteUrl());
// $app->url->setBaseUrl($app->request->getBaseUrl());
// $app->url->setStaticSiteUrl($app->request->getSiteUrl());
// $app->url->setStaticBaseUrl($app->request->getBaseUrl());
// $app->url->setScriptName($app->request->getScriptName());
// $app->url->configure("url.php");
// $app->url->setDefaultsFromConfiguration();

// Configure view
// $app->view->setApp($app);
// $app->view->configure("view.php");

/**
 * Additional app specific services
 */
// $app->navbar = new litemerafrukt\Navbar\Navbar();
// $app->navbar->setApp($app);
// $app->navbar->configure("navbar.php");

// Flash
// $app->flash = new \litemerafrukt\Flash\Flash($app->session);

// // Remserver
// $rem = new \litemerafrukt\RemServer\RemStorage();
// $rem->configure("remserver.php");
// $rem->inject(["session" => $app->session]);
// $app->remController = new \litemerafrukt\Controllers\RemServerController($rem);

// // Init REM Server
// $app->remController->setApp($app);

// Comments
// $app->commentsController = new litemerafrukt\Controllers\CommentsController(
//     new litemerafrukt\Comments\Comments(new litemerafrukt\Comments\CommentSessionStorage($app->session)),
//     function ($rawText) use ($app) {
//         return $app->textfilter->markdown(htmlspecialchars($rawText));
//     }
// );

// $app->commentsController->setApp($app);

// // Return the populated $app
// return $app;
