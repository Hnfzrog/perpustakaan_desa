<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class InitialData extends Seeder
{
    public function run()
    {
        // Users
        $this->db->table('users')->insertBatch([
            ['username' => 'pengelola', 'password' => password_hash('pengelola123', PASSWORD_DEFAULT), 'role' => 'pengelola'],
            ['username' => 'superadmin', 'password' => password_hash('admin123', PASSWORD_DEFAULT), 'role' => 'superadmin'],
        ]);

        $kategoriData = [
            ['nama_kategori' => 'Pertanian', 'kode_prefix' => 'PRT'],
            ['nama_kategori' => 'Sastra', 'kode_prefix' => 'STR'],
            ['nama_kategori' => 'Pendidikan', 'kode_prefix' => 'PDD'],
            ['nama_kategori' => 'Kesehatan', 'kode_prefix' => 'KSH'],
            ['nama_kategori' => 'Ekonomi', 'kode_prefix' => 'EKN'],
            ['nama_kategori' => 'Sejarah', 'kode_prefix' => 'SJR'],
            ['nama_kategori' => 'Kuliner', 'kode_prefix' => 'KLN'],
        ];
        $this->db->table('kategori')->insertBatch($kategoriData);

        // Anggota
        $anggotaList = [
            ['no_identitas' => '12345678', 'nama' => 'Pak Rudi', 'no_telp' => '0812345678', 'alamat' => 'Desa Sukamaju RT 1'],
            ['no_identitas' => '12345679', 'nama' => 'Ibu Yanti', 'no_telp' => '0812345679', 'alamat' => 'Desa Sukamaju RT 2'],
            ['no_identitas' => '12345680', 'nama' => 'Bu Lastri', 'no_telp' => '0812345680', 'alamat' => 'Desa Sukamaju RT 3'],
            ['no_identitas' => '12345681', 'nama' => 'Pak Harto', 'no_telp' => '0812345681', 'alamat' => 'Desa Sukamaju RT 4'],
            ['no_identitas' => '12345682', 'nama' => 'Siti', 'no_telp' => '0812345682', 'alamat' => 'Desa Sukamaju RT 5'],
            ['no_identitas' => '12345683', 'nama' => 'Budi', 'no_telp' => '0812345683', 'alamat' => 'Desa Sukamaju RT 6'],
            ['no_identitas' => '12345684', 'nama' => 'Pak Mono', 'no_telp' => '0812345684', 'alamat' => 'Desa Sukamaju RT 7'],
        ];
        $this->db->table('anggota')->insertBatch($anggotaList);

        // Buku
        $bukuData = [
            ['kategori_id' => 1, 'nomor_buku' => '059', 'judul' => 'Sistem Hidroponik Modern', 'pengarang' => 'Budi Santoso', 'tahun' => '2021', 'keterangan' => 'Donasi'],
            ['kategori_id' => 2, 'nomor_buku' => '001', 'judul' => 'Laskar Pelangi', 'pengarang' => 'Andrea Hirata', 'tahun' => '2005', 'keterangan' => 'Beli Baru'],
            ['kategori_id' => 3, 'nomor_buku' => '023', 'judul' => 'Belajar Membaca untuk Anak', 'pengarang' => 'Siti Aminah', 'tahun' => '2020', 'keterangan' => 'Donasi Desa'],
            ['kategori_id' => 4, 'nomor_buku' => '011', 'judul' => 'Gizi dan Kesehatan Balita', 'pengarang' => 'Dr. Ratna', 'tahun' => '2019', 'keterangan' => 'Puskesmas'],
            ['kategori_id' => 1, 'nomor_buku' => '060', 'judul' => 'Cara Sukses Beternak Lele', 'pengarang' => 'Agus P.', 'tahun' => '2022', 'keterangan' => 'Beli Baru'],
        ];
        $this->db->table('buku')->insertBatch($bukuData);

        // Peminjaman
        $peminjaman = [
            ['anggota_id'=>1, 'buku_id'=>2, 'user_id'=>1, 'tgl_pinjam'=>'2025-06-12', 'tgl_kembali'=>'2025-06-19', 'status'=>'Aktif'],
            ['anggota_id'=>2, 'buku_id'=>3, 'user_id'=>1, 'tgl_pinjam'=>'2025-06-15', 'tgl_kembali'=>'2025-06-22', 'status'=>'Aktif'],
            ['anggota_id'=>3, 'buku_id'=>4, 'user_id'=>1, 'tgl_pinjam'=>'2025-06-17', 'tgl_kembali'=>'2025-06-24', 'status'=>'Aktif'],
        ];
        $this->db->table('peminjaman')->insertBatch($peminjaman);
    }
}
