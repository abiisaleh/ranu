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
            'konsumen' => model('konsumenModel')->countAll(),
            'pesanan' => model('pesananModel')->countAll(),
        ];
        return view('pages/admin/index', $data);
    }
}
