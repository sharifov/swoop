<?php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);

define('DIR_CONTROLLER', __DIR__ . '/app/controllers/');
define('DIR_MODEL', __DIR__ . '/app/models/');
define('DEFAULT_CONTROLLER', 'main');
define('DEFAULT_ACTION', 'index');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_NAME', 'swoop');
define('DB_PASS', '123');
define('DB_PREFIX', '');

spl_autoload_register(function($class) {
    include_once('app/' . $class . '.php');
});

Start::bootstrap(new Router);
