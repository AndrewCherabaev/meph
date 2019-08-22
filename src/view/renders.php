<?php

return [
    'parent' => function($template, $where, $with) {
        $template = str_replace($where, '', $template);
        $parent = file_get_contents(VIEWS . $with);
        return str_replace('#child#', $template, $parent);
    },
    'globals' => function($template, $where, $whith) {
        $variables = explode(',', str_replace(['[', ']'], '', $whith));
        $include = '#: ' . implode(';', array_map(function($var){
            return "$${var} = \$self->context->${var}";
        }, $variables)) . ':#';
        return str_replace($where, $include, $template);
    }
];