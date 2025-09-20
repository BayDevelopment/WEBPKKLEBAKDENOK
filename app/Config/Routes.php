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
$routes->get('/hubungi-kami', 'Home::HubungiKami');
$routes->get('/program', 'Home::ProgramPkk');
$routes->get('/form-pendaftaran', 'Home::FormPendaftaran');
$routes->get('/sekretariat', 'Home::Sekretariat');
$routes->get('/detail-sekret', 'Home::DetailSekret');

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
    // tambahkan semua rute admin lain di sini…
});
