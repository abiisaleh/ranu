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

    public function produk($id = null)
    {
        helper('form');

        if (is_null($id)) {
            $data = [
                'kriteria' => $this->kriteriaModel->findAll(),
                'jenis' => $this->jenisModel->findAll(),
                'produk' => $this->produkModel->join('jenis', 'fkJenis = jenis.id')->orderBy('RAND()')->select('produk.id as id,merek,model,harga,jenis.nama as jenis')->limit(9)->find(),
            ];

            return view('pages/user/produk', $data);
        }

        $data = [
            'produk' => $this->produkModel->join('jenis', 'fkJenis = jenis.id')->select('produk.*, jenis.nama as nama')->find($id),
            'fitur' => $this->produkModel->join('fitur', 'fkProduk = produk.id')->join('kriteria', 'fkKriteria = kriteria.id')->where('fkProduk', $id)->find(),
        ];

        return view('pages/user/produkDetail', $data);
    }

    public function get_data()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->getGet('id');
            $data = [
                'kriteria' => $this->kriteriaModel->where('fkJenis', $id)->find(),
                'idJenis' => $id
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
        $konsumen = $this->request->getPost();
        $this->konsumenModel->insert($konsumen);
        $idProduk = $this->request->getPost('fkProduk');

        $pesanan = [
            'status' => 'pending',
            'fkProduk' => $idProduk,
            'fkKonsumen' => $this->konsumenModel->insertID(),
        ];
        $this->pesananModel->insert($pesanan);

        //kurangi stok produk 
        $produk = $this->produkModel->find($idProduk);

        $stok = [
            'id' => intval($idProduk),
            'stok' => $produk['stok'] - 1,
        ];

        $this->produkModel->save($stok);

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
        $inputJenis = $this->request->getPost('jenis'); //jenis produk
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
            $input = $this->request->getPost($Kriteria['nama']);
            if ($input != "-") {
                $id = $Kriteria['id'];
                if ($Kriteria['nama'] == 'Harga' or $Kriteria['nama'] == 'Kapasitas' or $Kriteria['nama'] == 'DayaListrik') {
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
            $data['normalisasi'][] = $Kriteria['bobot'] / $total;
            $Kriteria['normalisasi'] = $Kriteria['bobot'] / $total;
        }
        $normalisasi = $kriteria;
        $data['kriteria'] = $normalisasi; //perbarui data kriteria

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
        foreach ($kriteria as $Kriterias) {
            $kualitatif = ['Fungsi', 'Ukuran', 'Merek', 'JenisKulkas', 'Tenaga'];
            $nilai = [];

            $namakriteria = $Kriterias['nama'];
            
            foreach ($result as $Result) {
                if (!in_array($namakriteria, $kualitatif)) {
                    $nilai[] = $Result[$namakriteria];
                } else {
                    $konversi = $this->subkriteriaModel->join('kriteria', 'fkKriteria = kriteria.id')->where('fkJenis', $inputJenis)->where('subkriteria.nama', $Result[$namakriteria])->find();
                    $nilai[] = intval($konversi[0]['nilai']);
                }
            }

            $Cmax = max($nilai);
            $Cmin = min($nilai);

            foreach ($result as &$Result) {
                if (!in_array($Kriterias['nama'], $kualitatif)) {
                    $Cout = $Result[$Kriterias['nama']];
                } else {
                    $konversii = $this->subkriteriaModel->join('kriteria', 'fkKriteria = kriteria.id')->where('fkJenis', $inputJenis)->where('subkriteria.nama', $Result[$Kriterias['nama']])->find();
                    $Cout = intval($konversii[0]['nilai']);
                }

                if ($Cmax - $Cmin == 0) {
                    $utility = 0;
                } else {
                    if ($Kriterias['utility'] == "lebih kecil lebih baik") {
                        $utility = ($Cmax - $Cout) / ($Cmax - $Cmin);
                    } else {
                        $utility = ($Cout - $Cmin) / ($Cmax - $Cmin);
                    }
                }
                $Result['utility_' . $Kriterias['nama']] = $utility;
            }
        }

        $data['utility'] = $result; //hasil utility
        //Tahap 4 : Nilai Akhir
        foreach ($result as &$Result) {
            //nilaiAkhir = sum(bobot * normlisasi * utility) 
            $nilaiAkhir = 0;
            foreach ($kriteria as $Kriteria2) {
                // if (!in_array($Kriteria2['nama'], $kualitatif)) {
                $nilaiAkhir = $nilaiAkhir + ($Kriteria2['normalisasi'] * $Result['utility_' . $Kriteria2['nama']]);
                // }
            }
            $Result['nilai_akhir'] = $nilaiAkhir;
        }

        $data['nilaiAkhir'] = $result; //nilai akhir

        usort($result, function ($a, $b) {
            return $b['nilai_akhir'] * 1000 - $a['nilai_akhir'] * 1000;
        });

        $data['nilaiAkhirSort'] = $result; //nilai akhir urutkan terbesar

        $resultMax = $result[0];

        foreach ($result as $Result) {
            if ($Result == $resultMax) {
                $data['hasil'][] = $Result;
                $data['Produk'][0] = $this->produkModel->join('jenis', 'fkJenis = jenis.id')->select('produk.id as id,merek,model,harga,jenis.nama as jenis')->find($Result['id']);
            }
        }
        //$data['hasil'] = $result[0]; //nilai akhir terbesar

        return view('pages/user/rekomendasi', $data);
    }
}
