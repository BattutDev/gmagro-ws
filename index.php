<?php

session_start();
ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('Europe/Paris');

require_once 'config.php';

function loadClasses($classe): void
{
    $cls = str_replace('\\', DIRECTORY_SEPARATOR, $classe);
    include $cls . '.php';
}

spl_autoload_register('loadClasses');

$controller = filter_input(INPUT_GET, 'c', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_GET, 'a', FILTER_SANITIZE_STRING);

switch ($controller) {
    case 'auth':
        if (!$action) $action = \controllers\AuthController::$default_action;
        $c = new controllers\AuthController($action, true);
        break;

}