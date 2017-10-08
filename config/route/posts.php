<?php
/**
 * Routes for commenting system.
 */

return [
    "routes" => [
        [
            "info" => "Post main page",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["postController", "index"]
        ],
        [
            "info" => "Show a post",
            "requestMethod" => "get|post",
            "path" => "show/{id:digit}",
            "callable" => ["postController", "showPost"]
        ],
        [
            "info" => "Create new post",
            "requestMethod" => "post",
            "path" => "new",
            "callable" => ["postController", "new"]
        ],
        [
            "info" => "Delete a post by id",
            "requestMethod" => "get",
            "path" => "delete/{id:digit}",
            "callable" => ["postController", "delete"]
        ],
        [
            "info" => "Show edit page for a post",
            "requestMethod" => "get",
            "path" => "edit/{id:digit}",
            "callable" => ["postController", "edit"]
        ],
        [
            "info" => "Handle edited post request",
            "requestMethod" => "post",
            "path" => "edit/{id:digit}",
            "callable" => ["postController", "editHandler"]
        ],
    ],
];
