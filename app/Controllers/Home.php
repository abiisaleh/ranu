<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\SubkriteriaModel;
use App\Models\JenisModel;
use App\Models\produkModel;
use App\Models\konsumenModel;
use App\Models\pesananModel;

class Home extends BaseController
{
    protected $kriteriaModel;
    protected $subkriteriaModel;
    protected $jenisModel;
    protected $produkModel;
    protected $konsumenModel;
    protected $pesananModel;

    public function __construct()
    {
        $this->kriteriaModel = new KriteriaModel();
        $this->subkriteriaModel = new SubkriteriaModel();
        $this->jenisModel = new JenisModel();
        $this->produkModel = new produkModel();
        $this->konsumenModel = new konsumenModel();
        $this->pesananModel = new pesananModel();
    }

    public function index()
    {
        helper('form');
        $data = [
            'kriteria' => $this->kriteriaModel->findAll(),
            'jenis' => $this->jenisModel->findAll(),
            'produk' => $this->produkModel->join('jenis', 'fkJenis = jenis.id')->orderBy('RAND()')->select('produk.id as id,merek,model,harga,jenis.nama as jenis')->limit(9)->find(),
        ];

        return view('pages/user/index', $data);
    }

    public function produk($id)
    {
        helper('form');

        $data = [
            'produk' => $this->produkModel->find($id),
        ];

        return view('pages/user/produkDetail', $data);
    }

    public function get_data()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->getVar('id');
            $data = [
                'kriteria' => $this->kriteriaModel->where('fkJenis', $id)->find(),
            ];

            $result = [
                'output' => view('pages/user/inputKriteria', $data)
            ];

            echo json_encode($result);
        } else {
            View('404 error');
        };
    }

    public function pesan()
    {
        if ($this->request->isAjax()) {
            $konsumen = $this->request->getVar();
            $this->konsumenModel->insert($konsumen);

            $pesanan = [
                'status' => 'pending',
                'fkProduk' => $this->request->getVar('fkProduk'),
                'fkKonsumen' => $this->konsumenModel->insertID(),
            ];
            $this->pesananModel->insert($pesanan);

            $result = [
                'success' => 'Pesanan Berhasil Dibuat. Kami akan memverifikasi pesanan anda'
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function smart()
    {
        //jenis produk
        $dataJenis = $this->request->getVar('jenis');
        $kriteria = $this->kriteriaModel->where('fkJenis',$dataJenis)->find();
        d($kriteria);

        //ambil data alternatif
        $model = $this->produkModel;
        $data = $model->join('fitur', 'fkProduk = produk.id')->groupBy('model');
        
        //ambil pilihan subkriteria
        // $dataKriteria = [];
        foreach ($kriteria as $Kriteria) {
            $input = $this->request->getVar($Kriteria['nama']);
            if ($input != "-" ) {
                if($input) {
                    // $dataKriteria[$Kriteria['nama']] = $this->request->getVar($Kriteria['nama']);
                    $data->where('nilai',$input);
                    $data->where('fkKriteria',$Kriteria['id']);
                    // $dataKriteria[] = $this->request->getVar($Kriteria['nama']);
                }
            }
        }
        $data->find();

        //perhitungan smart
        //Tahap 1 : Kriteria yang digunakan
        d($data->find());
        //Tahap 2 : Bobot Kriteria & Normalisasi
        //Tahap 3 : Utility
        //Tahap 4 : Nilai Akhir
    }

    
}
