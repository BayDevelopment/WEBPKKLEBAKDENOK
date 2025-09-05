<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Welcome | PKK Kelurahan Lebak Denok',
            'navLink' => 'Beranda' //untuk navlink 
        ];
        return view('home', $data);
    }
    public function TentangKami()
    {
        $data = [
            'title' => 'Tentang Kami | PKK Kelurahan Lebak Denok',
            'navLink' => 'Tentang Kami' //untuk navlink 
        ];
        return view('pages/public/tentang-kami', $data);
    }
    public function Pendahuluan()
    {
        $data = [
            'title' => 'Pendahuluan | PKK Kelurahan Lebak Denok',
            'navLink' => 'Pendahuluan' //untuk navlink 
        ];
        return view('pages/public/pendahuluan', $data);
    }
}
