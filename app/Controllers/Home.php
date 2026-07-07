<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $bukuModel = new \App\Models\BukuModel();
        $peminjamanModel = new \App\Models\PeminjamanModel();
        $anggotaModel = new \App\Models\AnggotaModel();

        $totalKoleksi = $bukuModel->countAll();
        
        $semuaPinjam = $peminjamanModel->getAllPeminjaman();
        $sedangDipinjam = 0;
        $terlambat = 0;
        $aktifPeminjaman = [];
        $aktivitas = [];
        $anggota = [];

        foreach ($semuaPinjam as $p) {
            $anggota[$p['id_anggota']] = true;
            if ($p['status'] === 'Aktif') {
                $sedangDipinjam++;
                if (strtotime($p['tgl_kembali']) < strtotime('today')) {
                    $terlambat++;
                } else {
                    $aktifPeminjaman[] = $p;
                }
                $aktivitas[] = ['text' => "Peminjaman baru – {$p['buku']} oleh {$p['nama_peminjam']}", 'date' => $p['tgl_pinjam'], 'color' => 'amber'];
            } else {
                $aktivitas[] = ['text' => "Buku dikembalikan – {$p['buku']} oleh {$p['nama_peminjam']}", 'date' => $p['tgl_dikembalikan'] ?? $p['updated_at'], 'color' => 'green'];
            }
        }
        
        usort($aktivitas, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));
        $aktivitas = array_slice($aktivitas, 0, 5);

        $bukuData = $bukuModel->getAllBuku();
        $kategoriCount = [];
        foreach ($bukuData as $b) {
            $kategoriCount[$b['kategori']] = ($kategoriCount[$b['kategori']] ?? 0) + 1;
        }
        arsort($kategoriCount);

        $data = [
            'totalKoleksi' => $totalKoleksi,
            'sedangDipinjam' => $sedangDipinjam,
            'terlambat' => $terlambat,
            'totalAnggota' => $anggotaModel->countAll(),
            'aktifPeminjaman' => array_slice($aktifPeminjaman, 0, 5),
            'kategoriCount' => $kategoriCount,
            'aktivitas' => $aktivitas
        ];

        return view('dashboard', $data);
    }
}
