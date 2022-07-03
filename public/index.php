<?php

session_start();

use MVC\Core\Application;

require __DIR__.'/../vendor/autoload.php';

$app = new Application;

echo "<pre>";
var_dump();
echo "</pre>";
//Home Shit
$app->get('/', 'HomeController@index');

//Register Bullshit
$app->get('/register','RegisterController@index')
    ->post('/register', 'RegisterController@register');

$app->resolve();

