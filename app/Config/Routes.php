<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('/buku', 'BukuController::index');
    $routes->post('/buku', 'BukuController::store');
    
    $routes->get('/peminjaman', 'PeminjamanController::index');
    $routes->post('/peminjaman', 'PeminjamanController::store');
    $routes->post('/peminjaman/kembali', 'PeminjamanController::kembali');
    
    $routes->get('/anggota', 'AnggotaController::index');
    $routes->post('/anggota', 'AnggotaController::store');
    
    // Superadmin routes
    $routes->group('pengaturan', ['filter' => 'auth:superadmin'], function($routes) {
        $routes->get('kategori', 'PengaturanController::kategori');
        $routes->post('kategori', 'PengaturanController::storeKategori');
        $routes->get('anggota', 'PengaturanController::anggota');
        $routes->post('anggota/store', 'PengaturanController::storeAnggota');
        $routes->post('anggota/update', 'PengaturanController::updateAnggota');
        $routes->post('anggota/delete', 'PengaturanController::deleteAnggota');
    });
});
