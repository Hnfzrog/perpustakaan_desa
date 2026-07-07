<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Koleksi Buku | Perpustakaan Desa Sukamaju</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/style.css" />
</head>
<body>
<div class="shell">

  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="brand-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
      </div>
      <div>
        <div class="brand-name">Perpustakaan</div>
        <div class="brand-sub">Desa Sukamaju</div>
      </div>
    </div>
    <nav class="sidebar-nav">
      <a href="/" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>
      <a href="/buku" class="nav-item active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
        Koleksi Buku
      </a>
      <a href="/peminjaman" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
        Peminjaman
      </a>
      <div class="nav-divider"></div>
      <?php if(session()->get('role') !== 'superadmin'): ?>
      <a href="/anggota" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        Data Anggota
      </a>
      <?php endif; ?>
      <?php if(session()->get('role') === 'superadmin'): ?>
        <div class="nav-divider"></div>
        <div style="padding: 0 16px; font-size: 11px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.5px;">Pengaturan</div>
        <a href="/pengaturan/kategori" class="nav-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
          Master Kategori
        </a>
        
        <a href="/pengaturan/anggota" class="nav-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          Kelola Anggota
        </a>
      <?php endif; ?>
    </nav>
    <div class="sidebar-footer">
      <div class="operator-wrap">
        <div class="op-avatar"><?= strtoupper(substr(session()->get('username'),0,2)) ?></div>
        <div>
          <div class="op-name"><?= session()->get('username') ?></div>
          <div class="op-role"><?= session()->get('role') ?></div>
        </div>
      </div>
      <a href="/logout" class="btn btn-secondary" style="display:flex;margin-top:16px;width:100%;justify-content:center;background:rgba(255,255,255,0.05);color:var(--red);border-color:rgba(255,255,255,0.1);">
  <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
  Logout
</a>
    </div>
  </aside>

  <div class="main">
    <header class="topbar">
      <div>
        <h1 class="page-title">Koleksi Buku</h1>
        <p class="page-sub"><?= esc($total) ?> judul tersedia di perpustakaan</p>
      </div>
      <button class="btn btn-primary" onclick="openModal()">+ Tambah Buku</button>
    </header>

    <div class="content">

      <!-- TOOLBAR -->
      <div class="toolbar">
        <input type="text" class="search-input" placeholder="Cari judul, pengarang, atau kategori..." id="searchInput" oninput="filterBuku()" />
        <div class="filter-group">
          <select class="select-filter" id="filterKat" onchange="filterBuku()">
            <option value="">Semua Kategori</option>
            <?php foreach($kategori as $k): ?>
              <option><?= $k['nama_kategori'] ?></option>
            <?php endforeach; ?>
          </select>
          <select class="select-filter" id="filterStatus" onchange="filterBuku()">
            <option value="">Semua Status</option>
            <option value="Tersedia">Tersedia</option>
            <option value="Dipinjam">Dipinjam</option>
          </select>
        </div>
      </div>

      <!-- TABLE -->
      <div class="card" style="overflow:hidden;">
        <div class="row"><div class="col-md-12">
<table class="table table-striped table-bordered" id="buku-table">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Judul Buku</th>
              <th>Pengarang</th>
              <th>Kategori</th>
              <th>Tahun</th>
              <th>Status</th>
              <th style="text-align:right;">Aksi</th>
            </tr>
          </thead>
          <tbody id="buku-tbody"></tbody>
        </table>
</div></div>
        <div class="table-footer" id="table-footer"></div>
      </div>

    </div>
  </div>
</div>

<!-- MODAL TAMBAH BUKU -->
<div class="modal-overlay" id="modal-overlay" onclick="closeModal()"></div>
<div class="modal-panel" id="modal-panel">
  <div class="modal-head">
    <div class="modal-title">Tambah Buku Baru</div>
    <button class="modal-close" onclick="closeModal()">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
  </div>
  <div class="modal-body">
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Kode Buku <span class="req">*</span></label>
        <div style="display:flex;gap:8px;">
          <input type="text" id="f-kode-prefix" class="form-input" style="width:60px;background:#f5f5f5;" readonly tabindex="-1" />
          <input type="text" id="f-nomor-buku" class="form-input" placeholder="001" style="flex:1;" />
        </div>
        <span class="err-msg" id="ferr-kode"></span>
      </div>
      <div class="form-group">
        <label class="form-label">Kategori <span class="req">*</span></label>
        <select id="f-kat" class="form-input form-select" onchange="syncKode()">
          <option value="">-- Pilih --</option>
          <?php foreach($kategori as $k): ?>
            <option value="<?= $k['id'] ?>"><?= $k['nama_kategori'] ?></option>
          <?php endforeach; ?>
        </select>
        <span class="err-msg" id="ferr-kat"></span>
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">Judul Buku <span class="req">*</span></label>
      <input type="text" id="f-judul" class="form-input" placeholder="Judul lengkap buku" />
      <span class="err-msg" id="ferr-judul"></span>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label class="form-label">Pengarang <span class="req">*</span></label>
        <input type="text" id="f-pengarang" class="form-input" placeholder="Nama pengarang" />
        <span class="err-msg" id="ferr-pengarang"></span>
      </div>
      <div class="form-group">
        <label class="form-label">Tahun Terbit</label>
        <input type="number" id="f-tahun" class="form-input" placeholder="2024" min="1900" max="2099" />
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">Keterangan</label>
      <textarea id="f-ket" class="form-input form-textarea" placeholder="Kondisi, sumber, atau catatan lain..."></textarea>
    </div>
  </div>
  <div class="modal-foot">
    <button class="btn btn-secondary" onclick="closeModal()">Batal</button>
    <button class="btn btn-primary" onclick="tambahBuku()">Simpan Buku</button>
  </div>
</div>

<div class="toast" id="toast">Buku berhasil ditambahkan!</div>

<?php
$katToKode = [];
foreach($kategori as $k) {
    $katToKode[$k['id']] = $k['kode_prefix'];
}
?>

<script>
const bukuData = <?= json_encode($buku ?? []) ?>;
const katToKode = <?= json_encode($katToKode) ?>;

function syncKode() {
    const katId = document.getElementById('f-kat').value;
    const kodeInput = document.getElementById('f-kode-prefix');
    if (katId && katToKode[katId]) {
        kodeInput.value = katToKode[katId] + '-';
    } else {
        kodeInput.value = '';
    }
}
</script>
<script src="/buku.js?v=<?= time() ?>"></script>
</body>
</html>
