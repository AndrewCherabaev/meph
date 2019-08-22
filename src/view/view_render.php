<?php

function view_render($view_path) {

    $renders = require 'renders.php';

    $template = file_get_contents(VIEWS . $view_path);

    $matches = [];
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
    file_put_contents(VIEWS_CACHE . $view_path, preg_replace(['/\#\:\:/', '/\#\:/', '/\:\#/'], ['<?php echo', '<?php ', ' ?>'], $template . "\n"));
}