<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET (Uniform Dashboard Premium) */
        :root {
            --primary: #1a5fb4; --primary-dark: #1c3d78; --secondary: #26a269;
            --accent: #e5a50a; --light: #f8f9fa; --dark: #2d3748;
            --gray: #718096; --light-gray: #e2e8f0; --danger: #e53e3e;
            --success: #38a169; --warning: #dd6b20; --info: #0ea5e9;
            --purple: #8b5cf6; --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --radius: 8px; --transition: all 0.3s ease;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f5f7fa; color: var(--dark); line-height: 1.6; overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 15px; }
        
        /* HEADER/NAVBAR */
        .dashboard-header { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); padding: 0; position: sticky; top: 0; z-index: 1000; }
        .header-content { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; }
        .logo-section { display: flex; align-items: center; gap: 15px; }
        .logo { display: flex; align-items: center; gap: 12px; padding: 8px 12px; border-radius: var(--radius); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); }
        .logo img { height: 36px; border-radius: 6px; }
        .logo-text { font-size: 1.4rem; font-weight: 700; color: white; letter-spacing: 0.5px; }
        .logo-text span { color: var(--accent); }
        
        .mobile-menu-toggle { display: none; background: rgba(255, 255, 255, 0.15); border: none; color: white; font-size: 1.4rem; width: 44px; height: 44px; border-radius: var(--radius); cursor: pointer; transition: var(--transition); align-items: center; justify-content: center; }
        .mobile-menu-toggle:hover { background: rgba(255, 255, 255, 0.25); }
        
        .user-section { display: flex; align-items: center; gap: 15px; }
        .notification-bell { position: relative; background: rgba(255, 255, 255, 0.15); width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; transition: var(--transition); }
        .notification-bell:hover { background: rgba(255, 255, 255, 0.25); }
        .notification-badge { position: absolute; top: -2px; right: -2px; background: var(--accent); color: white; font-size: 0.7rem; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        
        .user-info { display: flex; align-items: center; gap: 12px; padding: 8px 16px; border-radius: var(--radius); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); transition: var(--transition); cursor: pointer; }
        .user-info:hover { background: rgba(255, 255, 255, 0.2); }
        .user-avatar { width: 42px; height: 42px; border-radius: 50%; overflow: hidden; background: linear-gradient(135deg, var(--purple) 0%, var(--info) 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.1rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); }
        .user-details { color: white; }
        .user-name { font-weight: 600; font-size: 0.95rem; }
        .user-role { font-size: 0.8rem; opacity: 0.9; }
        
        .user-dropdown { position: relative; }
        .dropdown-menu { position: absolute; top: 100%; right: 0; width: 200px; background: white; border-radius: var(--radius); box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); margin-top: 10px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: var(--transition); z-index: 100; }
        .dropdown-menu.active { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: var(--dark); transition: var(--transition); border-bottom: 1px solid var(--light-gray); }
        .dropdown-item:last-child { border-bottom: none; }
        .dropdown-item:hover { background: var(--light); color: var(--primary); }
        .dropdown-item i { width: 20px; text-align: center; color: var(--gray); }
        .dropdown-item:hover i { color: var(--primary); }
        .logout-btn { color: var(--danger); }
        .logout-btn:hover { background: rgba(229, 62, 62, 0.1); }
        
        /* DASHBOARD LAYOUT */
        .dashboard-container { display: flex; min-height: calc(100vh - 68px); }
        .sidebar { width: 280px; background: linear-gradient(180deg, var(--primary-dark) 0%, #152a57 100%); color: white; padding: 20px 0; transition: var(--transition); position: relative; z-index: 99; box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1); }
        .sidebar-header { padding: 0 20px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 20px; }
        .welcome-text { font-size: 1.1rem; margin-bottom: 5px; opacity: 0.9; }
        .admin-name { font-weight: 700; font-size: 1.2rem; color: var(--accent); }
        .sidebar-menu { padding: 0 15px; }
        .menu-item { margin-bottom: 5px; }
        .menu-item a { display: flex; align-items: center; padding: 14px 15px; border-radius: var(--radius); transition: var(--transition); }
        .menu-item a:hover, .menu-item.active a { background: rgba(255, 255, 255, 0.1); transform: translateX(5px); }
        .menu-item i { margin-right: 12px; width: 20px; text-align: center; font-size: 1.1rem; }
        
        .dashboard-content { flex: 1; padding: 30px; background-color: #f5f7fa; overflow-y: auto; transition: var(--transition); }
        .page-title { font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        
        /* PAGE SPECIFIC STYLES */
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); flex-wrap: wrap; gap: 10px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); display: flex; align-items: center; gap: 10px; }
        
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: .85rem; cursor: pointer; transition: .2s; border: none; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }
        
        .filter-bar { padding: 16px 24px; background: var(--light); border-bottom: 1px solid var(--light-gray); display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .filter-label { font-size: .85rem; font-weight: 600; color: var(--gray); display: flex; align-items: center; gap: 6px; }
        .select-filter { padding: 6px 12px; border: 1px solid var(--light-gray); border-radius: 6px; font-size: .85rem; color: var(--dark); outline: none; background: #fff; }

        .table-responsive { overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { text-align: left; padding: 12px 24px; background: var(--light); font-size: .75rem; text-transform: uppercase; letter-spacing: .5px; color: var(--gray); font-weight: 700; border-bottom: 1px solid var(--light-gray); }
        .table td { padding: 14px 24px; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
        .table tr:last-child td { border-bottom: none; }
        .table tr:hover { background: #f8fafc; }

        /* Kelas specific styles */
        .kelas-cell { display: flex; align-items: center; gap: 12px; }
        .kelas-icon { width: 48px; height: 48px; border-radius: 12px; background: rgba(26, 95, 180, 0.08); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
        .kelas-info .kelas-name { font-size: .875rem; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
        .kelas-info .kelas-desc { font-size: .75rem; color: var(--gray); }
        
        .teacher-list { display: flex; flex-direction: column; gap: 6px; }
        .teacher-badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 20px; font-size: .75rem; font-weight: 600; background: var(--light); border: 1px solid var(--light-gray); color: var(--dark); width: fit-content; }
        .teacher-badge.primary { background: rgba(26, 95, 180, 0.08); border-color: rgba(26, 95, 180, 0.2); color: var(--primary); }
        .teacher-badge i { font-size: 0.7rem; }
        .empty-teacher { font-size: 0.75rem; color: var(--danger); font-style: italic; display: flex; align-items: center; gap: 6px; }

        .action-cell { display: flex; gap: 8px; flex-wrap: wrap; }
        .act-btn { width: 32px; height: 32px; border-radius: 8px; border: none; display: flex; align-items: center; justify-content: center; font-size: .85rem; cursor: pointer; transition: .2s; outline: none; color: #fff; }
        .act-edit { background: var(--primary); }
        .act-edit:hover { background: var(--primary-dark); }
        .act-delete { background: var(--danger); }
        .act-delete:hover { background: #c53030; }

        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); border-left: 4px solid var(--success); }
        .alert-danger  { background: rgba(229,62,62,.1);  color: #c53030; border: 1px solid rgba(229,62,62,.2); border-left: 4px solid var(--danger); }

        .empty-state { text-align: center; padding: 60px; color: var(--gray); }
        .empty-state-icon { background: rgba(0,0,0,0.02); border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
        .empty-state-icon i { font-size: 3rem; color: var(--light-gray); }
        .empty-state h3 { margin-bottom: 8px; color: var(--dark); font-weight: 600; }
        .empty-state p { font-size: 0.85rem; }

        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; transition: var(--transition); }
        
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-container { position: relative; }
            .sidebar { position: absolute; left: -280px; height: 100%; box-shadow: none; }
            .sidebar.active { left: 0; box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2); }
            .sidebar-overlay.active { display: block; opacity: 1; }
            .user-name, .user-role { display: none; }
            .user-info { padding: 5px; background: transparent; }
        }
        
        /* TABLE CARDS ON MOBILE */
        @media (max-width: 768px) {
            .page-title { font-size: 1.5rem; }
            .dashboard-content { padding: 20px 15px; }
            .table thead { display: none; }
            .table, .table tbody, .table tr, .table td { display: block; width: 100%; }
            .table tr { margin-bottom: 15px; padding: 15px; border-radius: 12px; border: 1px solid var(--light-gray); background: #fff; box-shadow: 0 2px 6px rgba(0,0,0,.04); }
            .table td { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px dashed var(--light-gray); text-align: right; }
            .table td:last-child { border-bottom: none; }
            .table td::before { content: attr(data-label); font-weight: 600; color: var(--gray); font-size: .75rem; text-transform: uppercase; float: left; text-align: left; }
            .kelas-cell { justify-content: flex-end; }
            .teacher-list { align-items: flex-end; }
        }
    </style>
</head>
<body>

    <!-- HEADER/NAVBAR -->
    <header class="dashboard-header">
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <button class="mobile-menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a href="<?= base_url('admin/dashboard') ?>" class="logo" style="text-decoration:none;">
                        <img src="<?= base_url('assets/img/logo-ptq.jpg') ?>" alt="Logo PTQ">
                        <div class="logo-text">PTQ <span>Pencongan</span></div>
                    </a>
                </div>
                
                <div class="user-section">
                    <div class="notification-bell">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">0</span>
                    </div>
                    
                    <div class="user-dropdown">
                        <div class="user-info" id="userDropdownToggle">
                            <div class="user-avatar"><?= strtoupper(substr(session()->get('nama_lengkap') ?? 'A', 0, 2)) ?></div>
                            <div class="user-details">
                                <div class="user-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Administrator') ?></div>
                                <div class="user-role">Administrator</div>
                            </div>
                            <i class="fas fa-chevron-down" style="font-size: 0.9rem; color: rgba(255,255,255,0.7);"></i>
                        </div>
                        <div class="dropdown-menu" id="userDropdown">
                            <a href="<?= base_url('auth/logout') ?>" class="dropdown-item logout-btn" id="logoutBtn"><i class="fas fa-sign-out-alt"></i><span>Keluar</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <!-- SIDEBAR -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="welcome-text">Selamat Datang,</div>
                <div class="admin-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Administrator') ?></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/users') ?>"><i class="fas fa-users-cog"></i><span>Manajemen Akun</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/santri') ?>"><i class="fas fa-user-graduate"></i><span>Data Santri</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/ustadz') ?>"><i class="fas fa-chalkboard-teacher"></i><span>Data Ustadz</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('admin/kelas') ?>"><i class="fas fa-school"></i><span>Data Kelas</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/hafalan') ?>"><i class="fas fa-quran"></i><span>Progres Hafalan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pembayaran') ?>"><i class="fas fa-money-bill-wave"></i><span>Keuangan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pengumuman') ?>"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></div>
            </div>
        </div>

        <div class="dashboard-content">
            <h1 class="page-title"><i class="fas fa-school"></i> Data Kelas & Rombel</h1>

            <!-- ALERTS -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(26,95,180,.1);color:var(--primary);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-door-open"></i>
                        </div>
                        Daftar Kelas Aktif
                    </div>
                    <a href="<?= base_url('admin/kelas/create') ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Kelas
                    </a>
                </div>
                
                <div class="filter-bar">
                    <div class="filter-label"><i class="fas fa-chalkboard-teacher"></i> Tim Pengajar:</div>
                    <span style="font-size: 0.85rem; color: var(--gray);">Daftar seluruh ustadz yang mengampu di setiap kelas.</span>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Informasi Kelas</th>
                                <th>Tim Pengajar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($kelas)): ?>
                                <?php foreach($kelas as $k): ?>
                                    <tr>
                                        <td data-label="Informasi Kelas">
                                            <div class="kelas-cell">
                                                <div class="kelas-icon">
                                                    <i class="fas fa-door-open"></i>
                                                </div>
                                                <div class="kelas-info">
                                                    <div class="kelas-name"><?= htmlspecialchars($k['nama_kelas']) ?></div>
                                                    <div class="kelas-desc"><?= htmlspecialchars($k['deskripsi'] ?: 'Tidak ada deskripsi') ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Tim Pengajar">
                                            <div class="teacher-list">
                                                <?php if(!empty($k['pengampu'])): ?>
                                                    <?php foreach($k['pengampu'] as $p): ?>
                                                        <span class="teacher-badge">
                                                            <i class="fas fa-chalkboard-teacher"></i> <?= htmlspecialchars($p['nama_lengkap']) ?>
                                                        </span>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <span class="empty-teacher">
                                                        <i class="fas fa-exclamation-triangle"></i> Belum ada pengajar
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td data-label="Aksi">
                                            <div class="action-cell">
                                                <a href="<?= base_url('admin/kelas/edit/' . $k['id']) ?>" class="act-btn act-edit" title="Edit Data">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('admin/kelas/delete/' . $k['id']) ?>" class="act-btn act-delete" title="Hapus Kelas" onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini? Semua data santri dalam kelas akan terpengaruh.')">
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
                                            <div class="empty-state-icon">
                                                <i class="fas fa-school"></i>
                                            </div>
                                            <h3>Belum Ada Data Kelas</h3>
                                            <p>Silakan tambah kelas baru melalui tombol "Tambah Kelas" di atas.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- INFORMASI -->
            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(14,165,233,.1);color:var(--info);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        Informasi Data Kelas
                    </div>
                </div>
                <div style="padding: 20px 24px;">
                    <ul style="margin-left: 20px;">
                        <li>• <strong>Tim Pengajar</strong> - Daftar ustadz yang mengajar dan mengelola data santri di kelas tersebut.</li>
                        <li>• <strong>Penghapusan kelas</strong> - Akan mempengaruhi data santri yang terdaftar di kelas ini.</li>
                    </ul>
                    <p style="margin-top: 15px; padding-top: 12px; border-top: 1px solid var(--light-gray); font-size: 0.85rem; color: var(--gray);">
                        <i class="fas fa-chalkboard"></i> Setiap kelas dapat dikelola oleh satu atau lebih pengajar.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('menuToggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        });
        document.getElementById('sidebarOverlay').addEventListener('click', () => {
            document.getElementById('sidebar').classList.remove('active');
            document.getElementById('sidebarOverlay').classList.remove('active');
        });
        
        // User dropdown
        document.getElementById('userDropdownToggle').addEventListener('click', (e) => {
            e.stopPropagation();
            document.getElementById('userDropdown').classList.toggle('active');
        });
        document.addEventListener('click', () => {
            document.getElementById('userDropdown').classList.remove('active');
        });


        // Auto hide alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => { 
                alert.style.opacity = '0'; 
                alert.style.transition = 'opacity 0.4s';
                setTimeout(() => alert.remove(), 400); 
            }, 5000);
        });
    </script>
</body>
</html>