<?php
namespace App\Models;
use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['anggota_id', 'buku_id', 'user_id', 'tgl_pinjam', 'tgl_kembali', 'tgl_dikembalikan', 'keterangan', 'status'];

    protected $useTimestamps = true;

    public function getAllPeminjaman()
    {
        return $this->select('peminjaman.*, anggota.nama as nama_peminjam, anggota.no_identitas as id_anggota, buku.judul as buku, users.username as nama_petugas')
                    ->join('anggota', 'anggota.id = peminjaman.anggota_id')
                    ->join('buku', 'buku.id = peminjaman.buku_id')
                    ->join('users', 'users.id = peminjaman.user_id', 'left')
                    ->findAll();
    }
}
