<?php
function form() {
    return new class {
        public static function open(array $data) {
            $attributes = [];
            foreach ($data as $key => $value) {
                $attributes[] = "$key=\"$value\"";
            }
            echo '<form ' . implode(' ', $attributes) . '>';
        }
        public static function close(){
            echo '</form>';
        }
        public static function input(array $data)
        {
            $attributes = [];
            foreach ($data as $key => $value) {
                $attributes[] = "$key=\"$value\"";
            }
            echo '<input ' . implode(' ', $attributes) . '>';
        }
    };
}