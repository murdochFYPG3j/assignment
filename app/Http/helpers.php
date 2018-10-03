<?php

function withoutForeignKeyCheck($closure) {
    $mysql = config('database.default') === 'mysql';
    if ($mysql) \DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
    $closure();
    if ($mysql) \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
}