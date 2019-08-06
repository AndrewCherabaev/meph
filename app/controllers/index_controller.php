<?php

return [
    "index_controller" => (object)[
        "index_action" => function(): array {
            return [
                'view', ['index.php', []]
            ];
            /**
             * The same behavior:
             */
            return [
                'index.php', []
            ];
        },

        "json_action" => function(): array {
            return [
                'json', 
                [ // data to json_encode. always array
                    ['key' => 'value', 'array' => [1,2,3]], //value
                    JSON_PRETTY_PRINT | JSON_FORCE_OBJECT // options
                ]
            ];
        }
    ]
];