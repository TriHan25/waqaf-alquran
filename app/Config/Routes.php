<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// User
$routes->get('/', 'Home::index');
$routes->get('/Cek_Orderan', 'Resi::index');

// Admin
$routes->get('/admin', 'Admin\Login::index');
$routes->get('/dashboard', 'Admin\Dashboard::index');

//region Produk
// Home Produk
$routes->get('/produk', 'Admin\DataProduk::index');
// Create
$routes->get('/produk/create', 'Admin\DataProduk::create');
$routes->post('/produk/save', 'Admin\DataProduk::save');
// Edit
$routes->get('/produk/edit/(:segment)', 'Admin\DataProduk::edit/$1');
$routes->post('/produk/update/(:num)', 'Admin\DataProduk::update/$1');
// Detail
$routes->get('/produk/detail/(:segment)', 'Admin\DataProduk::detail/$1');
// Delete
$routes->delete('/produk/(:num)', 'Admin\DataProduk::delete/$1');
//endregion

//region Orderan
// Home Orderan
$routes->get('/orderan', 'Admin\Orderan::index');
$routes->post('/orderan/filter', 'Admin\Orderan::filter');
$routes->post('/orderan/search', 'Admin\Orderan::search');
// create
$routes->get('/orderan/create', 'Admin\Orderan::create');
$routes->post('/orderan/konfirmasi', 'Admin\Orderan::konfirmasi');
$routes->post('/orderan/save', 'Admin\Orderan::save');
// Edit
$routes->get('/orderan/edit/(:segment)', 'Admin\Orderan::edit/$1');
$routes->post('/orderan/konfirmasi-edit/(:segment)', 'Admin\Orderan::konfirmasi_edit/$1');
$routes->post('/orderan/update/(:num)', 'Admin\Orderan::update/$1');
// Detail
$routes->get('/orderan/detail/(:segment)', 'Admin\Orderan::detail/$1');
// Delete
$routes->delete('/orderan/(:num)', 'Admin\Orderan::delete/$1');



//endregion 

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
