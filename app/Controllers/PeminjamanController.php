<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PeminjamanController extends BaseController
{
    public function index()
    {
        $peminjamanModel = new \App\Models\PeminjamanModel();
        // Since we need aktif, terlambat, riwayat
        $semua = $peminjamanModel->getAllPeminjaman();
        
        $aktif = array_filter($semua, fn($p) => $p['status'] === 'Aktif' && strtotime($p['tgl_kembali']) >= strtotime('today'));
        $terlambat = array_filter($semua, fn($p) => $p['status'] === 'Aktif' && strtotime($p['tgl_kembali']) < strtotime('today'));
        $riwayat = array_filter($semua, fn($p) => $p['status'] === 'Dikembalikan');
        
        $bukuModel = new \App\Models\BukuModel();
        $anggotaModel = new \App\Models\AnggotaModel();

        $data = [
            'aktif' => array_values($aktif),
            'terlambat' => array_values($terlambat),
            'riwayat' => array_values($riwayat),
            'buku_tersedia' => $bukuModel->getBukuTersedia(),
            'anggota' => $anggotaModel->findAll(),
        ];
        return view('peminjaman', $data);
    }

    public function store()
    {
        $peminjamanModel = new \App\Models\PeminjamanModel();
        $peminjamanModel->insert([
            'anggota_id' => $this->request->getPost('anggota_id'),
            'buku_id' => $this->request->getPost('buku_id'),
            'user_id' => session()->get('user_id'), // catat ID petugas yang sedang login
            'tgl_pinjam' => $this->request->getPost('tgl_pinjam'),
            'tgl_kembali' => $this->request->getPost('tgl_kembali'),
            'keterangan' => $this->request->getPost('ket'),
            'status' => 'Aktif'
        ]);
        
        $bukuModel = new \App\Models\BukuModel();
        $bukuModel->update($this->request->getPost('buku_id'), ['status' => 'Dipinjam']);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function kembali()
    {
        $anggota_id = $this->request->getPost('anggota_id');
        $buku_id = $this->request->getPost('buku_id');
        
        $peminjamanModel = new \App\Models\PeminjamanModel();
        $record = $peminjamanModel->where('anggota_id', $anggota_id)->where('buku_id', $buku_id)->where('status', 'Aktif')->first();
        
        if ($record) {
            $peminjamanModel->update($record['id'], [
                'status' => 'Dikembalikan',
                'tgl_dikembalikan' => date('Y-m-d')
            ]);
            
            $bukuModel = new \App\Models\BukuModel();
            $bukuModel->update($buku_id, ['status' => 'Tersedia']);
        }
        
        return $this->response->setJSON(['status' => 'success']);
    }
}
