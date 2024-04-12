<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

use App\Controllers\Activities;
use App\Controllers\Pages;

$routes->get('activities', [Activities::class, 'index']);
$routes->get('activities/new', [Activities::class, 'new']); // Add this line
$routes->post('activities', [Activities::class, 'create']);
$routes->get('activities/(:segment)', [Activities::class, 'show']);

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
