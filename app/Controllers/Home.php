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
        //data alternatif
        $inputJenis = $this->request->getVar('jenis'); //jenis produk
        $kriteria = $this->kriteriaModel->where('fkJenis',$inputJenis)->find(); //kriteria

        $db = \Config\Database::connect();
        $select = ['id','model'];
        foreach ($kriteria as $Kriteria) {
            $nama = $Kriteria['nama'];
            $id = $Kriteria['id'];
            $select[] = "(SELECT nilai FROM fitur WHERE fkProduk = produk.id AND fkKriteria = $id) AS $nama";
        }
        $query = $db->table('produk')->select($select);
        foreach ($kriteria as $Kriteria) {
            $input = $this->request->getVar($Kriteria['nama']);
            if ($input != "-") {
                $id = $Kriteria['id'];
                if ($Kriteria['nama'] == 'Harga' OR $Kriteria['nama'] == 'Kapasitas') {
                    $inputHarga = str_replace('.', '', $input);
                    $query->where("(SELECT COUNT(*) FROM fitur WHERE fkProduk = produk.id AND fkKriteria = $id AND nilai $inputHarga)");
                } else {
                    $query->where("(SELECT COUNT(*) FROM fitur WHERE fkProduk = produk.id AND fkKriteria = $id AND nilai = '$input')");
                }
            }
        }
        $result = $query->get()->getResultArray();

        //Tahap 1 : Kriteria yang digunakan
        $data['kriteria'] = $kriteria;
        //Tahap 2 : Bobot Kriteria & Normalisasi
        //Tahap 3 : Utility
        $data['alternatif'] = $result; //data alternatif
                                       //data konfersi

        //cari nilai min & max
        foreach ($kriteria as $Kriteria) { 
            $kualitatif = ["Fungsi","Ukuran","Merek"];
            if (!in_array($Kriteria['nama'],$kualitatif)) {
                $nilai = [];
                foreach ($result as $Result) {
                    $nilai[] = $Result[$Kriteria['nama']];
                    $nilai[] = $Result[$Kriteria['nama']]; //otomatis
                }
                $Cmax = max($nilai);
                $Cmin = min($nilai);
                
                foreach ($result as &$Result) {
                    $Cout = $Result[$Kriteria['nama']];
                    if ($Cmax - $Cmin == 0) {
                        $utility = 0;
                    } else {
                        if ($Kriteria['utility'] = "lebih kecil lebih baik") {   
                            $utility = ($Cmax - $Cout) / ($Cmax - $Cmin);
                        } else {
                            $utility = ($Cout - $Cmin) / ($Cmax - $Cmin);
                        }
                    }
                    $Result['utility_'.$Kriteria['nama']] = $utility;
                }
            }
        }
                    
        $data['utility'] = $result; //hasil utility

        //Tahap 4 : Nilai Akhir
        foreach ($result as &$Result) {
            //nilaiAkhir = sum(bobot * normlisasi * utility) 
            $nilaiAkhir = 0;
            foreach ($kriteria as $Kriteria) {
                if (!in_array($Kriteria['nama'],$kualitatif)) {
                    $nilaiAkhir = $nilaiAkhir + $Result['utility_'.$Kriteria['nama']];
                }
            }
            $Result['nilai_akhir'] = $nilaiAkhir;
        }

        $data['nilaiAkhir'] = $result; //nilai akhir

        usort($result, function($a, $b) {
            return $b['nilai_akhir']*100 - $a['nilai_akhir']*100;
        });
        
        $data['nilaiAkhirSort'] = $result; //nilai akhir urutkan terbesar
        $data['hasil'] = $result[0]; //nilai akhir terbesar

        return view('pages/user/rekomendasi',$data);
    }
}
