<?php
/**
 * Routes.
 */
return [
    // Load these routefiles in order specified and optionally mount them
    // onto a base route.
    "routeFiles" => [
        [
            // These are for internal error handling and exceptions
            "mount" => null,
            "file" => __DIR__ . "/route/internal.php",
        ],
        [
            // For debugging and development details on Anax
            "mount" => "debug",
            "file" => __DIR__ . "/route/debug.php",
        ],
        [
            // Routers for commenting system
            "mount" => "comments",
            "file" => __DIR__ . "/route/comments.php",
        ],
        [
            // Routers for the REM server mounts on remserver/api/
            "mount" => "remserver/api",
            "file" => __DIR__ . "/route/remserver.php",
        ],
        [
            // Routes for user account managing
            "mount" => "user",
            "file" => __DIR__ . "/route/user.php",
        ],
        [
            // Routes for admin
            "mount" => "admin",
            "file" => __DIR__ . "/route/admin.php",
        ],
        [
            // To read flat file content in Markdown from content/
            "mount" => null,
            "file" => __DIR__ . "/route/flat-file-content.php",
        ],
        [
            // Add routes from bookController and mount on book/
            "mount" => "book",
            "file" => __DIR__ . "/route/book.php",
        ],
        [
            // Keep this last since its a catch all
            "mount" => null,
            "file" => __DIR__ . "/route/404.php",
        ],
    ],
];
