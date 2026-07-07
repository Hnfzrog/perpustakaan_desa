// data is injected from PHP
function renderTable(data) {
  const tbody = document.getElementById('anggota-tbody');
  const footer = document.getElementById('table-footer');
  tbody.innerHTML = '';

  if (!data.length) {
    tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;padding:28px;color:var(--text-muted);">Tidak ada anggota yang sesuai pencarian.</td></tr>`;
    footer.textContent = '';
    return;
  }

  data.forEach(a => {
    const tr = document.createElement('tr');
    const tgl = new Date(a.created_at || new Date()).toLocaleDateString('id-ID', {day:'numeric', month:'short', year:'numeric'});
    tr.innerHTML = `
      <td style="font-family:monospace;color:var(--text-muted);">${a.no_identitas}</td>
      <td style="font-weight:600;color:var(--text);">${a.nama}</td>
      <td>${a.no_telp || '-'}</td>
      <td>${a.alamat || '-'}</td>
      <td>${tgl}</td>
    `;
    tbody.appendChild(tr);
  });

  footer.textContent = `Menampilkan ${data.length} dari ${anggotaData.length} anggota`;
}

function filterAnggota() {
  const q = document.getElementById('searchInput').value.toLowerCase();
  const filtered = anggotaData.filter(a => {
    return !q || `${a.nama} ${a.no_identitas} ${a.no_telp} ${a.alamat}`.toLowerCase().includes(q);
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

function tambahAnggota() {
  const no_identitas = document.getElementById('f-identitas').value.trim();
  const nama         = document.getElementById('f-nama').value.trim();
  const no_telp      = document.getElementById('f-telp').value.trim();
  const alamat       = document.getElementById('f-alamat').value.trim();

  let valid = true;
  [['ferr-identitas', no_identitas, 'No identitas wajib diisi'],
   ['ferr-nama', nama, 'Nama anggota wajib diisi'],
   ['ferr-telp', no_telp, 'No telp wajib diisi']
  ].forEach(([id, val, msg]) => {
    document.getElementById(id).textContent = val ? '' : msg;
    if (!val) valid = false;
  });

  if (!valid) return;

  const data = new FormData();
  data.append('no_identitas', no_identitas);
  data.append('nama', nama);
  data.append('no_telp', no_telp);
  data.append('alamat', alamat);

  fetch('/anggota', { method: 'POST', body: data })
    .then(res => res.json())
    .then(res => {
      anggotaData.unshift({ no_identitas, nama, no_telp, alamat, created_at: new Date().toISOString() });
      filterAnggota();
      closeModal();
      
      // clear form
      ['f-identitas','f-nama','f-telp','f-alamat'].forEach(id => document.getElementById(id).value = '');
    
      const toast = document.getElementById('toast');
      toast.textContent = `Anggota "${nama}" berhasil didaftarkan!`;
      toast.classList.add('show');
      setTimeout(() => toast.classList.remove('show'), 3000);
    });
}

// Init
renderTable(anggotaData);
