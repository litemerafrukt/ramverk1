<?php
// Routes for user account managing

return [
    "routes" => [
        [
            "info" => "User registration",
            "requestMethod" => "get",
            "path" => "register",
            "callable" => ["userRegisterController", "register"]
        ],
        [
            "info" => "User registration",
            "requestMethod" => "post",
            "path" => "register",
            "callable" => ["userRegisterController", "handleRegister"]
        ],
        [
            "info" => "user login",
            "requestMethod" => "get",
            "path" => "login",
            "callable" => ["userController", "login"]
        ],
        [
            "info" => "user login attempt",
            "requestMethod" => "post",
            "path" => "login",
            "callable" => ["userController", "loginAttempt"]
        ],
        [
            "info" => "user logout",
            "requestMethod" => "get",
            "path" => "logout",
            "callable" => ["userController", "logout"]
        ],
        [
            "info" => "Lock the account path",
            "requestMethod" => null,
            "path" => "account/**",
            "callable" => ["userController", "guard"],
        ],
        [
            "info" => "User profile",
            "requestMethod" => "get",
            "path" => "account/profile",
            "callable" => ["userAccountController", "profile"]
        ],
        [
            "info" => "User edit profile",
            "requestMethod" => "get",
            "path" => "account/profile/edit",
            "callable" => ["userAccountController", "editProfile"]
        ],
        [
            "info" => "User handle edit profile",
            "requestMethod" => "post",
            "path" => "account/profile/edit",
            "callable" => ["userAccountController", "handleEditProfile"]
        ],
        [
            "info" => "User change password",
            "requestMethod" => "get",
            "path" => "account/password",
            "callable" => ["userAccountController", "changePassword"]
        ],
        [
            "info" => "User handle change password",
            "requestMethod" => "post",
            "path" => "account/password",
            "callable" => ["userAccountController", "handleChangePassword"]
        ],
    ]
];
