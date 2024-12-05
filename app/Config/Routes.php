<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::getData');
$routes->get('/movieDescriptionview', 'HomeController::movieDescriptionview');
$routes->get('/movieDescription/getData/(:any)', 'HomeController::getDataById/$1  ');
$routes->post('/addData', 'HomeController::addData');
// $routes->get('/movieDescription/(:any)', 'HomeController::movieDescription/$1');
// $routes->get('/movieDescription', 'HomeController::movieDescription');