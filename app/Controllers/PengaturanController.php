<?php
namespace App\Controllers;
use App\Models\KategoriModel;
use App\Models\KodeModel;
use App\Models\AnggotaModel;

class PengaturanController extends BaseController
{
    public function kategori()
    {
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();
        return view('pengaturan_kategori', $data);
    }

    public function storeKategori()
    {
        $kategoriModel = new KategoriModel();
        $kategoriModel->insert([
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'kode_prefix' => $this->request->getPost('kode_prefix')
        ]);
        return redirect()->to('/pengaturan/kategori');
    }

    public function anggota()
    {
        $anggotaModel = new AnggotaModel();
        $data['anggota'] = $anggotaModel->findAll();
        return view('pengaturan_anggota', $data);
    }

    public function deleteAnggota()
    {
        $anggotaModel = new AnggotaModel();
        $id = $this->request->getPost('id');
        $anggotaModel->delete($id);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function updateAnggota()
    {
        $anggotaModel = new AnggotaModel();
        $id = $this->request->getPost('id');
        $anggotaModel->update($id, [
            'no_identitas' => $this->request->getPost('no_identitas'),
            'nama' => $this->request->getPost('nama')
        ]);
        return $this->response->setJSON(['status' => 'success']);
    }
}
