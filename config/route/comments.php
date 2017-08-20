<?php
/**
 * Routes for commenting system.
 */

// $app->router->add("comments/**", [$app->commentsController, "prepare"]);
// $app->router->get("comments", [$app->commentsController, "index"]);
// $app->router->get("comments/empty", [$app->commentsController, "deleteAll"]);
// $app->router->post("comments/new", [$app->commentsController, "new"]);
// $app->router->get("comments/delete/{id:digit}", [$app->commentsController, "delete"]);
// $app->router->get("comments/edit/{id:digit}", [$app->commentsController, "edit"]);
// $app->router->post("comments/edit/{id:digit}", [$app->commentsController, "editHandler"]);

return [
    "routes" => [
        [
            "info" => "Prepare commenting system",
            "requestMethod" => null,
            "path" => "**",
            "callable" => ["commentsController", "prepare"]
        ],
        [
            "info" => "Commenting main page",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["commentsController", "index"]
        ],
        [
            "info" => "Delete all comments",
            "requestMethod" => "get",
            "path" => "empty",
            "callable" => ["commentsController", "deleteAll"]
        ],
        [
            "info" => "Create new comment",
            "requestMethod" => "post",
            "path" => "new",
            "callable" => ["commentsController", "new"]
        ],
        [
            "info" => "Delete a comment by id",
            "requestMethod" => "get",
            "path" => "delete/{id:digit}",
            "callable" => ["commentsController", "delete"]
        ],
        [
            "info" => "Show edit page for a comment",
            "requestMethod" => "get",
            "path" => "edit/{id:digit}",
            "callable" => ["commentsController", "edit"]
        ],
        [
            "info" => "Handle edited comment post request",
            "requestMethod" => "post",
            "path" => "edit/{id:digit}",
            "callable" => ["commentsController", "editHandle"]
        ],
    ]
];
