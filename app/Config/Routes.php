<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Rota padrão
$routes->get('/', 'Home::index');

//Rotas para clientes
$routes->get('/', 'Clientes::index'); //Rota principal (página inicial)
$routes->resource('clientes');


return $routes;