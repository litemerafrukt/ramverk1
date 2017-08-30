<?php
/**
 * Routes for commenting system.
 */

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
            "callable" => ["commentsController", "editHandler"]
        ],
    ]
];
