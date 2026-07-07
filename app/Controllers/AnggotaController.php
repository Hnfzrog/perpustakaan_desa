<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class AnggotaController extends BaseController
{
    public function index()
    {
        $anggotaModel = new AnggotaModel();
        $data['anggota'] = $anggotaModel->findAll();
        $data['total'] = count($data['anggota']);
        return view('anggota', $data);
    }

    public function store()
    {
        $anggotaModel = new AnggotaModel();
        $anggotaModel->insert([
            'no_identitas' => $this->request->getPost('no_identitas'),
            'nama' => $this->request->getPost('nama'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat')
        ]);
        return $this->response->setJSON(['status' => 'success']);
    }
}
