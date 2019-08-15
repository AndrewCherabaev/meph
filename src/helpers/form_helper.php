<?php
function form() {
    return new class {
        static function open(array $data) {
            $attributes = [];
            foreach ($data as $key => $value) {
                $attributes[] = "$key=\"$value\"";
            }
            echo '<form ' . implode(' ', $attributes) . '>';
        }
        static function close(){
            echo '</form>';
        }
        static function input(array $data)
        {
            $attributes = [];
            foreach ($data as $key => $value) {
                $attributes[] = "$key=\"$value\"";
            }
            echo '<input ' . implode(' ', $attributes) . '>';
        }
    };
}