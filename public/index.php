<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\CheckInController;
use App\Controllers\HospedeController;

session_start();

$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

$controller;
switch ($path) {
    case '/hospedes':
        $controller = new HospedeController();
        break;
    case '/checkins':
        $controller = new CheckinController();
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
}
$controller->handleRequest();
