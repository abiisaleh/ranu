<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;

class Laporan extends BaseController
{
    protected $pesananModel;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Produk',
            'pesanan' => $this->pesananModel->joinKonsumenProduk()->findAll()
        ];

        return view('pages/admin/laporan', $data);
    }
}
