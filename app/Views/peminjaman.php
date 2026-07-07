<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Peminjaman | Perpustakaan Desa Sukamaju</title>
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
      <a href="/buku" class="nav-item">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
        Koleksi Buku
      </a>
      <a href="/peminjaman" class="nav-item active">
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
        <h1 class="page-title">Peminjaman</h1>
        <p class="page-sub">Catat peminjaman dan pengembalian buku</p>
      </div>
      <button class="btn btn-primary" onclick="showTab('pinjam')">+ Catat Peminjaman</button>
    </header>

    <div class="content">

      <!-- TABS -->
      <div class="tab-bar">
        <button class="tab-btn active" id="tab-pinjam" onclick="showTab('pinjam')">Catat Peminjaman</button>
        <button class="tab-btn" id="tab-aktif" onclick="showTab('aktif')">Sedang Dipinjam <span class="tab-badge"><?= count($aktif) ?></span></button>
        <button class="tab-btn" id="tab-terlambat" onclick="showTab('terlambat')">Terlambat <span class="tab-badge red"><?= count($terlambat) ?></span></button>
        <button class="tab-btn" id="tab-riwayat" onclick="showTab('riwayat')">Riwayat</button>
      </div>

      <!-- FORM PINJAM -->
      <div class="tab-content active" id="tc-pinjam">
        <div class="form-card">
          <div class="form-card-head">Formulir Peminjaman Buku</div>
          <div class="form-card-body">
            <div class="form-row">
      <div class="form-group">
        <label class="form-label">Nama Peminjam <span class="req">*</span></label>
        <select id="f-nama" class="form-input form-select">
          <option value="">-- Pilih Anggota --</option>
          <?php foreach($anggota as $a): ?>
            <option value="<?= $a['id'] ?>"><?= $a['nama'] ?> (<?= $a['no_identitas'] ?>)</option>
          <?php endforeach; ?>
        </select>
        <span class="err-msg" id="ferr-nama"></span>
      </div>
      <div class="form-group">
        <label class="form-label">Buku yang Dipinjam <span class="req">*</span></label>
        <select id="f-buku" class="form-input form-select">
          <option value="">-- Pilih Buku --</option>
          <?php foreach($buku_tersedia as $b): ?>
            <option value="<?= $b['id'] ?>"><?= $b['kode'] ?> - <?= $b['judul'] ?></option>
          <?php endforeach; ?>
        </select>
        <span class="err-msg" id="ferr-buku"></span>
      </div>
    </div>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" id="p-tglpinjam" class="form-input" />
              </div>
              <div class="form-group">
                <label class="form-label">Tanggal Kembali (maks. 7 hari) <span class="req">*</span></label>
                <input type="date" id="p-tglkembali" class="form-input" />
                <span class="err-msg" id="perr-tglkembali"></span>
              </div>
              <div class="form-group">
                <label class="form-label">Keterangan</label>
                <input type="text" id="p-ket" class="form-input" placeholder="Opsional" />
              </div>
            </div>
            <div class="form-actions">
              <button class="btn btn-secondary" onclick="resetPinjam()">Reset</button>
              <button class="btn btn-primary" onclick="simpanPinjam()">Simpan Peminjaman</button>
            </div>
          </div>
        </div>
        <div id="pinjam-result"></div>
      </div>

      <!-- AKTIF -->
      <div class="tab-content" id="tc-aktif">
        <div class="card" style="overflow:hidden;">
          <div class="card-head">
            <div class="card-title">Buku Sedang Dipinjam</div>
            <input type="text" class="search-input" style="width:220px;" placeholder="Cari nama atau buku..." id="search-aktif" oninput="filterAktif()" />
          </div>
          <div class="row"><div class="col-md-12">
<table class="table table-striped table-bordered" id="tbl-aktif">
            <thead>
              <tr>
                <th>Peminjam</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Sisa</th>
                <th style="text-align:right;">Aksi</th>
              </tr>
            </thead>
            <tbody id="tbody-aktif"></tbody>
          </table>
</div></div>
        </div>
      </div>

      <!-- TERLAMBAT -->
      <div class="tab-content" id="tc-terlambat">
        <div class="callout-warning">
          Terdapat <strong><?= count($terlambat) ?> buku</strong> yang belum dikembalikan melewati batas waktu. Segera hubungi peminjam.
        </div>
        <div class="card" style="overflow:hidden;">
          <div class="row"><div class="col-md-12">
<table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Peminjam</th>
                <th>Judul Buku</th>
                <th>Seharusnya Kembali</th>
                <th>Keterlambatan</th>
                <th style="text-align:right;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($terlambat as $t): ?>
                <?php
                  $hariIni = new DateTime();
                  $tglKembali = new DateTime($t['tgl_kembali']);
                  $diff = $hariIni->diff($tglKembali)->days;
                  // If it's late, $diff is the delay in days
                  $chipClass = $diff > 5 ? 'red' : 'amber';
                ?>
                <tr>
                  <td><strong><?= esc($t['nama_peminjam']) ?></strong></td>
                  <td><?= esc($t['buku']) ?></td>
                  <td><?= date('d M Y', strtotime($t['tgl_kembali'])) ?></td>
                  <td><span class="chip <?= $chipClass ?>"><?= $diff ?> hari</span></td>
                  <td style="text-align:right;"><button class="btn-inline" onclick="kembalikan(this, <?= $t['anggota_id'] ?>, <?= $t['buku_id'] ?>, '<?= esc(addslashes($t['nama_peminjam'])) ?>')">Catat Kembali</button></td>
                </tr>
              <?php endforeach; ?>
              <?php if(empty($terlambat)): ?>
                <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:1rem;">Tidak ada buku terlambat.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
</div></div>
        </div>
      </div>

      <!-- RIWAYAT -->
      <div class="tab-content" id="tc-riwayat">
        <div class="card" style="overflow:hidden;">
          <div class="card-head">
            <div class="card-title">Riwayat Pengembalian</div>
          </div>
          <div class="row"><div class="col-md-12">
<table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Peminjam</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($riwayat as $r): ?>
                <?php
                  $tglKembaliReal = new DateTime($r['tgl_dikembalikan']);
                  $tglKembaliMax = new DateTime($r['tgl_kembali']);
                  if ($tglKembaliReal > $tglKembaliMax) {
                      $diff = $tglKembaliReal->diff($tglKembaliMax)->days;
                      $statusLabel = "<span class='chip amber'>Terlambat $diff hari</span>";
                  } else {
                      $statusLabel = "<span class='chip green'>Tepat Waktu</span>";
                  }
                ?>
                <tr>
                  <td><?= esc($r['nama_peminjam']) ?></td>
                  <td><?= esc($r['buku']) ?></td>
                  <td><?= date('d M Y', strtotime($r['tgl_pinjam'])) ?></td>
                  <td><?= date('d M Y', strtotime($r['tgl_dikembalikan'])) ?></td>
                  <td><?= $statusLabel ?></td>
                </tr>
              <?php endforeach; ?>
              <?php if(empty($riwayat)): ?>
                <tr><td colspan="5" style="text-align:center;color:var(--text-muted);padding:1rem;">Belum ada riwayat pengembalian.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
</div></div>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="toast" id="toast-pinjam"></div>

<script>
  const aktifData = <?= json_encode($aktif ?? []) ?>;
  const terlambatData = <?= json_encode($terlambat ?? []) ?>;
  const riwayatData = <?= json_encode($riwayat ?? []) ?>;
</script>
<script src="/peminjaman.js?v=<?= time() ?>"></script>
</body>
</html>
