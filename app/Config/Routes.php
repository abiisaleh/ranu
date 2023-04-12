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
$routes->post('/smart', 'Home::smart');
$routes->get('/kriteria/get_data', 'Home::get_data');

$routes->get('/admin/dashboard', 'admin\dashboard');
$routes->get('/admin/produk', 'admin\produk');
$routes->get('/admin/produk/get_data', 'admin\produk::get_data');
$routes->get('/admin/produk/form(:any)', 'admin\produk::form$1');
$routes->post('/admin/produk/create', 'admin\produk::create');
$routes->post('/admin/produk/update', 'admin\produk::update');
$routes->post('/admin/produk/delete', 'admin\produk::delete');
$routes->get('/admin/kriteria', 'admin\kriteria');
$routes->get('/admin/kriteria/get_data', 'admin\kriteria::get_data');
$routes->post('/admin/kriteria/create', 'admin\kriteria::create');
$routes->post('/admin/kriteria/edit', 'admin\kriteria::edit');
$routes->post('/admin/kriteria/delete', 'admin\kriteria::delete');
$routes->get('/admin/kriteria/subkriteria(:any)', 'admin\kriteria::subkriteria$1');
$routes->get('/admin/kriteria/get_subkriteria', 'admin\kriteria::get_subkriteria');
$routes->post('/admin/kriteria/create_subkriteria', 'admin\kriteria::create_subkriteria');
$routes->post('/admin/kriteria/get_modalEdit', 'admin\kriteria::get_modalEdit');
$routes->post('/admin/kriteria/update_subkriteria', 'admin\kriteria::update_subkriteria');
$routes->post('/admin/kriteria/delete_subkriteria', 'admin\kriteria::delete_subkriteria');
$routes->get('/admin/pesanan', 'admin\pesanan');
$routes->get('/admin/pesanan/get_data', 'admin\pesanan::get_data');
$routes->post('/admin/pesanan/delete', 'admin\pesanan::delete');
$routes->post('/admin/pesanan/invoice', 'admin\pesanan::invoice');
$routes->post('/admin/pesanan/verifikasi', 'admin\pesanan::verifikasi');

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
