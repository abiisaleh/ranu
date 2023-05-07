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
$routes->get('/produk(:any)', 'Home::produk$1');
$routes->post('/pesan', 'Home::pesan');
$routes->get('/pembayaran(:any)', 'Home::pembayaran$1');
$routes->post('/upload(:any)', 'Home::upload$1');
$routes->post('/smart', 'Home::smart');
$routes->get('/kriteria/get_data', 'Home::get_data');

$routes->get('/admin/dashboard', 'admin\Dashboard');
$routes->get('/admin/produk', 'admin\Produk');
$routes->get('/admin/produk/get_data', 'admin\Produk::get_data');
$routes->get('/admin/produk/form(:any)', 'admin\Produk::form$1');
$routes->post('/admin/produk/create', 'admin\Produk::create');
$routes->post('/admin/produk/update', 'admin\Produk::update');
$routes->post('/admin/produk/delete', 'admin\Produk::delete');
$routes->get('/admin/kriteria', 'admin\Kriteria');
$routes->get('/admin/kriteria/get_data', 'admin\Kriteria::get_data');
$routes->post('/admin/kriteria/create', 'admin\Kriteria::create');
$routes->post('/admin/kriteria/edit', 'admin\Kriteria::edit');
$routes->post('/admin/kriteria/delete', 'admin\Kriteria::delete');
$routes->get('/admin/kriteria/subkriteria(:any)', 'admin\Kriteria::subkriteria$1');
$routes->get('/admin/kriteria/get_subkriteria', 'admin\Kriteria::get_subkriteria');
$routes->post('/admin/kriteria/create_subkriteria', 'admin\Kriteria::create_subkriteria');
$routes->post('/admin/kriteria/get_modalEdit', 'admin\Kriteria::get_modalEdit');
$routes->post('/admin/kriteria/update_subkriteria', 'admin\Kriteria::update_subkriteria');
$routes->post('/admin/kriteria/delete_subkriteria', 'admin\Kriteria::delete_subkriteria');
$routes->get('/admin/pesanan', 'admin\Pesanan');
$routes->get('/admin/pesanan/get_data', 'admin\Pesanan::get_data');
$routes->post('/admin/pesanan/delete', 'admin\Pesanan::delete');
$routes->post('/admin/pesanan/invoice', 'admin\Pesanan::invoice');
$routes->post('/admin/pesanan/verifikasi', 'admin\Pesanan::verifikasi');

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
