<?php

function array_helper() {
    return new class {
        static function filter()
        {
            return array_filter(...func_get_args());
        }

        static function array()
        {
            return func_get_args();
        }

        static function get(array $input, array $filter)
        {
            $output = $input;
            foreach ($filter as $key => $value) {
                $output = array_filter($output, function($item) use ($key, $value) {
                    if (is_callable($value)) {
                        return ($item[$key] ?? false) && $value($item[$key]);
                    } else {
                        return ($item[$key] ?? false) && ($item[$key] == $value);
                    }
                });
            }

            return $output;
        }
    };
}