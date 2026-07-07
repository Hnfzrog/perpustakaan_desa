<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login | Perpustakaan Desa Sukamaju</title>
  <link rel="stylesheet" href="/style.css">
  <style>
    body { display: flex; align-items: center; justify-content: center; height: 100vh; background-color: var(--bg-body); }
    .login-card { background: var(--bg-card); padding: 40px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); width: 100%; max-width: 400px; text-align: center; }
    .brand-icon { width: 48px; height: 48px; background: var(--primary); color: white; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px; }
    .form-group { text-align: left; margin-bottom: 16px; }
  </style>
</head>
<body>
  <div class="login-card">
    <div class="brand-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
    </div>
    <h2>Perpustakaan</h2>
    <p style="color:var(--text-muted);margin-bottom:24px;">Silakan masuk untuk melanjutkan</p>
    
    <?php if(session()->getFlashdata('error')): ?>
      <div style="color:var(--danger);margin-bottom:16px;"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="/login" method="POST">
      <div class="form-group">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-input" required autofocus />
      </div>
      <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-input" required />
      </div>
      <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 8px;">Masuk</button>
    </form>
    
    <div style="margin-top:24px;font-size:12px;color:var(--text-muted);">
      <div><b>Akun Demo:</b></div>
      <div>Pengelola: <code>pengelola</code> / <code>pengelola123</code></div>
      <div>Super Admin: <code>superadmin</code> / <code>admin123</code></div>
    </div>
  </div>
</body>
</html>
