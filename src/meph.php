<?php
include __DIR__ . "/constants.php";
include __DIR__ . "/functions.php";

return new class
{
    protected static $params = [];
    protected static $method = '';
    protected static $path = '';
    function __construct()
    {
        set_error_handler('error_handler');
        static::$method = $_SERVER["REQUEST_METHOD"];
        static::$path = $_SERVER["PATH_INFO"] ?? '/';

        $route = $this->route();
        [$controller_name, $action_name] = explode('.', $route[static::$method]['action']);
        $controller = (require CONTROLLERS . $controller_name . '_controller.php')[$controller_name . '_controller'];
        $method = $controller->{$action_name . '_action'}->bindTo($controller);

        $returnType = (new ReflectionFunction($method))->getReturnType();

        if (empty($returnType) || $returnType->__toString() != 'array') {
            echo OK_MESSAGE;
            exit;
        }

        @[$source, $data] = call_user_func_array($method, []);

        if (is_callable($source)) {
            return call_user_func_array($source, $data ?? []);
        }

        return view($source, $data);

    }

    function route()
    {
        $routes = require ROUTES;
        foreach (array_keys($routes) as $route) {
            $matches = [];

            if (\preg_match($route, static::$path, $matches)) {
                self::$params = array_filter($matches, function ($key) {
                    return is_string($key);
                }, ARRAY_FILTER_USE_KEY);

                return $routes[$route];
            }
        }

        send_status(HTTP_404);
    }
};
