<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// login
$routes->get('auth/login', 'LoginController::index', ['filter' => 'GuestFilter']);
$routes->post('auth/login', 'LoginController::aksi_login', ['filter' => 'GuestFilter']);
$routes->get('auth/logout', 'LoginController::logout');

// pages public
$routes->get('/', 'Home::index');
$routes->get('/tentang-kami', 'Home::TentangKami');
$routes->get('/pendahuluan', 'Home::Pendahuluan');
$routes->get('/maksud-dan-tujuan', 'Home::MaksudDanTujuan');
$routes->get('/visi-misi-motto', 'Home::VisiMisi');
$routes->get('/kondisi-wilayah', 'Home::KondisiWilayah');
$routes->get('/tanamanku', 'Home::Tanamanku');
$routes->get('/tanamanku/detail/(:num)', 'Home::DetailTanamanku/$1');
$routes->get('/quiz-list', 'Home::quisList');
$routes->get('/quiz/take/all', 'Home::takeAll');
$routes->post('/quiz/submit-all', 'Home::submitQuizAll');
// $routes->get('/hubungi-kami', 'Home::HubungiKami');
$routes->get('/program', 'Home::ProgramPkk');
$routes->get('/form-pendaftaran', 'Home::FormPendaftaran');
$routes->get('/sekretariat', 'Home::Sekretariat');
$routes->get('/detail-sekret', 'Home::DetailSekret');
$routes->get('/rekrutmen', 'Home::page_rekrutmen');
$routes->post('/rekrutmen', 'Home::aksi_rekrutmen');

// admin
$routes->group('admin', ['filter' => 'AdminFilter'], static function ($routes) {
    $routes->get('dashboard', 'AdminController::DashboardAdmin');
    $routes->get('tanamanku', 'AdminController::page_tanamanku');
    $routes->get('tanamanku/create', 'TanamanController::page_tambah_tanamanku');
    $routes->post('tanamanku/create', 'TanamanController::AksiTanamanku');
    $routes->get('tanamanku/edit/(:num)', 'TanamanController::page_edit_tanamanku/$1');
    $routes->put('tanamanku/edit/(:num)', 'TanamanController::EditTanamanku/$1');
    $routes->get('tanamanku/detail/(:num)', 'TanamanController::DetailTanamanku/$1');
    $routes->get('tanamanku/delete/(:num)', 'TanamanController::DeleteTanamanku/$1');
    $routes->get('quiz', 'AdminController::page_quiz');
    $routes->get('quiz/create', 'QuizController::page_tambah_quiz');
    $routes->post('quiz/create', 'QuizController::AksiQuiz');
    $routes->get('quiz/update/(:num)', 'QuizController::page_edit/$1');
    $routes->put('quiz/update/(:num)', 'QuizController::EditQuiz/$1');
    $routes->get('quiz/delete/(:num)', 'QuizController::delete_quizById/$1');

    $routes->get('quiz/detail/(:num)', 'QuizController::detail_quiz/$1');
    $routes->get('quiz/soal/(:segment)/tambah', 'QuizController::page_soalByKategori/$1');
    $routes->post('quiz/soal/(:segment)/tambah', 'QuizController::AksiSoalByKategori/$1');
    $routes->get('quiz/(:num)/urutan/(:num)/edit', 'QuizController::page_editByIdUrutan/$1/$2');
    $routes->put('quiz/(:num)/urutan/(:num)/edit', 'QuizController::updateByIdUrutan/$1/$2');
    $routes->get('quiz/delete/(:num)/(:num)', 'QuizController::deleteByIdUrutan/$1/$2');

    // rekrutmen
    $routes->get('rekrutmen', 'AdminController::page_rekrutmen');
    $routes->get('rekrutmen/create', 'RekrutController::page_insert');
    $routes->post('rekrutmen/create', 'RekrutController::aksi_insert_rekrutmen');
    $routes->get('rekrutmen/update/(:num)', 'RekrutController::page_edit_rekrutmen/$1');
    $routes->post('rekrutmen/update/(:num)', 'RekrutController::aksi_edit_rekrutmen/$1');
    $routes->get('rekrutmen/detail/(:num)', 'RekrutController::page_detail_rekrutmen/$1');
    $routes->get('rekrutmen/delete/(:num)', 'RekrutController::delete_by_id/$1'); //table
    $routes->post('rekrutmen/delete/(:num)', 'RekrutController::aksi_delete_rekrutmen/$1'); //detail

    // pokja
    $routes->get('rekrutmen/pokja/create', 'RekrutController::page_insert_pokja');
    $routes->post('rekrutmen/pokja/create', 'RekrutController::aksi_insert_pokja');
    $routes->get('rekrutmen/pokja/update/(:num)', 'RekrutController::page_update_pokja/$1');
    $routes->post('rekrutmen/pokja/update/(:num)', 'RekrutController::aksi_edit_pokja/$1');
    $routes->get('rekrutmen/pokja/delete/(:num)', 'RekrutController::aksi_delete_pokja/$1');

    $routes->get('profile', 'ProfileController::page_profile');
    $routes->get('profile/edit', 'ProfileController::edit_profile');
    $routes->post('profile/edit', 'ProfileController::aksi_update_profile');
    $routes->get('profile/ganti-password', 'ProfileController::change_password');
    $routes->post('profile/ganti-password', 'ProfileController::update_password');
    // tambahkan semua rute admin lain di sini…
});
