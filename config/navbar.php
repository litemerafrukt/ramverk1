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
            "route" => "/reports",
        ],
        "about" => [
            "label" => '<i class="fa fa-id-card-o" aria-hidden="true"></i> Om',
            "route" => "/about",
        ]
    ]
];
