<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');

$routes->group('diseases', static function ($routes) {
    $routes->get('', 'Diseases::index');
    $routes->get('getData', 'Diseases::getData');
    $routes->post('create', 'Diseases::create');
});
