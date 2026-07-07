<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kelola Anggota | Pengaturan</title>
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
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
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
        
        <a href="/pengaturan/anggota" class="nav-item active">
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
        <h1 class="page-title">Kelola Anggota</h1>
        <p class="page-sub">Hapus keanggotaan pengguna jika diperlukan</p>
      </div>
    </header>

    <div class="content">
      <div class="card">
        <div class="row"><div class="col-md-12">
<table class="table table-striped table-bordered">
          <thead><tr><th>ID</th><th>No Identitas</th><th>Nama Lengkap</th><th style="text-align:right;">Aksi</th></tr></thead>
          <tbody>
            <?php foreach($anggota as $a): ?>
              <tr>
                <td><?= $a['id'] ?></td>
                <td><?= $a['no_identitas'] ?></td>
                <td><strong><?= $a['nama'] ?></strong></td>
                <td style="text-align:right;">
                  <button class="btn btn-secondary" onclick="editAnggota(<?= $a['id'] ?>, '<?= addslashes($a['no_identitas']) ?>', '<?= addslashes($a['nama']) ?>')" style="padding:4px 12px; margin-right:8px;">Edit</button>
                  <button class="btn btn-secondary" onclick="hapusAnggota(<?= $a['id'] ?>)" style="color:var(--danger);border-color:var(--danger);padding:4px 12px;">Hapus</button>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php if(empty($anggota)): ?>
              <tr><td colspan="4" style="text-align:center;padding:1rem;">Tidak ada anggota terdaftar.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
</div></div>
      </div>
    </div>
  </div>
</div>
<script>
function hapusAnggota(id) {
    if(confirm('Apakah Anda yakin ingin menghapus anggota ini secara permanen?')) {
        const formData = new FormData();
        formData.append('id', id);
        fetch('/pengaturan/anggota/delete', { method:'POST', body:formData })
        .then(res => res.json())
        .then(res => { location.reload(); });
    }
}

function editAnggota(id, oldNo, oldNama) {
    const newNo = prompt('Edit Nomor Identitas:', oldNo);
    if(newNo === null || newNo.trim() === '') return;
    
    const newNama = prompt('Edit Nama Lengkap:', oldNama);
    if(newNama === null || newNama.trim() === '') return;
    
    const formData = new FormData();
    formData.append('id', id);
    formData.append('no_identitas', newNo.trim());
    formData.append('nama', newNama.trim());
    
    fetch('/pengaturan/anggota/update', { method:'POST', body:formData })
    .then(res => res.json())
    .then(res => { location.reload(); });
}
</script>
</body>
</html>
