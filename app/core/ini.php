<?php
ob_start();
session_start();

define("BASE_URL","/");
define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]. '../');

include_once ROOT_PATH.'functions/sanitaze.php';
include_once ROOT_PATH . 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => getenv('DB_HOST'),
        'username' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'db' => getenv('DB_DATABASE'),
    ),
    'session' => array(
        'token_name' => 'token',
        'session_name' => 'user'
    )
);

spl_autoload_register(function ($class) {
    include ROOT_PATH.'classes/' . $class . '.php';
});


