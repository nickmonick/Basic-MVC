<?php
require __DIR__.'/../vendor/autoload.php';
error_reporting(E_ALL);
set_exception_handler('MVC\Core\Error::exceptionHandler');
session_start();

use MVC\Core\Application;

$app = new Application;

//HomeShit
$app->get('/', 'HomeController@index');

//RegisterBullshit
$app->get('/register','RegisterController@index')
    ->post('/register', 'RegisterController@register');

$app->resolve();

