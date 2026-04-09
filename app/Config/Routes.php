<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =====================================================
// HALAMAN UTAMA → Redirect ke Login
// =====================================================
$routes->get('/', 'Auth::login');

// =====================================================
// AUTH ROUTES (tidak perlu login)
// =====================================================
$routes->group('auth', static function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('process', 'Auth::process');
    $routes->get('logout', 'Auth::logout');
});

// =====================================================
// ADMIN ROUTES (perlu login + role admin)
// =====================================================
$routes->group('admin', ['filter' => ['auth', 'role:admin']], static function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');

    // User Management
    $routes->get('users', 'Admin::users');
    $routes->get('users/create', 'Admin::createUser');
    $routes->post('users/store', 'Admin::storeUser');
    $routes->get('users/edit/(:num)', 'Admin::editUser/$1');
    $routes->post('users/update/(:num)', 'Admin::updateUser/$1');
    $routes->get('users/delete/(:num)', 'Admin::deleteUser/$1');
    $routes->get('users/toggle/(:num)', 'Admin::toggleStatus/$1');
    $routes->get('users/detail/(:num)', 'Admin::userDetail/$1');

    // Data Santri
    $routes->get('santri', 'Admin::santri');
    $routes->post('santri/store', 'Admin::storeSantri');
    $routes->post('santri/update/(:num)', 'Admin::updateSantri/$1');
    $routes->get('santri/delete/(:num)', 'Admin::deleteSantri/$1');
    $routes->get('santri/detail/(:num)', 'Admin::santriDetail/$1');

    // Data Ustadz
    $routes->get('ustadz', 'Admin::ustadz');
    $routes->post('ustadz/store', 'Admin::storeUstadz');
    $routes->post('ustadz/update/(:num)', 'Admin::updateUstadz/$1');
    $routes->get('ustadz/delete/(:num)', 'Admin::deleteUstadz/$1');
    $routes->get('ustadz/detail/(:num)', 'Admin::ustadzDetail/$1');
    // Data Kelas
    $routes->get('kelas', 'Admin::kelas');
    $routes->post('kelas/store', 'Admin::storeKelas');
    $routes->post('kelas/update/(:num)', 'Admin::updateKelas/$1');
    $routes->get('kelas/delete/(:num)', 'Admin::deleteKelas/$1');

    $routes->get('hafalan', 'Admin::hafalan');
    $routes->get('pembayaran', 'Admin::pembayaran');
    $routes->get('pembayaran/detail/(:num)', 'Admin::pembayaranDetail/$1');
    $routes->post('pembayaran/store', 'Admin::storePembayaran');
    $routes->post('pembayaran/update/(:num)', 'Admin::updatePembayaran/$1');
    $routes->get('pembayaran/delete/(:num)', 'Admin::deletePembayaran/$1');
    $routes->get('pembayaran/verifikasi/(:num)', 'Admin::verifikasiPembayaran/$1');
    $routes->get('pengumuman', 'Admin::pengumuman');
    $routes->post('pengumuman/store', 'Admin::storePengumuman');
    $routes->post('pengumuman/update/(:num)', 'Admin::updatePengumuman/$1');
    $routes->get('pengumuman/delete/(:num)', 'Admin::deletePengumuman/$1');

    // Jadwal Management
    $routes->get('jadwal', 'Admin::jadwal');
    $routes->post('jadwal/store', 'Admin::storeJadwal');
    $routes->post('jadwal/update/(:num)', 'Admin::updateJadwal/$1');
    $routes->get('jadwal/delete/(:num)', 'Admin::deleteJadwal/$1');
});

// =====================================================
// USTADZ ROUTES (perlu login + role ustadz)
// =====================================================
$routes->group('ustadz', ['filter' => ['auth', 'role:ustadz']], static function ($routes) {
    $routes->get('dashboard', 'Ustadz::dashboard');

    // Ustadz Mockup Pages
    $routes->get('kelas', 'Ustadz::kelas');
    $routes->get('absensi', 'Ustadz::absensi');
    $routes->post('absensi/store', 'Ustadz::storeAbsensi');
    
    $routes->get('santri', 'Ustadz::santri');
    $routes->get('santri/detail/(:num)', 'Ustadz::santriDetail/$1');
    $routes->get('murojaah', 'Ustadz::murojaah');
    $routes->post('murojaah/store', 'Ustadz::storeMurojaah');
    $routes->get('progres-kelas', 'Ustadz::progresKelas');
    $routes->get('hafalan', 'Ustadz::hafalan');
    $routes->post('hafalan/store', 'Ustadz::storeHafalan');
    $routes->post('hafalan/update/(:num)', 'Ustadz::updateHafalan/$1');
    $routes->get('hafalan/delete/(:num)', 'Ustadz::deleteHafalan/$1');
    $routes->get('jadwal', 'Ustadz::jadwal');
});

// =====================================================
// ORTU ROUTES (perlu login + role ortu)
// =====================================================
$routes->group('ortu', ['filter' => ['auth', 'role:ortu']], static function ($routes) {
    $routes->get('dashboard', 'Ortu::dashboard');

    // Ortu Mockup Pages
    $routes->get('hafalan', 'Ortu::hafalan');
    $routes->get('kehadiran', 'Ortu::kehadiran');
    $routes->get('pembayaran', 'Ortu::pembayaran');
    $routes->post('pembayaran/upload/(:num)', 'Ortu::saveBukti/$1');
    $routes->get('jadwal', 'Ortu::jadwal');
});
