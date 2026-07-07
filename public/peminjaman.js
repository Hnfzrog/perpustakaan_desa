// ========================
//   TABS
// ========================
function showTab(tab) {
  ['pinjam','aktif','terlambat','riwayat'].forEach(t => {
    document.getElementById(`tab-${t}`).classList.toggle('active', t === tab);
    document.getElementById(`tc-${t}`).classList.toggle('active', t === tab);
  });
}

// ========================
//   DATA AKTIF (injected via PHP)
// ========================

function renderAktif(data) {
  const tbody = document.getElementById('tbody-aktif');
  tbody.innerHTML = '';
  const today = new Date();
  today.setHours(0,0,0,0);

  data.forEach(d => {
    const tglKembali = new Date(d.tgl_kembali);
    const diffTime = tglKembali - today;
    const sisa = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    const sisaLabel = sisa === 0
      ? `<span class="chip amber">Hari ini</span>`
      : sisa < 0
        ? `<span class="chip red">Terlambat</span>`
        : `<span style="font-size:12px;color:var(--text-mid);">${sisa} hari lagi</span>`;
        
    const dPinjam = new Date(d.tgl_pinjam).toLocaleDateString('id-ID', {day:'numeric', month:'short', year:'numeric'});
    const dTempo = new Date(d.tgl_kembali).toLocaleDateString('id-ID', {day:'numeric', month:'short', year:'numeric'});

    tbody.innerHTML += `
      <tr>
        <td style="font-weight:600;color:var(--text);">${d.nama_peminjam}</td>
        <td>${d.buku}</td>
        <td style="color:var(--text-muted);">${dPinjam}</td>
        <td>${dTempo}</td>
        <td>${sisaLabel}</td>
        <td style="text-align:right;">
          <button class="btn-inline" onclick="kembalikan(this, ${d.anggota_id}, ${d.buku_id}, '${d.nama_peminjam.replace(/'/g, "\\'")}')">Catat Kembali</button>
        </td>
      </tr>
    `;
  });
}

function filterAktif() {
  const q = document.getElementById('search-aktif').value.toLowerCase();
  const filtered = aktifData.filter(d =>
    d.nama_peminjam.toLowerCase().includes(q) || d.buku.toLowerCase().includes(q)
  );
  renderAktif(filtered);
}


// ========================
//   KEMBALIKAN
// ========================
function kembalikan(btn, anggota_id, buku_id, nama) {
  btn.textContent = 'Menyimpan...';
  btn.disabled = true;

  const data = new FormData();
  data.append('anggota_id', anggota_id);
  data.append('buku_id', buku_id);

  fetch('/peminjaman/kembali', { method: 'POST', body: data })
    .then(res => res.json())
    .then(res => {
      btn.textContent = 'Dicatat';
      btn.classList.add('done');
      showToast(`Pengembalian dari ${nama} berhasil dicatat.`);
      setTimeout(() => location.reload(), 1500);
    });
}

// ========================
//   FORM PINJAM
// ========================
function simpanPinjam() {
  const anggota_id = document.getElementById('f-nama').value;
  const buku_id    = document.getElementById('f-buku').value;
  const tglPinjam = document.getElementById('p-tglpinjam').value;
  const tglKembali= document.getElementById('p-tglkembali').value;
  const ket        = document.getElementById('p-ket').value;

  let valid = true;
  [
    ['ferr-nama', anggota_id, 'Pilih peminjam'],
    ['ferr-buku', buku_id, 'Pilih buku'],
    ['perr-tglkembali', tglKembali, 'Tanggal kembali wajib diisi'],
  ].forEach(([errId, val, msg]) => {
    document.getElementById(errId).textContent = val ? '' : msg;
    if (!val) valid = false;
  });

  if (!valid) return;

  const tglFmt = (str) => str ? new Date(str).toLocaleDateString('id-ID', { day:'numeric', month:'long', year:'numeric' }) : '-';
  const selNama = document.getElementById('f-nama');
  const selBuku = document.getElementById('f-buku');
  const nama = selNama.options[selNama.selectedIndex].text;
  const buku = selBuku.options[selBuku.selectedIndex].text;

  const formData = new FormData();
  formData.append('anggota_id', anggota_id);
  formData.append('buku_id', buku_id);
  formData.append('tgl_pinjam', tglPinjam);
  formData.append('tgl_kembali', tglKembali);
  formData.append('ket', ket);

  fetch('/peminjaman', { method: 'POST', body: formData })
    .then(res => res.json())
    .then(res => {
        document.getElementById('pinjam-result').innerHTML = `
          <div class="success-card">
            <div class="success-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
              </svg>
            </div>
            <div>
              <div class="success-title">Peminjaman berhasil dicatat!</div>
              <div class="success-body">
                <strong>${nama}</strong> meminjam <strong>${buku}</strong>.<br/>
                Tanggal pinjam: ${tglFmt(tglPinjam) || 'Hari ini'} &nbsp;&bull;&nbsp; Wajib kembali: <strong>${tglFmt(tglKembali)}</strong>
              </div>
            </div>
          </div>
        `;
        resetPinjam();
        document.getElementById('pinjam-result').scrollIntoView({ behavior:'smooth', block:'nearest' });
        setTimeout(() => location.reload(), 2000);
    });
}

function resetPinjam() {
  document.getElementById('f-nama').selectedIndex = 0;
  document.getElementById('f-buku').selectedIndex = 0;
  document.getElementById('p-tglkembali').value = '';
  document.getElementById('p-ket').value = '';
  ['ferr-nama','ferr-buku','perr-tglkembali'].forEach(id => document.getElementById(id).textContent = '');

  // Set default dates
  const today = new Date();
  const due   = new Date(today); due.setDate(due.getDate() + 7);
  document.getElementById('p-tglpinjam').value   = today.toISOString().split('T')[0];
  document.getElementById('p-tglkembali').value  = due.toISOString().split('T')[0];
}

// ========================
//   TOAST
// ========================
function showToast(msg) {
  const t = document.getElementById('toast-pinjam');
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3000);
}

// ========================
//   INIT
// ========================
renderAktif(aktifData);
resetPinjam();

// Cek param buku_id dari menu Koleksi Buku
const params = new URLSearchParams(window.location.search);
const autoBukuId = params.get('buku_id');
if (autoBukuId) {
  showTab('pinjam');
  const selBuku = document.getElementById('f-buku');
  if (selBuku) {
    selBuku.value = autoBukuId;
  }
}
