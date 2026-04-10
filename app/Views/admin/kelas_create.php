<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?> - PTQ Al-Hikmah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a5fb4; --primary-dark: #1c3d78; --secondary: #26a269;
            --accent: #e5a50a; --light: #f8f9fa; --dark: #2d3748;
            --gray: #718096; --light-gray: #e2e8f0; --danger: #e53e3e;
            --success: #38a169; --warning: #dd6b20; --info: #0ea5e9;
            --purple: #8b5cf6; --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --radius: 12px; --transition: all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', system-ui, -apple-system, sans-serif; }
        body { background-color: #f0f2f5; color: var(--dark); line-height: 1.6; }

        /* REUSABLE LAYOUT COMPONENTS */
        .dashboard-header { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); padding: 12px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .header-content { display: flex; justify-content: space-between; align-items: center; }
        .logo { display: flex; align-items: center; gap: 12px; color: white; text-decoration: none; font-weight: 700; font-size: 1.25rem; }
        .logo span { color: var(--accent); }

        .main-wrapper { display: flex; min-height: calc(100vh - 68px); }
        
        .sidebar { width: 260px; background: white; border-right: 1px solid var(--light-gray); padding: 24px 16px; display: flex; flex-direction: column; gap: 8px; }
        .menu-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px; color: var(--gray); text-decoration: none; font-weight: 500; transition: var(--transition); }
        .menu-item:hover { background: var(--light); color: var(--primary); }
        .menu-item.active { background: rgba(26, 95, 180, 0.1); color: var(--primary); }
        .menu-item i { width: 20px; text-align: center; }

        .content-area { flex: 1; padding: 40px; }
        .page-header { margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between; }
        .back-link { display: flex; align-items: center; gap: 8px; color: var(--gray); text-decoration: none; font-weight: 500; margin-bottom: 8px; transition: var(--transition); }
        .back-link:hover { color: var(--primary); }
        .page-title { font-size: 1.875rem; font-weight: 800; color: var(--primary-dark); }

        /* FORM STYLES */
        .form-card { background: white; border-radius: var(--radius); shadow: var(--shadow); padding: 32px; border: 1px solid var(--light-gray); }
        .form-section { margin-bottom: 32px; }
        .section-title { font-size: 1.1rem; font-weight: 700; color: var(--primary); margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid var(--light-gray); display: flex; align-items: center; gap: 10px; }
        
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .full-width { grid-column: span 2; }

        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 0.875rem; font-weight: 600; color: var(--dark); margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 16px; border: 1.5px solid var(--light-gray); border-radius: 10px; font-size: 1rem; transition: var(--transition); outline: none; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(26, 95, 180, 0.1); }
        .required { color: var(--danger); margin-left: 4px; }

        .ustadz-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 12px; margin-top: 12px; }
        .ustadz-item { display: flex; align-items: center; gap: 10px; padding: 12px; border: 1px solid var(--light-gray); border-radius: 8px; cursor: pointer; transition: var(--transition); }
        .ustadz-item:hover { border-color: var(--primary); background: var(--light); }
        .ustadz-item input[type="checkbox"] { width: 18px; height: 18px; cursor: pointer; accent-color: var(--primary); }
        .ustadz-name { font-size: 0.9rem; font-weight: 500; }

        .form-actions { display: flex; justify-content: flex-end; gap: 16px; margin-top: 16px; padding-top: 24px; border-top: 1px solid var(--light-gray); }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 10px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: var(--transition); border: none; }
        .btn-light { background: var(--light); color: var(--gray); }
        .btn-light:hover { background: var(--light-gray); color: var(--dark); }
        .btn-primary { background: var(--primary); color: white; box-shadow: 0 4px 12px rgba(26, 95, 180, 0.2); }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-1px); }

        @media (max-width: 768px) {
            .grid { grid-template-columns: 1fr; }
            .full-width { grid-column: span 1; }
            .sidebar { display: none; }
            .content-area { padding: 24px 16px; }
        }
    </style>
</head>
<body>

    <header class="dashboard-header">
        <div class="container">
            <div class="header-content">
                <a href="<?= base_url('admin/dashboard') ?>" class="logo">
                    <i class="fas fa-quran"></i>
                    PTQ <span>Al-Hikmah</span>
                </a>
            </div>
        </div>
    </header>

    <div class="main-wrapper">
        <aside class="sidebar">
            <a href="<?= base_url('admin/dashboard') ?>" class="menu-item"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="<?= base_url('admin/users') ?>" class="menu-item"><i class="fas fa-users"></i> Manajemen Akun</a>
            <a href="<?= base_url('admin/santri') ?>" class="menu-item"><i class="fas fa-user-graduate"></i> Data Santri</a>
            <a href="<?= base_url('admin/ustadz') ?>" class="menu-item"><i class="fas fa-chalkboard-teacher"></i> Data Ustadz</a>
            <a href="<?= base_url('admin/kelas') ?>" class="menu-item active"><i class="fas fa-school"></i> Data Kelas</a>
            <a href="<?= base_url('admin/hafalan') ?>" class="menu-item"><i class="fas fa-book-open"></i> Hafalan</a>
            <a href="<?= base_url('admin/pembayaran') ?>" class="menu-item"><i class="fas fa-wallet"></i> Keuangan</a>
        </aside>

        <main class="content-area">
            <nav>
                <a href="<?= base_url('admin/kelas') ?>" class="back-link"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Kelas</a>
            </nav>
            <div class="page-header">
                <h1 class="page-title">Tambah Kelas Baru</h1>
            </div>

            <form action="<?= base_url('admin/kelas/store') ?>" method="POST" class="form-card">
                <?= csrf_field() ?>
                
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-info-circle"></i> Informasi Dasar</h2>
                    <div class="grid">
                        <div class="form-group full-width">
                            <label class="form-label">Nama Kelas / Rombongan Belajar <span class="required">*</span></label>
                            <input type="text" name="nama_kelas" class="form-control" placeholder="Contoh: Kelas Abu Bakar, Iqro 1" required>
                        </div>
                        <div class="form-group full-width">
                            <label class="form-label">Wali Kelas Utama (Primary)</label>
                            <select name="id_ustadz" class="form-control">
                                <option value="">-- Tanpa Wali Kelas --</option>
                                <?php foreach($ustadzList as $u): ?>
                                    <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nama_lengkap']) ?> (@<?= $u['username'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label class="form-label">Deskripsi Kelas</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Informasi tambahan mengenai target atau kriteria kelas ini..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-users-cog"></i> Tim Pengajar (Ustadz/ah)</h2>
                    <p style="font-size: 0.85rem; color: var(--gray); margin-bottom: 12px;">Pilih satu atau lebih pengajar yang akan mengampu kelas ini. Semua pengajar terpilih akan memiliki akses ke data santri di kelas ini.</p>
                    
                    <div class="ustadz-grid">
                        <?php foreach($ustadzList as $u): ?>
                            <label class="ustadz-item">
                                <input type="checkbox" name="ustadz_ids[]" value="<?= $u['id'] ?>">
                                <span class="ustadz-name"><?= htmlspecialchars($u['nama_lengkap']) ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="<?= base_url('admin/kelas') ?>" class="btn btn-light">Batalkan</a>
                    <button type="submit" class="btn btn-primary">Simpan Kelas Baru</button>
                </div>
            </form>
        </main>
    </div>

</body>
</html>
