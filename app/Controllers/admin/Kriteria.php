<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JenisModel;
use App\Models\KriteriaModel;

class Kriteria extends BaseController
{
    protected $jenisModel;
    protected $kriteriaModel;

    public function __construct()
    {
        $this->jenisModel = new JenisModel();
        $this->kriteriaModel = new KriteriaModel();
    }

    public function index()
    {
        helper('form');
        $data = [
            'title' => 'Kriteria',
            'jenis' => $this->jenisModel->findAll(),
            'kriteria' => $this->kriteriaModel,
        ];
        return view('pages/admin/kriteria', $data);
    }

    public function get_data()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data = [
                'Jenis' => $this->jenisModel->find($id),
                'kriteria' => $this->kriteriaModel
            ];

            $result = [
                'output' => view('pages/admin/tabelKriteria', $data)
            ];
            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function create()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->getVar();
            $this->kriteriaModel->insert($data);
        } else {
            exit('404 Not Found');
        }
    }

    public function delete()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->getVar('id');
            $this->kriteriaModel->delete($id);
        } else {
            exit('404 Not Found');
        }
    }
}
