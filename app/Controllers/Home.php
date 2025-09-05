<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Welcome | PKK Kelurahan Lebak Denok',
        ];
        return view('home', $data);
    }
}
