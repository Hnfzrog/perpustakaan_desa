<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BukuController extends BaseController
{
    public function index()
    {
        $bukuModel = new \App\Models\BukuModel();
        $kategoriModel = new \App\Models\KategoriModel();

        $data['buku'] = $bukuModel->getAllBuku();
        $data['total'] = $bukuModel->countAll();
        $data['kategori'] = $kategoriModel->findAll();
        
        return view('buku', $data);
    }

    public function store()
    {
        $bukuModel = new \App\Models\BukuModel();
        $bukuModel->insert([
            'nomor_buku' => $this->request->getPost('nomor_buku'),
            'judul' => $this->request->getPost('judul'),
            'pengarang' => $this->request->getPost('pengarang'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'tahun' => $this->request->getPost('tahun'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status' => 'Tersedia'
        ]);
        return $this->response->setJSON(['status' => 'success']);
    }
}
