<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Dashboard::index');
$routes->get('/', 'User::index');
$routes->get('/login', 'User::index');
$routes->post('/register', 'User::register');
$routes->post('/login', 'User::login');

$routes->get('/logout', 'User::logout');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'loginfilter']);

$routes->group('diseases', ['filter' => 'rolefilter:admin'], static function ($routes) {
    $routes->get('', 'Diseases::index');
    $routes->get('getDiseases', 'Diseases::getDiseases');
    $routes->get('getData', 'Diseases::getData');
    $routes->post('create', 'Diseases::create');
    $routes->match(['GET', 'POST'], 'edit', 'Diseases::edit');
    $routes->match(['GET', 'POST'], 'delete', 'Diseases::delete');
});
$routes->group('symptoms', ['filter' => 'rolefilter:admin'], static function ($routes) {
    $routes->get('', 'Symptoms::index');
    $routes->get('getSymptoms', 'Symptoms::getSymptoms');
    $routes->get('getData', 'Symptoms::getData');
    $routes->post('create', 'Symptoms::create');
    $routes->match(['GET', 'POST'], 'edit', 'Symptoms::edit');
    $routes->match(['GET', 'POST'], 'delete', 'Symptoms::delete');
});
$routes->group('rules', ['filter' => 'rolefilter:admin'], static function ($routes) {
    $routes->get('', 'Rules::index');
    $routes->get('getData', 'Rules::getData');
    $routes->post('create', 'Rules::create');
    $routes->match(['GET', 'POST'], 'edit', 'Rules::edit');
    $routes->match(['GET', 'POST'], 'delete', 'Rules::delete');
});
$routes->group('diagnose', static function ($routes) {
    $routes->get('', 'Diagnose::index');
    $routes->post('diagnose', 'Diagnose::diagnose');
});
