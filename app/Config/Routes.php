<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/admin/dashboard', 'admin\dashboard');
$routes->get('/admin/produk', 'admin\produk');
$routes->get('/admin/produk/form(:any)', 'admin\produk::form$1');
$routes->post('/admin/produk/create', 'admin\produk::create');
$routes->post('/admin/produk/update', 'admin\produk::update');
$routes->get('/admin/produk/delete(:any)', 'admin\produk::delete$1');
$routes->get('/admin/kriteria', 'admin\kriteria');
$routes->get('/admin/kriteria/get_data', 'admin\kriteria::get_data');
$routes->post('/admin/kriteria/create', 'admin\kriteria::create');
$routes->post('/admin/kriteria/delete', 'admin\kriteria::delete');

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
