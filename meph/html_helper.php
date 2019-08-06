<?php

function html() {
    return new class {
        static function form() {
            return form();
        }
        static function input(array $data) {
            return form()::input($data);
        }
        static function br(int $count = 1) {
            for ($i = 0; $i < $count; $i++) {
                echo '<br/>';
            }
        }
        static function hr(int $count = 1) {
            for ($i = 0; $i < $count; $i++) {
                echo '<hr/>';
            }
        }
    };
}