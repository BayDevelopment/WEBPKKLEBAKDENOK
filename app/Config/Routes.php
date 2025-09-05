<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// login
$routes->get('auth/login', 'LoginController::index');

// pages public
$routes->get('/', 'Home::index');
$routes->get('/tentang-kami', 'Home::TentangKami');
$routes->get('/pendahuluan', 'Home::Pendahuluan');
