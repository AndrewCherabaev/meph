<?php

return [
    "index_controller" => [
        "index_action" => function(): array {
            return [
                'view', ['index.php', []]
            ];
            /**
             * The same behavior:
             */
            return [
                'index.php'
            ];
        },

        "json_action" => function(): array {
            return [
                'json', 
                [ // data to json_encode. always array
                    'content' => [
                        "name" => "meph/meph",
                        "version"=> "master",
                        "source" => [
                            "git",
                            "https://github.com/AndrewCherabaev/meph.git",
                            "master"
                        ]
                    ],
                    'json_options' => JSON_PRETTY_PRINT | JSON_FORCE_OBJECT
                ]
            ];
        }
    ]
];