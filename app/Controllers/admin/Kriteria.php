<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JenisModel;
use App\Models\KriteriaModel;
use App\Models\SubkriteriaModel;

class Kriteria extends BaseController
{
    protected $jenisModel;
    protected $kriteriaModel;
    protected $subkriteriaModel;

    public function __construct()
    {
        $this->jenisModel = new JenisModel();
        $this->kriteriaModel = new KriteriaModel();
        $this->subkriteriaModel = new SubkriteriaModel();
    }

    public function index()
    {
        helper('form');
        $data = [
            'title' => 'Kriteria',
            'jenis' => $this->jenisModel->findAll(),
        ];
        return view('pages/admin/kriteria/index', $data);
    }

    public function get_data()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $data = [
                'Jenis' => $this->jenisModel->find($id),
                'kriteria' => $this->kriteriaModel->where('fkjenis', $id)->find(),
                'subkriteria' => $this->subkriteriaModel,
            ];

            $result = [
                'output' => view('pages/admin/kriteria/tabel', $data)
            ];
            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function create()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->getPost();
            $this->kriteriaModel->save($data);

            $result = [
                'success' => 'Data has been added to database'
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function edit()
    {
        helper('form');

        $id = $this->request->getPost('id');
        $data = [
            'kriteria' => $this->kriteriaModel->find($id)
        ];

        $result = [
            'output' => view('pages/admin/kriteria/modal-edit', $data),
        ];

        echo json_encode($result);
    }

    public function delete()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->getPost('id');
            $this->kriteriaModel->delete($id);

            $result = [
                'output' => "Data has been deleted from database",
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function subkriteria($id)
    {
        helper('form');
        $data = [
            'title' => 'subkriteria',
            'jenis' => $this->jenisModel->find($id)['nama'],
            'kriteria' => $this->kriteriaModel->where('fkJenis', $id)->find()
        ];

        return view('pages/admin/kriteria/subkriteria/index', $data);
    }

    public function get_subkriteria()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getGet('id');

            $data = [
                'kriteria' => $this->kriteriaModel->find($id),
                'subkriteria' => $this->subkriteriaModel->where('fkKriteria', $id)->find()
            ];

            $result = [
                'output' => view('pages/admin/kriteria/subkriteria/tabel', $data)
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function create_subkriteria()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $rules = $this->validate([
                'nama' => [
                    'label' => 'subkriteria',
                    'rules' => 'required',
                ],
                'nilai' => [
                    'label' => 'nilai',
                    'rules' => 'required|numeric',
                ],
            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'nilai' => $validation->getError('nilai'),
                    ]
                ];
            } else {
                $data = $this->request->getPost();
                $this->subkriteriaModel->save($data);

                $result = [
                    'success' => 'Data has been added to database'
                ];
            }
            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function get_modalEdit()
    {
        helper('form');

        $id = $this->request->getGet('id');
        $data = [
            'subkriteria' => $this->subkriteriaModel->find($id)
        ];

        $result = [
            'output' => view('pages/admin/kriteria/subkriteria/modal-edit', $data),
        ];

        echo json_encode($result);
    }

    public function update_subkriteria()
    {
        if ($this->request->isAjax()) {

            helper('form');
            $data = $this->request->getPost();
            $this->subkriteriaModel->save($data);

            $result = [
                'success' => "Data has been updated from database"
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function delete_subkriteria()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->getPost('id');
            $this->subkriteriaModel->delete($id);

            $result = [
                'output' => "Data has been deleted from database"
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }
}
