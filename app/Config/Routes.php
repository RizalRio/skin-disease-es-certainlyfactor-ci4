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
    $routes->match(['GET', 'POST'], 'edit', 'Diseases::edit');
    $routes->match(['GET', 'POST'], 'delete', 'Diseases::delete');
});
$routes->group('symptoms', static function ($routes) {
    $routes->get('', 'Symptoms::index');
    $routes->get('getData', 'Symptoms::getData');
    $routes->post('create', 'Symptoms::create');
    $routes->match(['GET', 'POST'], 'edit', 'Symptoms::edit');
    $routes->match(['GET', 'POST'], 'delete', 'Symptoms::delete');
});
