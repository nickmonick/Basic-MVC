<?php

use MVC\Core\Application;

require __DIR__.'/../vendor/autoload.php';

$app = new Application;

//Home Shit
$app->get('/', 'HomeController@index')
    ->post('/', 'HomeController@post');

//Register Bullshit
$app->get('/register','RegisterController@index')
    ->post('/register', 'RegisterController@register');

$app->resolve();