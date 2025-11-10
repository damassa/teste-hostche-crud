<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Rota padrão
$routes->get('/', 'Home::index');

//Rotas para clientes
$routes->get('/', 'Clientes::index'); //Rota principal (página inicial)
$routes->get('clientes/(:id)', 'Clientes::show/$1'); //Como se fosse getClientById
$routes->resource('clientes');

//Rotas de login
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');


return $routes;