<?php

$router = $di->getRouter();

$router->add('/:controller', [
    'namespace'  => 'App\Controllers',
    'controller' => 1
]);

$router->add('/:controller/:action', [
    'namespace'  => 'App\Controllers',
    'controller' =>  1,
    'action'     =>  2
]);

$router->add('/:controller/:action/:params', [
    'namespace'  => 'App\Controllers',
    'controller' => 1,
    'action'     => 2,
    'params'     => 3
]);
$router->addGet('/login', [
    'controller' => 'auth',
    'action' => 'showLogin',
]);
$router->addPost('/login', [
    'controller' => 'auth',
    'action' => 'login',
]);
$router->addGet('/register', [
    'controller' => 'auth',
    'action' => 'showRegister',
]);
$router->addPost('/register', [
    'controller' => 'auth',
    'action' => 'register',
]);

$router->handle();
