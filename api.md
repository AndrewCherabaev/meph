# architecture api

## pipeline

```
app kernel
> router
> routes list
> get DI binding params
> get controller
> bind dependencies/extencions/uses
> bind action to ctrl object
> DI to current action and execute
> wrap returned data
    callable ? call : render view
> return data
```

## routes format
```php
"/^regexp$/s" => [
    "method_name" => [
        "action" => "controller_name.action_name",
        "with" => [
            "route_key" => "action_argument"
        ]
    ]
]
```
example:
```php
return [
    // Means root URL
    "/^\/\/?$/s" => [
        "GET" => [
            "action" => "index.index"
        ]
    ],
    /**
     * Means '/users/{user}/' with possible ending slash, where {user} is digit
     * PHP named templates \m/
     */
    "/^\/users\/(?<user>\d+)\/?$/s" => [
        "GET" => [
            "action" => "users.index",
            "with" => [
                "user" => "user"
            ]
        ]
    ]
]
```

## controllers format
```php 
return [
    // Key myst be the same with filename
    "index_controller" => (object) [  //array to object cast, 'cause objects are faster!
        "uses" => [],                //list of base or registered services (maybe raise error if no such fields)
        "mixins" => [],              //list of mixins 'cause no inheritance (maybe raise error if no such fields)
        "index_action" => function(): array { //return type "array" is required!
            //do stuff
            if (/* render view */) {
                return ['/view/file/name.php', [/* data to render */]];
                /* or */ 
                return ['view', ['/view/file/name.php', [/* data to render */]]]
            }
            
            if (/* render JSON */) {
                return ['json_encode', [[/* data to render */], /* JSON_OPTIONS */];
            }
        }
    ]
];
```