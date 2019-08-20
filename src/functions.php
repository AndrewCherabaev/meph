<?php

include __DIR__ . "/helpers/array_helper.php";
include __DIR__ . "/helpers/html_helper.php";
include __DIR__ . "/helpers/form_helper.php";

function error_handler($errno, $errstr, $errfile, $errline, $errcontext)
{
    include __DIR__ . "/templates/error.php";
}
function json($value, int $options = 0, int $depth = 512)
{
    echo json_encode($value, $options, $depth);
    exit;
}
function set_status($status_code)
{
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
    ob_start();
    $self = new class($data){
        public function __construct($data){
            $this->context=(object)$data;
            try {
                throw new Exception();
            } catch(Throwable $e) {
                $this->trace=array_map(function($_){extract($_);return compact('file', 'line', 'function', 'args');},$e->getTrace());
            }
        }
    };
    include VIEWS . $view_path;
    echo ob_get_clean();
}
