<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::getData');
$routes->get('/movieDescriptionview', 'HomeController::movieDescriptionview');
$routes->get('/movieDescription/getData/(:segment)', 'HomeController::getDataById/$1  ');
$routes->get('/bookTickets/(:any)', 'HomeController::bookTickets/$1');
$routes->get('/displayTicket/(:any)', 'HomeController::displayTicket/$1');
$routes->post('/movieDescription/deleteData/(:segment)', 'HomeController::deletMovieData/$1  ');
$routes->post('/addData', 'HomeController::addData');
$routes->post('/updateData/(:any)', 'HomeController::updateMovieData/$1');
$routes->post('/seats/book', 'HomeController::book');
$routes->post('/seats/status', 'HomeController::status');
// $routes->get('/movieDescription/(:any)', 'HomeController::movieDescription/$1');
// $routes->get('/movieDescription', 'HomeController::movieDescription');