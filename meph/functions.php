<?php

include __DIR__ . "/array_helper.php";
include __DIR__ . "/html_helper.php";
include __DIR__ . "/form_helper.php";

function error_handler($errno, $errstr, $errfile, $errline, $errcontext) {
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
function json($value, int $options = 0, int $depth = 512)
{
    echo json_encode($value, $options, $depth);
    exit;
}
function set_status($status_code){
    http_response_code((int) substr($status_code, 5));
}
function send_status($status_code)
{
    set_status($status_code);
    echo $status_code;
    exit;
}
function view($view_path, array $data)
{
    try {
        ob_start();
        extract($data);
        include VIEWS . $view_path;
        echo ob_get_clean();
    } catch (ErrorException $throw) {
        set_status(HTTP_500);
        echo $throw->getMessage();
    }
}