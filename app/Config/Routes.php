<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Shop::index');
$routes->get('/cart', 'Shop::viewCart');
$routes->get('/add-to-cart/(:num)', 'Shop::addToCart/$1');
$routes->post('/update-cart', 'Shop::updateCart');
$routes->get('/remove-from-cart/(:num)', 'Shop::removeFromCart/$1');
$routes->get('/checkout', 'Shop::checkout');
$routes->post('/process-checkout', 'Shop::processCheckout');

// AJAX routes (optional)
$routes->post('/cart/add', 'CartController::ajaxAdd');
$routes->get('/cart/summary', 'CartController::getCartSummary');

