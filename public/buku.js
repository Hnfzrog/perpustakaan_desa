// data is injected from PHP
function renderTable(data) {
  const tbody = document.getElementById('buku-tbody');
  const footer = document.getElementById('table-footer');
  tbody.innerHTML = '';

  if (!data.length) {
    tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:28px;color:var(--text-muted);">Tidak ada buku yang sesuai pencarian.</td></tr>`;
    footer.textContent = '';
    return;
  }

  data.forEach(b => {
    const isAvail = b.status === 'Tersedia';
    const tr = document.createElement('tr');
    tr.dataset.search = `${b.judul} ${b.pengarang} ${b.kategori} ${b.kode}`.toLowerCase();
    tr.dataset.kat    = b.kategori;
    tr.dataset.status = b.status;
    tr.innerHTML = `
      <td style="font-family:monospace;font-size:12px;color:var(--text-muted);">${b.kode}-${b.nomor_buku}</td>
      <td style="font-weight:600;color:var(--text);">${b.judul}</td>
      <td>${b.pengarang}</td>
      <td><span class="chip blue">${b.kategori}</span></td>
      <td>${b.tahun}</td>
      <td><span class="chip ${isAvail ? 'green' : 'amber'}">${b.status}</span></td>
      <td style="text-align:right;">
        ${isAvail
          ? `<a href="/peminjaman?buku_id=${b.id}" class="btn-inline">Pinjamkan</a>`
          : `<span style="font-size:12px;color:var(--text-muted);">–</span>`}
      </td>
    `;
    tbody.appendChild(tr);
  });

  footer.textContent = `Menampilkan ${data.length} dari ${bukuData.length} buku`;
}

function filterBuku() {
  const q   = document.getElementById('searchInput').value.toLowerCase();
  const kat = document.getElementById('filterKat').value;
  const st  = document.getElementById('filterStatus').value;

  const filtered = bukuData.filter(b => {
    const matchQ   = !q  || `${b.judul} ${b.pengarang} ${b.kategori} ${b.kode}`.toLowerCase().includes(q);
    const matchKat = !kat || b.kategori === kat;
    const matchSt  = !st  || b.status === st;
    return matchQ && matchKat && matchSt;
  });

  renderTable(filtered);
}

function openModal() {
  document.getElementById('modal-overlay').classList.add('show');
  document.getElementById('modal-panel').classList.add('show');
}
function closeModal() {
  document.getElementById('modal-overlay').classList.remove('show');
  document.getElementById('modal-panel').classList.remove('show');
}

function tambahBuku() {
  const nomor_buku  = document.getElementById('f-nomor-buku').value.trim();
  const kat_id      = document.getElementById('f-kat').value;
  const judul       = document.getElementById('f-judul').value.trim();
  const pengarang   = document.getElementById('f-pengarang').value.trim();
  const tahun       = document.getElementById('f-tahun').value || '-';

  let valid = true;
  [['ferr-kode', nomor_buku, 'Nomor buku wajib diisi'],
   ['ferr-kat',  kat_id,  'Pilih kategori'],
   ['ferr-judul', judul, 'Judul buku wajib diisi'],
   ['ferr-pengarang', pengarang, 'Nama pengarang wajib diisi']
  ].forEach(([id, val, msg]) => {
    document.getElementById(id).textContent = val ? '' : msg;
    if (!val) valid = false;
  });

  if (!valid) return;

  const data = new FormData();
  data.append('nomor_buku', nomor_buku);
  data.append('kategori_id', kat_id);
  data.append('judul', judul);
  data.append('pengarang', pengarang);
  data.append('tahun', tahun);
  data.append('keterangan', document.getElementById('f-ket').value);

  fetch('/buku', { method: 'POST', body: data })
    .then(res => res.json())
    .then(res => {
      const toast = document.getElementById('toast');
      toast.textContent = `"${judul}" berhasil ditambahkan!`;
      toast.classList.add('show');
      setTimeout(() => location.reload(), 1500);
    });


}

// Init
renderTable(bukuData);
