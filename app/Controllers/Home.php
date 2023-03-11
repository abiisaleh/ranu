<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\JenisModel;
use App\Models\produkModel;

class Home extends BaseController
{
    protected $kriteriaModel;
    protected $jenisModel;
    protected $produkModel;

    public function __construct()
    {
        $this->kriteriaModel = new KriteriaModel();
        $this->jenisModel = new JenisModel();
        $this->produkModel = new produkModel();
    }

    public function index()
    {
        $data = [
            'kriteria' => $this->kriteriaModel->findAll(),
            'jenis' => $this->jenisModel->findAll(),
            'produk' => $this->produkModel->join('jenis', 'fkJenis = jenis.id')->select('produk.id as id,merek,model,harga,jenis.nama as jenis')->findAll(),
        ];

        return view('pages/user/index', $data);
    }
}
