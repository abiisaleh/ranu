<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'produk' => model('ProdukModel')->countAll(),
            'konsumen' => model('KonsumenModel')->countAll(),
            'pesanan' => model('PesananModel')->countAll(),
        ];
        return view('pages/admin/index', $data);
    }
}
