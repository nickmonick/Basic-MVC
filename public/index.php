<?php

session_start();

use MVC\Core\Application;

require __DIR__.'/../vendor/autoload.php';

$app = new Application;

echo $_ENV["NAME"];
//Home Shit
$app->get('/', 'HomeController@index');

//Register Bullshit
$app->get('/register','RegisterController@index')
    ->post('/register', 'RegisterController@register');


$app->resolve();

