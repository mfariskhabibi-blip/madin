<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas - PTQ Al-Hikmah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET (Standardized Premium Design) */
        :root {
            --primary: #1a5fb4; --primary-dark: #1c3d78; --secondary: #26a269;
            --accent: #e5a50a; --light: #f8f9fa; --dark: #2d3748;
            --gray: #718096; --light-gray: #e2e8f0; --danger: #e53e3e;
            --success: #38a169; --warning: #dd6b20; --info: #0ea5e9;
            --purple: #8b5cf6; --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --radius: 12px; --transition: all 0.3s ease;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', system-ui, -apple-system, sans-serif; }
        body { background-color: #f0f2f5; color: var(--dark); line-height: 1.6; }
        a { text-decoration: none; color: inherit; }
        
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
        /* HEADER/NAVBAR */
        .dashboard-header { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); padding: 12px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header-content { display: flex; justify-content: space-between; align-items: center; }
        .logo { display: flex; align-items: center; gap: 12px; color: white; font-weight: 700; font-size: 1.25rem; }
        .logo span { color: var(--accent); }
        
        .user-section { display: flex; align-items: center; gap: 16px; }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.2); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; border: 2px solid rgba(255,255,255,0.5); }

        /* DASHBOARD LAYOUT */
        .main-wrapper { display: flex; min-height: calc(100vh - 68px); }
        
        .sidebar { width: 260px; background: white; border-right: 1px solid var(--light-gray); padding: 24px 16px; display: flex; flex-direction: column; gap: 8px; }
        .menu-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px; color: var(--gray); text-decoration: none; font-weight: 500; transition: var(--transition); }
        .menu-item:hover { background: var(--light); color: var(--primary); }
        .menu-item.active { background: rgba(26, 95, 180, 0.1); color: var(--primary); }
        .menu-item i { width: 20px; text-align: center; }

        .content-area { flex: 1; padding: 40px; }
        .page-header { margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between; }
        .page-title { font-size: 1.875rem; font-weight: 800; color: var(--primary-dark); }
        
        /* ACTION BARS */
        .action-bar { margin-bottom: 24px; display: flex; gap: 16px; align-items: center; justify-content: space-between; }
        .search-wrapper { position: relative; flex: 1; max-width: 400px; }
        .search-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--gray); }
        .search-input { width: 100%; padding: 12px 16px 12px 44px; border-radius: 10px; border: 1.5px solid var(--light-gray); outline: none; transition: var(--transition); font-size: 0.95rem; }
        .search-input:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(26, 95, 180, 0.1); }

        /* TABLE STYLES */
        .data-card { background: white; border-radius: var(--radius); shadow: var(--shadow); overflow: hidden; border: 1px solid var(--light-gray); }
        .table-responsive { width: 100%; overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; text-align: left; }
        .table th { background: #f8fafc; padding: 16px 24px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--gray); border-bottom: 1.5px solid var(--light-gray); }
        .table td { padding: 20px 24px; border-bottom: 1px solid var(--light-gray); vertical-align: middle; }
        .table tr:last-child td { border-bottom: none; }
        .table tr:hover { background: #fafafa; }

        .kelas-info { display: flex; align-items: center; gap: 16px; }
        .kelas-icon { width: 48px; height: 48px; border-radius: 12px; background: rgba(26, 95, 180, 0.08); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
        .kelas-name { font-weight: 700; color: var(--dark); font-size: 1rem; margin-bottom: 4px; }
        .kelas-sub { font-size: 0.825rem; color: var(--gray); }

        .teacher-group { display: flex; flex-direction: column; gap: 4px; }
        .teacher-badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; background: var(--light); border: 1px solid var(--light-gray); color: var(--dark); }
        .teacher-badge.primary { background: rgba(26, 95, 180, 0.08); border-color: rgba(26, 95, 180, 0.2); color: var(--primary); }
        .teacher-badge i { font-size: 0.7rem; }

        .action-btns { display: flex; gap: 8px; }
        .act-btn { width: 36px; height: 36px; border-radius: 8px; display: flex; outline: none; border: none; align-items: center; justify-content: center; cursor: pointer; transition: var(--transition); font-size: 0.9rem; }
        .btn-edit { background: rgba(26, 95, 180, 0.1); color: var(--primary); }
        .btn-edit:hover { background: var(--primary); color: white; }
        .btn-delete { background: rgba(229, 62, 62, 0.1); color: var(--danger); }
        .btn-delete:hover { background: var(--danger); color: white; }

        .btn-primary { background: var(--primary); color: white; padding: 12px 24px; border-radius: 10px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(26, 95, 180, 0.2); }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-1px); }

        /* ALERT STYLES */
        .alert { padding: 16px 20px; border-radius: 10px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; animation: slideIn 0.4s ease; }
        .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-danger { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
        @keyframes slideIn { from { transform: translateY(-10px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        /* EMPTY STATE */
        .empty-state { padding: 64px 32px; text-align: center; color: var(--gray); }
        .empty-state i { font-size: 3rem; margin-bottom: 16px; opacity: 0.3; }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .content-area { padding: 24px 16px; }
            .table th:nth-child(2), .table td:nth-child(2) { display: none; }
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
                <div class="user-section">
                    <div class="user-avatar">AD</div>
                </div>
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
            <div class="page-header">
                <h1 class="page-title">Data Kelas & Rombel</h1>
                <a href="<?= base_url('admin/kelas/create') ?>" class="btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kelas
                </a>
            </div>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="data-card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Informasi Kelas</th>
                                <th>Tim Pengajar (Ustadz)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($kelas)): ?>
                                <?php foreach($kelas as $k): ?>
                                    <tr>
                                        <td>
                                            <div class="kelas-info">
                                                <div class="kelas-icon"><i class="fas fa-door-open"></i></div>
                                                <div>
                                                    <div class="kelas-name"><?= htmlspecialchars($k['nama_kelas']) ?></div>
                                                    <div class="kelas-sub"><?= htmlspecialchars($k['deskripsi'] ?: 'Tidak ada deskripsi') ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="teacher-group">
                                                <?php if($k['id_ustadz']): ?>
                                                    <span class="teacher-badge primary" title="Wali Kelas Utama">
                                                        <i class="fas fa-star"></i> <?= htmlspecialchars($k['nama_wali_kelas']) ?> (Wali)
                                                    </span>
                                                <?php endif; ?>

                                                <?php foreach($k['pengampu'] as $p): ?>
                                                    <?php // Skip showing if it's the same as Wali Kelas to avoid duplicates
                                                        if ($k['id_ustadz'] == $p['id']) continue; 
                                                    ?>
                                                    <span class="teacher-badge">
                                                        <i class="fas fa-user-check"></i> <?= htmlspecialchars($p['nama_lengkap']) ?>
                                                    </span>
                                                <?php endforeach; ?>

                                                <?php if(!$k['id_ustadz'] && empty($k['pengampu'])): ?>
                                                    <span style="font-size: 0.8rem; color: var(--danger); font-style: italic;">
                                                        <i class="fas fa-exclamation-triangle"></i> Belum ada pengajar
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-btns">
                                                <a href="<?= base_url('admin/kelas/edit/' . $k['id']) ?>" class="act-btn btn-edit" title="Edit Data">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/kelas/delete/' . $k['id']) ?>" class="act-btn btn-delete" title="Hapus Kelas" onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">
                                        <div class="empty-state">
                                            <i class="fas fa-school"></i>
                                            <p>Belum ada data kelas yang terdaftar.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
