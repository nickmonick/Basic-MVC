<?php

use MVC\Core\Application;

require __DIR__.'/../vendor/autoload.php';

$app = new Application;

$app->get('/', 'HomeController@imdex')
    ->post('/', 'HomeController@index');

$app->resolve();