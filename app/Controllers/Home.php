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
    public function MaksudDanTujuan()
    {
        $data = [
            'title' => 'Maksud dan Tujuan | PKK Kelurahan Lebak Denok',
            'navLink' => 'MaksudTujuan' //untuk navlink 
        ];
        return view('pages/public/maksud-tujuan', $data);
    }
    public function VisiMisi()
    {
        $data = [
            'title' => 'Visi, Misi & Motto | PKK Kelurahan Lebak Denok',
            'navLink' => 'VisiMisi' //untuk navlink 
        ];
        return view('pages/public/visi-misi', $data);
    }
    public function KondisiWilayah()
    {
        $data = [
            'title' => 'Kondisi Wilayah | PKK Kelurahan Lebak Denok',
            'navLink' => 'KondisiWilayah' //untuk navlink 
        ];
        return view('pages/public/kondisi-wilayah', $data);
    }
    public function Tanamanku()
    {
        $data = [
            'title' => 'Tanamanku | PKK Kelurahan Lebak Denok',
            'navLink' => 'Tanamanku' //untuk navlink 
        ];
        return view('pages/public/tanamanku', $data);
    }
    public function DetailTanamanku()
    {
        $data = [
            'title' => 'Detail Tanamanku | PKK Kelurahan Lebak Denok',
            'navLink' => 'DetailTanamanku' //untuk navlink 
        ];
        return view('pages/public/detail-tanamanku', $data);
    }
    public function Kuis()
    {
        $data = [
            'title' => 'Kuis Masyarakat | PKK Kelurahan Lebak Denok',
            'navLink' => 'Kuis' //untuk navlink 
        ];
        return view('pages/public/kuis', $data);
    }
    public function HubungiKami()
    {
        $data = [
            'title' => 'Hubungi Kami | PKK Kelurahan Lebak Denok',
            'navLink' => 'HubungiKami' //untuk navlink 
        ];
        return view('pages/public/hubungi', $data);
    }
}
