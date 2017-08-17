<?php
/**
 * Routes for commenting system.
 */

$app->router->add("comments/**", [$app->commentsController, "prepare"]);
$app->router->get("comments", [$app->commentsController, "index"]);
$app->router->get("comments/empty", [$app->commentsController, "deleteAll"]);
$app->router->post("comments/new", [$app->commentsController, "new"]);
$app->router->get("comments/delete/{id:digit}", [$app->commentsController, "delete"]);
$app->router->get("comments/edit/{id:digit}", [$app->commentsController, "edit"]);
$app->router->post("comments/edit/{id:digit}", [$app->commentsController, "editHandler"]);
