<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\SubkriteriaModel;
use App\Models\JenisModel;
use App\Models\ProdukModel;
use App\Models\KonsumenModel;
use App\Models\PesananModel;

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
            'produk' => $this->produkModel->join('jenis', 'fkJenis = jenis.id')->select('produk.*, jenis.nama as nama')->find($id),
            'fitur' => $this->produkModel->join('fitur', 'fkProduk = produk.id')->join('kriteria', 'fkKriteria = kriteria.id')->where('fkProduk', $id)->find(),
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
        $konsumen = $this->request->getVar();
        $this->konsumenModel->insert($konsumen);

        $pesanan = [
            'status' => 'pending',
            'fkProduk' => $this->request->getVar('fkProduk'),
            'fkKonsumen' => $this->konsumenModel->insertID(),
        ];
        $this->pesananModel->insert($pesanan);
        $id = $this->pesananModel->getInsertID();

        return redirect()->to('pembayaran/' . $id);
    }

    public function pembayaran($id)
    {
        helper('form');
        $data['idPesanan'] = $id;
        $data['total'] = $this->pesananModel->join('produk', 'fkProduk = produk.id')->find($id)['harga'];
        return view('pages/user/pembayaran', $data);
    }

    public function upload($id)
    {
        $file = $this->request->getFile('gambar');

        $file->move(FCPATH . 'uploads', $id . '-nota.jpg', true);

        return json_encode(['status' => 'success']);
    }

    public function smart()
    {
        //data alternatif
        $inputJenis = $this->request->getVar('jenis'); //jenis produk
        $kriteria = $this->kriteriaModel->where('fkJenis', $inputJenis)->find(); //kriteria

        $db = \Config\Database::connect();
        $select = ['id', 'model'];
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
                if ($Kriteria['nama'] == 'Harga' or $Kriteria['nama'] == 'Kapasitas') {
                    $inputHarga = str_replace('.', '', $input);
                    $harga_min = explode('-', $inputHarga)[0];
                    $harga_max = explode('-', $inputHarga)[1];
                    $query->where("(SELECT COUNT(*) FROM fitur WHERE fkProduk = produk.id AND fkKriteria = $id AND nilai > $harga_min AND nilai < $harga_max)");
                } else {
                    $query->where("(SELECT COUNT(*) FROM fitur WHERE fkProduk = produk.id AND fkKriteria = $id AND nilai = '$input')");
                }
            }
        }
        $result = $query->get()->getResultArray();

        //kalau data tidak ditemukan skip perhitungan
        if (empty($result)) {
            echo 'data tidak ditemukan';
            return $this;
        }


        //Tahap 1 : Kriteria yang digunakan
        $data['kriteria'] = $kriteria;

        //Tahap 2 : Bobot Kriteria & Normalisasi
        $total = 0;
        foreach ($kriteria as $Kriteria) {
            $total += $Kriteria['bobot'];
        }

        foreach ($kriteria as &$Kriteria) {
            $Kriteria['normalisasi'] = $Kriteria['bobot'] / $total;
        }
        $data['kriteria'] = $kriteria; //perbarui data kriteria

        //Tahap 3 : Utility
        $data['alternatif'] = $result; //data alternatif

        $subkriteria = $this->subkriteriaModel->join('kriteria', 'fkKriteria = kriteria.id')->where('fkJenis', $inputJenis)->groupBy('fkKriteria')->find(); //data konfersi

        foreach ($subkriteria as $Subkriteria) {
            $s[] = $Subkriteria['nama'];
        }

        foreach ($result as &$Result) {
            $Result[''] = '';
        }

        //cari nilai min & max
        foreach ($kriteria as $Kriteria) {
            $kualitatif = ['Fungsi', 'Ukuran', 'Merek', 'JenisKulkas', 'Tenaga'];
            $nilai = [];
            foreach ($result as $Result) {
                if (!in_array($Kriteria['nama'], $kualitatif)) {
                    $nilai[] = $Result[$Kriteria['nama']];
                } else {
                    $konversi = $this->subkriteriaModel->join('kriteria', 'fkKriteria = kriteria.id')->where('fkJenis', $inputJenis)->where('subkriteria.nama', $Result[$Kriteria['nama']])->find();
                    $nilai[] = intval($konversi[0]['nilai']);
                }
            }

            $Cmax = max($nilai);
            $Cmin = min($nilai);

            foreach ($result as &$Result) {
                if (!in_array($Kriteria['nama'], $kualitatif)) {
                    $Cout = $Result[$Kriteria['nama']];
                } else {
                    $konversii = $this->subkriteriaModel->join('kriteria', 'fkKriteria = kriteria.id')->where('fkJenis', $inputJenis)->where('subkriteria.nama', $Result[$Kriteria['nama']])->find();
                    $Cout = intval($konversii[0]['nilai']);
                }

                if ($Cmax - $Cmin == 0) {
                    $utility = 0;
                } else {
                    if ($Kriteria['utility'] = "lebih kecil lebih baik") {
                        $utility = ($Cmax - $Cout) / ($Cmax - $Cmin);
                    } else {
                        $utility = ($Cout - $Cmin) / ($Cmax - $Cmin);
                    }
                }
                $Result['utility_' . $Kriteria['nama']] = $utility;
            }
        }

        $data['utility'] = $result; //hasil utility

        //Tahap 4 : Nilai Akhir
        foreach ($result as &$Result) {
            //nilaiAkhir = sum(bobot * normlisasi * utility) 
            $nilaiAkhir = 0;
            foreach ($kriteria as $Kriteria) {
                // if (!in_array($Kriteria['nama'], $kualitatif)) {
                $nilaiAkhir = $nilaiAkhir + ($Kriteria['bobot'] * $Kriteria['normalisasi'] * $Result['utility_' . $Kriteria['nama']]);
                // }
            }
            $Result['nilai_akhir'] = $nilaiAkhir;
        }

        $data['nilaiAkhir'] = $result; //nilai akhir

        usort($result, function ($a, $b) {
            return $b['nilai_akhir'] * 100 - $a['nilai_akhir'] * 100;
        });

        $data['nilaiAkhirSort'] = $result; //nilai akhir urutkan terbesar
        $data['hasil'] = $result[0]; //nilai akhir terbesar

        $data['Produk'] = $this->produkModel->join('jenis', 'fkJenis = jenis.id')->select('produk.id as id,merek,model,harga,jenis.nama as jenis')->find($data['hasil']['id']);

        return view('pages/user/rekomendasi', $data);
    }
}
