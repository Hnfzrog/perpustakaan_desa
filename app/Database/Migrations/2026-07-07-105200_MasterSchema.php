<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MasterSchema extends Migration
{
    public function up()
    {
        $this->forge->dropTable('peminjaman', true);
        $this->forge->dropTable('buku', true);
        $this->forge->dropTable('anggota', true);
        $this->forge->dropTable('kategori', true);
        $this->forge->dropTable('kode', true);
        $this->forge->dropTable('users', true);
        
        // 1. USERS
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 50],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role' => ['type' => 'ENUM', 'constraint' => ['pengelola', 'superadmin'], 'default' => 'pengelola'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // 2. KATEGORI
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'nama_kategori' => ['type' => 'VARCHAR', 'constraint' => 100],
            'kode_prefix' => ['type' => 'VARCHAR', 'constraint' => 10],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kategori');

        // 3. ANGGOTA
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'no_identitas' => ['type' => 'VARCHAR', 'constraint' => 50],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'no_telp' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'alamat' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('anggota');

        // 4. BUKU
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'kategori_id' => ['type' => 'INT'],
            'nomor_buku' => ['type' => 'VARCHAR', 'constraint' => 50],
            'judul' => ['type' => 'VARCHAR', 'constraint' => 255],
            'pengarang' => ['type' => 'VARCHAR', 'constraint' => 150],
            'tahun' => ['type' => 'VARCHAR', 'constraint' => 4, 'null' => true],
            'keterangan' => ['type' => 'TEXT', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['Tersedia', 'Dipinjam', 'Hilang'], 'default' => 'Tersedia'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('buku');

        // 6. PEMINJAMAN
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'anggota_id' => ['type' => 'INT'], // foreign key to anggota
            'buku_id' => ['type' => 'INT'], // foreign key to buku
            'user_id' => ['type' => 'INT'], // foreign key to users (petugas)
            'tgl_pinjam' => ['type' => 'DATE'],
            'tgl_kembali' => ['type' => 'DATE'],
            'tgl_dikembalikan' => ['type' => 'DATE', 'null' => true],
            'keterangan' => ['type' => 'TEXT', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['Aktif', 'Dikembalikan', 'Terlambat'], 'default' => 'Aktif'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman', true);
        $this->forge->dropTable('buku', true);
        $this->forge->dropTable('anggota', true);
        $this->forge->dropTable('kategori', true);
        $this->forge->dropTable('kode', true);
        $this->forge->dropTable('users', true);
    }
}
