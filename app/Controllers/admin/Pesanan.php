<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;;

class Pesanan extends BaseController
{
    protected $pesananModel;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pesanan',
        ];
        return view('pages/admin/pesanan/index', $data);
    }

    public function get_data()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'pesanan' => $this->pesananModel->joinKonsumenProduk()->find(),
            ];

            $result = [
                'output' => view('pages/admin/pesanan/tabel', $data)
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $this->kriteriaModel->delete($id);
        } else {
            exit('404 Not Found');
        }
    }

    public function invoice()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->getVar('id');
            $data = [
                'pesanan' => $this->pesananModel->joinKonsumenProduk()->find($id)
            ];

            $result = [
                'output' => view('pages/admin/pesanan/invoice', $data)
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function verifikasi()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->getVar('id');
            $status = $this->request->getVar('status');
            $data = [
                'id' => $id,
                'status' => $status
            ];
            $this->pesananModel->save($data);
        } else {
            exit('404 Not Found');
        }
    }
}
