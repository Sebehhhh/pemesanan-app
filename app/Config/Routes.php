<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::authenticate');
$routes->get('logout', 'AuthController::logout');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::createUser');

$routes->get('dashboard', 'DashboardController::index');

$routes->get('products', 'ProductController::index');
$routes->get('products/create', 'ProductController::create');
$routes->post('products/store', 'ProductController::store');
$routes->get('products/edit/(:num)', 'ProductController::edit/$1');
$routes->post('products/update/(:num)', 'ProductController::update/$1');
$routes->get('products/delete/(:num)', 'ProductController::delete/$1');

$routes->get('users', 'UserController::index');
$routes->get('users/create', 'UserController::create');
$routes->post('users/store', 'UserController::store');
$routes->get('users/edit/(:num)', 'UserController::edit/$1');
$routes->post('users/update/(:num)', 'UserController::update/$1');
$routes->get('users/delete/(:num)', 'UserController::delete/$1');

$routes->get('orders', 'OrderController::index');
$routes->get('orders/view/(:num)', 'OrderController::view/$1');
$routes->get('orders/create', 'OrderController::create');
$routes->post('orders/store', 'OrderController::store');
$routes->get('orders/edit/(:num)', 'OrderController::edit/$1');
$routes->post('orders/update/(:num)', 'OrderController::update/$1');
$routes->get('orders/delete/(:num)', 'OrderController::delete/$1');

$routes->post('cart/add', 'CartController::add');
$routes->get('cart', 'CartController::index');
$routes->get('cart/remove/(:num)', 'CartController::remove/$1');
$routes->get('cart/clear', 'CartController::clear');
$routes->post('checkout', 'CartController::checkout');
