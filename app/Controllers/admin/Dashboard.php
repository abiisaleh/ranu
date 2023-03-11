<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'produk' => model('produkModel')->countAll(),
            // 'konsumen' => model('konsumenModel')->countAll(),
            // 'pesanan' => model('pesananModel')->countAll(),
            'konsumen' => number_format('109'),
            'pesanan' => number_format('1900'),
        ];
        return view('pages/admin/dashboard', $data);
    }
}
