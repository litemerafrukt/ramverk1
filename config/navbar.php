<?php

/**
 * Routes relative to siteUrl
 */

return [
    'navbarBrand' => [
        'label' => 'litemerafrukt',
        'route' => '',
    ],
    'routes' => [
        "home" => [
            "label" => '<i class="fa fa-home" aria-hidden="true"></i> Hem',
            "route" => "",
        ],
        "reports" => [
            "label" => '<i class="fa fa-archive" aria-hidden="true"></i> Rapporter',
            "route" => "reports",
        ],
        "comments" => [
            "label" => '<i class="fa fa-comments" aria-hidden="true"></i> ProtoKom',
            "route" => "comments",
        ],
        "books" => [
            "label" => '<i class="fa fa-book" aria-hidden="true"></i> Book',
            "route" => "book",
        ],
        "remserver" => [
            "label" => '<i class="fa fa-server" aria-hidden="true"></i> Remserver',
            "route" => "remserver",
        ],
        "about" => [
            "label" => '<i class="fa fa-id-card-o" aria-hidden="true"></i> Om',
            "route" => "about",
        ]
    ]
];
