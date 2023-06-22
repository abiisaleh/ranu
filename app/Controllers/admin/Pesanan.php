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
            $this->pesananModel->delete($id);
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
                'status' => $status,
                'tanggal_diproses' => date('Y-m-d H:i:s')
            ];
            $this->pesananModel->save($data);
        } else {
            exit('404 Not Found');
        }

        $pesanan = $this->pesananModel->joinKonsumenProduk()->find($id);

        // URL endpoint
        $url = 'https://web-production-d03d.up.railway.app/message/text?key=123';

        // Data yang akan dikirim sebagai body request
        $data = [
            'id' => $pesanan['telp'],
            'message' => 'Pesanan #' . $pesanan['id'] . ' dengan total Rp. ' . number_format($pesanan['harga']) . ' sudah di verifikasi dan akan dikirim ke alamat ' . $pesanan['alamat'],
        ];

        // Inisialisasi cURL
        $ch = curl_init();

        // Set URL
        curl_setopt($ch, CURLOPT_URL, $url);

        // Set metode request menjadi POST
        curl_setopt($ch, CURLOPT_POST, 1);

        // Set data yang akan dikirim sebagai body request
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        // Jalankan request dan ambil responsenya
        $response = curl_exec($ch);

        // Tutup koneksi cURL
        curl_close($ch);

        // Tampilkan responsenya
        echo $response;
    }

    public function upload()
    {
        $id = $this->request->getPost('id');
        $file = $this->request->getFile('gambar');

        $file->move(FCPATH . 'uploads', $id . '-kirim.jpg', true);

        //ubah status
        $data = [
            'id' => $id,
            'status' => 'selesai',
            'tanggal_pengiriman' => date('Y-m-d')
        ];
        $this->pesananModel->save($data);

        return redirect()->back();
    }
}
