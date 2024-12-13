<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::getData');
$routes->get('/login', 'AuthController::index');
$routes->get('/logout', 'AuthController::logOut');
$routes->get('/register', 'AuthController::register');
$routes->get('/viewAllMovies', 'HomeController::getDataAllMovies');
$routes->get('/viewLogs', 'AuthController::viewLogs');
// $routes->post('/login/authenticate', 'AuthController::authenticate');
$routes->post('/register/saveData', 'AuthController::saveData');
$routes->get('/movieDescriptionview', 'HomeController::movieDescriptionview');
$routes->get('/movieDescription/getData/(:segment)', 'HomeController::getDataById/$1  ');
$routes->get('/bookSeats/(:any)', 'HomeController::bookSeats/$1');
$routes->get('/displayTicket/(:any)', 'HomeController::displayTicket/$1');
$routes->post('/movieDescription/deleteData/(:segment)', 'HomeController::deletMovieData/$1  ');
$routes->post('/addData', 'HomeController::addData');
$routes->post('/updateData/(:any)', 'HomeController::updateMovieData/$1');
$routes->post('/seats/book', 'HomeController::book');
$routes->post('/seats/status', 'HomeController::status');



$routes->post('/login/authenticate', 'AuthController::authenticate');
// $routes->get('/logout', 'AuthController::logout');
// $routes->get('/dashboard', 'Auth::getData');