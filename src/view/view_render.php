<?php

function view_render($view_path) {

    $renders = require 'renders.php';
    
    $parts = explode('/', $view_path);
    $file = array_pop($parts);
    $dir = VIEWS_CACHE;
    foreach($parts as $part) if(!is_dir($dir .= "$part/")) mkdir($dir);
    $dir .= "$file";

    $template = file_get_contents(VIEWS . $view_path);

    $matches = [];
    // perlace php open/close tags with htmlentities
    $template = str_replace(['<?', '?>'], ['&lt;&quest;','&quest;&gt;'], $template);
    // rm comments
    $template = preg_replace('/\#\-.+\-\#/', '', $template);
    // operators
    preg_match_all('/\#(?<operator>[a-z]+)\s(?<subject>.+)\#/im', $template, $matches);
    foreach ($matches["operator"] as $index => $operator) {
        if ($renders[$operator] ?? false) {
            $template = $renders[$operator]($template, $matches[0][$index], $matches['subject'][$index]);
        }
    }

    // replace "#" with "<?"
    file_put_contents($dir, str_replace(['#::', '#:', ':#'], ['<?php echo ', '<?php ', ' ?>'], $template . "\n"));
}