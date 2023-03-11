<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\JenisModel;
use App\Models\KriteriaModel;
use App\Models\fiturModel;

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
            'jenis' => $this->jenisModel->findAll(),
            'produk' => $this->produkModel->join('jenis','jenis.id = fkJenis')->select('*,produk.id as id,jenis.nama as jenis')->findAll(),
        ];

        return view('pages/admin/produk', $data);
    }

    public function form($jenis, $produk = null)
    {
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
            'title' => 'Form Produk '.$jenisNama,
            'jenisID' => $jenis,
            'kriteria' => $this->kriteriaModel->where('fkJenis',$jenis)->find(),
            'produk' => $produk,
            'fitur' => $fitur,
            'aksi' => $aksi
        ];

        return view('pages/admin/produkForm', $data);
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
        $kriteria = $this->kriteriaModel->where('fkJenis',$this->request->getPost('fkJenis'))->find();
        foreach ($kriteria as $Kriteria) {
            $this->fiturModel->insert([
                'nilai' => $this->request->getPost(strtolower(preg_replace('/\s+/','_',$Kriteria['nama']))),
                'fkProduk' => $this->produkModel->getInsertID(),
                'fkKriteria' => $Kriteria['id'],
            ]);
        }

        session()->setFlashData('success', 'data has been added to database.');
        return redirect()->to('admin/produk');
    }

    public function update()
    {
        $this->produkModel->save($this->request->getPost());
        //spesifikasi
        $kriteria = $this->kriteriaModel->where('fkJenis',$this->request->getPost('fkJenis'))->find();
        foreach ($kriteria as $Kriteria) {
            $i = -1;
            $i++;
            $this->fiturModel->save([
                'id' => $this->fiturModel->where('fkProduk',$this->request->getPost('id'))->where('fkKriteria',$Kriteria['id'])->find()[$i]['id'],
                'nilai' => $this->request->getPost(strtolower(preg_replace('/\s+/','_',$Kriteria['nama']))),
                'fkProduk' => $this->request->getPost('id'),
                'fkKriteria' => $Kriteria['id'],
            ]);
        }

        session()->setFlashData('success', 'data has been update to database.');
        return redirect()->to('admin/produk');
    }

    public function delete($id)
    {
        $this->produkModel->delete($id);
        session()->setFlashData('success', 'data has been deleted from database.');
        return redirect()->back();
    }
}
