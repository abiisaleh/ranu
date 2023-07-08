<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\JenisModel;
use App\Models\KriteriaModel;
use App\Models\FiturModel;

class Produk extends BaseController
{
    protected $produkModel;
    protected $jenisModel;
    protected $kriteriaModel;
    protected $fiturModel;

    public function __construct()
    {
        $this->produkModel = new produkModel();
        $this->jenisModel = new jenisModel();
        $this->kriteriaModel = new kriteriaModel();
        $this->fiturModel = new fiturModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Produk',
            'produk' => $this->produkModel->join('jenis', 'jenis.id = fkJenis')->select('*,produk.id as id,jenis.nama as jenis')->findAll(),
            'jenis' => $this->jenisModel->findAll(),
        ];

        return view('pages/admin/produk/index', $data);
    }

    public function form($jenis, $produk = null)
    {
        helper('form');
        $jenisNama = $this->jenisModel->find($jenis)['nama'];

        if (!$produk) {
            $fitur = null;
            $aksi = 'create';
        } else {
            $fitur = $this->produkModel->produkFitur($produk);
            $produk = $this->produkModel->find($produk);
            $aksi = 'update';
        }

        $data = [
            'title' => 'Form Produk ' . $jenisNama,
            'jenisID' => $jenis,
            'kriteria' => $this->kriteriaModel->where('fkJenis', $jenis)->find(),
            'produk' => $produk,
            'fitur' => $fitur,
            'aksi' => $aksi
        ];

        return view('pages/admin/produk/form', $data);
    }

    public function get_data()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'produk' => $this->produkModel->join('jenis', 'jenis.id = fkJenis')->select('*,produk.id as id,jenis.nama as jenis')->findAll(),
            ];

            $result = [
                'output' => view('pages/admin/produk/tabel', $data)
            ];
            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function create()
    {
        // validation
        $rules = $this->validate([
            'merek' => 'required',
            'model' => 'required',
            'harga' => 'required|numeric',
        ]);

        if (!$rules) {
            session()->setFlashData('failed', \Config\Services::validation()->getErrors());
            return redirect()->back();
        }

        $this->produkModel->save($this->request->getPost());
        //spesifikasi
        $kriteria = $this->kriteriaModel->where('fkJenis', $this->request->getPost('fkJenis'))->find();
        foreach ($kriteria as $Kriteria) {
            $this->fiturModel->insert([
                'nilai' => $this->request->getPost(strtolower(preg_replace('/\s+/', '_', $Kriteria['nama']))),
                'fkProduk' => $this->produkModel->getInsertID(),
                'fkKriteria' => $Kriteria['id'],
            ]);
        }

        $file = $this->request->getFile('gambar');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $this->request->getPost('model');
            $file->move('./uploads', $newName);
        }

        session()->setFlashData('success', 'data has been added to database.');
        return redirect()->to('admin/produk');
    }

    public function update()
    {
        $this->produkModel->save($this->request->getPost());
        //spesifikasi
        $kriteria = $this->kriteriaModel->where('fkJenis', $this->request->getPost('fkJenis'))->find();
        foreach ($kriteria as $Kriteria) {
            $i = -1;
            $i++;
            $this->fiturModel->save([
                'id' => $this->fiturModel->where('fkProduk', $this->request->getPost('id'))->where('fkKriteria', $Kriteria['id'])->find()[$i]['id'],
                'nilai' => $this->request->getPost(strtolower(preg_replace('/\s+/', '_', $Kriteria['nama']))),
                'fkProduk' => $this->request->getPost('id'),
                'fkKriteria' => $Kriteria['id'],
            ]);
        }

        $file = $this->request->getFile('gambar');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $this->request->getPost('model');
            $file->move('./uploads', $newName);
        }

        session()->setFlashData('success', 'data has been update to database.');
        return redirect()->to('admin/produk');
    }

    public function delete()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->getPost('id');
            $this->produkModel->delete($id);

            $result = [
                'output' => 'Data Berhasil Dihapus'
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }
}
