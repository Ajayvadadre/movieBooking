<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
// $routes->get('/movieDescription/(:any)', 'HomeController::movieDescription/$1');
$routes->get('/movieDescriptionview', 'HomeController::movieDescriptionview');
$routes->post('/movieDescription', 'HomeController::movieDescription');
#1b1b1b 