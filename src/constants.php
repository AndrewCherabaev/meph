<?php

include __DIR__ . "/atoms.php";

define("SEP", DIRECTORY_SEPARATOR);
define("APP", getcwd() . SEP . "app" . SEP);
define("CONTROLLERS", APP . "controllers" . SEP);
define("VIEWS", APP . "views" . SEP);
define("CONFIGS", APP . "config" . SEP);
define("ROUTES", CONFIGS . "routes.php");