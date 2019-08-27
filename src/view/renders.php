<?php

return [
    'include' => function($template, $position, $options){
        view_render($options);
        return str_replace($position, "<?php include VIEWS_CACHE . '$options' ?>", $template);
    },
    'parent' => function($template, $position, $options) {
        $template = str_replace($position, '', $template);
        $parent = file_get_contents(VIEWS . $options);
        return str_replace('#child#', $template, $parent);
    },
    'global' => function($template, $position, $options) {
        $variables = explode(',', str_replace(['[', ']'], '', $options));
        $include = '<?php ' . implode(';', array_map(function($var){
            return "$${var} = \$self->context->${var}";
        }, $variables)) . ';?>';
        return str_replace($position, $include, $template);
    }
];