<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Shop::index');
$routes->get('/products', 'Shop::index');
$routes->get('/cart', 'Shop::viewCart');
$routes->get('/add-to-cart/(:num)', 'Shop::addToCart/$1');
$routes->post('/update-cart', 'Shop::updateCart');
$routes->get('/remove-from-cart/(:num)', 'Shop::removeFromCart/$1');
$routes->get('/clear-cart', 'Shop::clearCart');
$routes->get('/checkout', 'Shop::checkout');
$routes->post('/process-checkout', 'Shop::processCheckout');
$routes->get('/order-success/(:num)', 'Shop::orderSuccess/$1');

// AJAX routes
$routes->get('/cart-summary', 'Shop::getCartSummary');