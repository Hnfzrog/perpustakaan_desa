<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard | Perpustakaan Desa Sukamaju</title>
  <meta name="description" content="Sistem manajemen perpustakaan desa Sukamaju – pantau koleksi, peminjaman, dan anggota." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/style.css" />
</head>
<body>
<div class="shell">

  <!-- SIDEBAR -->
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
      <a href="/" class="nav-item active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        Dashboard
      </a>
      <a href="/buku" class="nav-item">
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

  <!-- MAIN -->
  <div class="main">
    <header class="topbar">
      <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-sub" id="js-date"></p>
      </div>
      <a href="/peminjaman" class="btn btn-primary">+ Catat Peminjaman</a>
    </header>

    <div class="content">

      <!-- STATS -->
      <div class="stats-row">
        <div class="stat-card">
          <div class="stat-icon green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
          </div>
          <div class="stat-body">
            <div class="stat-num"><?= esc($totalKoleksi) ?></div>
            <div class="stat-label">Total Koleksi</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon amber">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
          </div>
          <div class="stat-body">
            <div class="stat-num"><?= esc($sedangDipinjam) ?></div>
            <div class="stat-label">Sedang Dipinjam</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon red">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          </div>
          <div class="stat-body">
            <div class="stat-num"><?= esc($terlambat) ?></div>
            <div class="stat-label">Terlambat Kembali</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          </div>
          <div class="stat-body">
            <div class="stat-num"><?= esc($totalAnggota) ?></div>
            <div class="stat-label">Anggota Terdaftar</div>
          </div>
        </div>
      </div>

      <div class="grid-2">

        <!-- PEMINJAMAN AKTIF -->
        <div class="card">
          <div class="card-head">
            <div>
              <div class="card-title">Peminjaman Aktif</div>
              <div class="card-sub">Buku yang sedang dipinjam hari ini</div>
            </div>
            <a href="/peminjaman" class="link-more">Lihat semua</a>
          </div>
          <div class="pinjam-list">
            <?php foreach($aktifPeminjaman as $p): ?>
              <?php
                $initial = substr($p['buku'], 0, 2);
                $tgl = date('d M', strtotime($p['tgl_pinjam']));
                $jatuhTempo = date('d M', strtotime($p['tgl_kembali']));
              ?>
              <div class="pinjam-item">
                <div class="pinjam-cover blue"><?= strtoupper(esc($initial)) ?></div>
                <div class="pinjam-info">
                  <div class="pinjam-title"><?= esc($p['buku']) ?></div>
                  <div class="pinjam-anggota"><?= esc($p['nama_peminjam']) ?> · Dipinjam <?= $tgl ?></div>
                </div>
                <div class="pinjam-due ok">Jatuh tempo <?= $jatuhTempo ?></div>
              </div>
            <?php endforeach; ?>
            <?php if(empty($aktifPeminjaman)): ?>
              <div style="padding: 1rem; color: var(--text-muted);">Tidak ada peminjaman aktif.</div>
            <?php endif; ?>
          </div>
        </div>

        <!-- KOLOM KANAN -->
        <div class="right-col">

          <!-- BUKU POPULER REMOVED -->

          <!-- AKTIVITAS TERAKHIR -->
          <div class="card">
            <div class="card-head">
              <div class="card-title">Aktivitas Terakhir</div>
            </div>
            <div class="activity-list">
              <?php foreach($aktivitas as $act): ?>
                <?php
                  $time = date('d M, H:i', strtotime($act['date']));
                ?>
                <div class="act-item">
                  <div class="act-dot <?= $act['color'] ?>"></div>
                  <div class="act-text"><?= esc($act['text']) ?></div>
                  <div class="act-time"><?= $time ?></div>
                </div>
              <?php endforeach; ?>
              <?php if(empty($aktivitas)): ?>
                <div style="padding: 1rem; color: var(--text-muted);">Belum ada aktivitas.</div>
              <?php endif; ?>
            </div>
          </div>

        </div>
      </div>

      <!-- KATEGORI KOLEKSI -->
      <div class="card">
        <div class="card-head">
          <div class="card-title">Sebaran Koleksi per Kategori</div>
        </div>
        <div class="kategori-grid">
          <?php
            $max = count($kategoriCount) > 0 ? max($kategoriCount) : 1;
            $colors = ['', 'amber', 'blue'];
            $i = 0;
            foreach($kategoriCount as $kat => $count):
              $pct = ($count / $max) * 100;
              $color = $colors[$i % 3];
              $i++;
          ?>
          <div class="kat-item">
            <div class="kat-bar-wrap">
              <div class="kat-bar <?= $color ?>" style="height:<?= $pct ?>%"></div>
            </div>
            <div class="kat-num"><?= $count ?></div>
            <div class="kat-label"><?= esc($kat) ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div><!-- .content -->
  </div><!-- .main -->
</div><!-- .shell -->

<script>
  const d = new Date();
  document.getElementById('js-date').textContent = d.toLocaleDateString('id-ID', {
    weekday:'long', day:'numeric', month:'long', year:'numeric'
  });
</script>
</body>
</html>
