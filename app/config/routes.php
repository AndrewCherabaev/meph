<?php

return [
    "/^\/\/?$/s" => [
        "GET" => [
            "action" => "index.index"
        ]
    ],
    "/^\/json\/?$/s" => [
        "GET" => [
            "action" => "index.json"
        ]
    ]
];