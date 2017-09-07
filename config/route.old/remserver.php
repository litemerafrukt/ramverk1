<?php
/**
 * Routes for the REM Server.
 */
 /** Start the session and initiate the REM Server. */
$app->router->add("remserver/api/**", [$app->remController, "prepare"]);

/** Init or re-init the REM Server. */
$app->router->get("remserver/api/init", [$app->remController, "init"]);

/** Destroy the session. */
$app->router->get("remserver/api/destroy", [$app->remController, "destroy"]);

/** Get the dataset or parts of it. */
$app->router->get("remserver/api/{dataset:alphanum}", [$app->remController, "getDataset"]);

/** Get one item from the dataset. */
$app->router->get("remserver/api/{dataset:alphanum}/{id:digit}", [$app->remController, "getItem"]);

/** Create a new item and add to the dataset */
$app->router->post("remserver/api/{dataset:alphanum}", [$app->remController, "postItem"]);

/** Upsert/replace an item in the dataset. */
$app->router->put("remserver/api/{dataset:alphanum}/{id:digit}", [$app->remController, "putItem"]);

/** Delete an item from the dataset */
$app->router->delete("remserver/api/{dataset:alphanum}/{id:digit}", [$app->remController, "deleteItem"]);

/** Show a message that the route is unsupported, a local 404. */
$app->router->add("remserver/api/**", [$app->remController, "anyUnsupported"]);
