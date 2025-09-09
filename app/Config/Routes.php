<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// login
$routes->get('auth/login', 'LoginController::index');

// pages public
$routes->get('/', 'Home::index');
$routes->get('/tentang-kami', 'Home::TentangKami');
$routes->get('/pendahuluan', 'Home::Pendahuluan');
$routes->get('/maksud-dan-tujuan', 'Home::MaksudDanTujuan');
$routes->get('/visi-misi-motto', 'Home::VisiMisi');
$routes->get('/kondisi-wilayah', 'Home::KondisiWilayah');
$routes->get('/tanamanku', 'Home::Tanamanku');
$routes->get('/tanamanku/1', 'Home::DetailTanamanku');
$routes->get('/kuis-masyarakat', 'Home::Kuis');
$routes->get('/hubungi-kami', 'Home::HubungiKami');
$routes->get('/program', 'Home::ProgramPkk');
