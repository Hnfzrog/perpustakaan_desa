<?php
namespace App\Models;
use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['kategori_id', 'nomor_buku', 'judul', 'pengarang', 'tahun', 'keterangan', 'status'];

    protected $useTimestamps = true;

    public function getAllBuku()
    {
        return $this->select('buku.*, kategori.nama_kategori as kategori, kategori.kode_prefix as kode')
                    ->join('kategori', 'kategori.id = buku.kategori_id')
                    ->findAll();
    }

    public function getBukuTersedia()
    {
        return $this->select('buku.*, kategori.nama_kategori as kategori, kategori.kode_prefix as kode')
                    ->join('kategori', 'kategori.id = buku.kategori_id')
                    ->where('buku.status', 'Tersedia')
                    ->findAll();
    }
}
