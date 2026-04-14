<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrator - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET - Consistent with All Pages */
        :root {
            --primary: #1a5fb4;
            --primary-dark: #1c3d78;
            --secondary: #26a269;
            --accent: #e5a50a;
            --light: #f8f9fa;
            --dark: #2d3748;
            --gray: #718096;
            --light-gray: #e2e8f0;
            --danger: #e53e3e;
            --success: #38a169;
            --warning: #dd6b20;
            --info: #0ea5e9;
            --purple: #8b5cf6;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --radius: 8px;
            --transition: all 0.3s ease;
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
        
        /* SECTION CARD */
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); flex-wrap: wrap; gap: 10px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px; }
        
        /* STATS CARDS - 6 cards in responsive grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -20%;
            width: 100px;
            height: 100px;
            background: rgba(26, 95, 180, 0.03);
            border-radius: 50%;
        }
        
        .stat-info {
            flex: 1;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: var(--gray);
            font-weight: 500;
        }
        
        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            background: rgba(26, 95, 180, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
        }
        
        /* QUICK ACTIONS */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .action-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: var(--transition);
            cursor: pointer;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: white;
        }
        
        .action-info {
            flex: 1;
        }
        
        .action-title {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--dark);
            margin-bottom: 4px;
        }
        
        .action-desc {
            font-size: 0.75rem;
            color: var(--gray);
        }
        
        /* TABLE STYLES */
        .table-responsive { overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { text-align: left; padding: 12px 24px; background: var(--light); font-size: .75rem; text-transform: uppercase; letter-spacing: .5px; color: var(--gray); font-weight: 700; border-bottom: 1px solid var(--light-gray); }
        .table td { padding: 14px 24px; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
        .table tr:hover { background: #f8fafc; }
        
        /* BADGES */
        .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; }
        .badge-success { background: rgba(56, 161, 105, 0.1); color: var(--success); }
        .badge-warning { background: rgba(221, 107, 32, 0.1); color: var(--warning); }
        
        /* ALERT */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border-left: 4px solid var(--success); }
        
        /* WELCOME CARD */
        .welcome-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: var(--radius);
            padding: 25px 30px;
            margin-bottom: 30px;
            color: white;
        }
        .welcome-card h2 { font-size: 1.5rem; margin-bottom: 8px; }
        .welcome-card p { opacity: 0.9; margin-bottom: 15px; }
        
        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; }
        
        /* RESPONSIVE */
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-container { position: relative; }
            .sidebar { position: absolute; left: -280px; height: 100%; box-shadow: none; }
            .sidebar.active { left: 0; box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2); }
            .sidebar-overlay.active { display: block; opacity: 1; }
            .user-name, .user-role { display: none; }
            .user-info { padding: 5px; background: transparent; }
            .quick-actions { grid-template-columns: repeat(2, 1fr); gap: 15px; }
        }
        
        @media (max-width: 768px) {
            .page-title { font-size: 1.5rem; }
            .dashboard-content { padding: 20px 15px; }
            .stats-grid { grid-template-columns: 1fr; gap: 15px; }
            .quick-actions { grid-template-columns: 1fr; gap: 15px; }
            .welcome-card { padding: 20px; }
            .welcome-card h2 { font-size: 1.2rem; }
            .table thead { display: none; }
            .table tr { display: block; margin-bottom: 15px; padding: 15px; border-radius: 12px; border: 1px solid var(--light-gray); background: #fff; }
            .table td { display: flex; justify-content: space-between; align-items: flex-start; padding: 10px 0; border-bottom: 1px dashed var(--light-gray); text-align: right; }
            .table td:last-child { border-bottom: none; }
            .table td::before { content: attr(data-label); font-weight: 600; color: var(--gray); font-size: .75rem; text-transform: uppercase; float: left; text-align: left; width: 40%; }
        }
        
        @media (max-width: 576px) {
            .stat-card { padding: 15px; }
            .stat-value { font-size: 1.6rem; }
            .stat-icon { width: 45px; height: 45px; font-size: 1.3rem; }
            .action-card { padding: 15px; }
            .action-icon { width: 45px; height: 45px; font-size: 1.2rem; }
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
                            <div class="user-avatar">
                                <?php 
                                    $nama = $nama_admin ?? 'AD';
                                    $words = explode(' ', $nama);
                                    $initials = '';
                                    foreach($words as $word) {
                                        $initials .= strtoupper(substr($word, 0, 1));
                                        if(strlen($initials) >= 2) break;
                                    }
                                    echo $initials ?: 'AD';
                                ?>
                            </div>
                            <div class="user-details">
                                <div class="user-name"><?= htmlspecialchars($nama_admin ?? 'Administrator') ?></div>
                                <div class="user-role">Administrator</div>
                            </div>
                            <i class="fas fa-chevron-down" style="font-size: 0.9rem; color: rgba(255,255,255,0.7);"></i>
                        </div>
                        
                        <div class="dropdown-menu" id="userDropdown">
                            <a href="#" class="dropdown-item"><i class="fas fa-user"></i><span>Profil Saya</span></a>
                            <a href="#" class="dropdown-item"><i class="fas fa-cog"></i><span>Pengaturan</span></a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('auth/logout') ?>" class="dropdown-item logout-btn" id="logoutBtn"><i class="fas fa-sign-out-alt"></i><span>Keluar</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- DASHBOARD LAYOUT -->
    <div class="dashboard-container">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <!-- SIDEBAR -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="welcome-text">Selamat Datang,</div>
                <div class="admin-name"><?= htmlspecialchars($nama_admin ?? 'Administrator') ?></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item active"><a href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/users') ?>"><i class="fas fa-users-cog"></i><span>Manajemen Akun</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/santri') ?>"><i class="fas fa-user-graduate"></i><span>Data Santri</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/ustadz') ?>"><i class="fas fa-chalkboard-teacher"></i><span>Data Ustadz</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/kelas') ?>"><i class="fas fa-school"></i><span>Data Kelas</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/hafalan') ?>"><i class="fas fa-quran"></i><span>Progres Hafalan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pembayaran') ?>"><i class="fas fa-money-bill-wave"></i><span>Keuangan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pengumuman') ?>"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <h1 class="page-title"><i class="fas fa-tachometer-alt"></i> Dashboard Administrator</h1>

            <!-- Alert Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <!-- WELCOME CARD -->
            <div class="welcome-card">
                <h2>Assalamu'alaikum, <?= htmlspecialchars($nama_admin ?? 'Administrator') ?>!</h2>
                <p>Selamat datang di Dashboard Administrator PTQ Pencongan. Kelola seluruh sistem pesantren dari satu platform terintegrasi.</p>
            </div>

            <!-- QUICK ACTIONS -->
            <div class="quick-actions">
                <div class="action-card" onclick="window.location.href='<?= base_url('admin/users') ?>'">
                    <div class="action-icon" style="background: var(--primary);"><i class="fas fa-users-cog"></i></div>
                    <div class="action-info">
                        <div class="action-title">Manajemen Akun</div>
                        <div class="action-desc">Kelola akses pengguna</div>
                    </div>
                </div>
                <div class="action-card" onclick="window.location.href='<?= base_url('admin/santri') ?>'">
                    <div class="action-icon" style="background: var(--success);"><i class="fas fa-user-graduate"></i></div>
                    <div class="action-info">
                        <div class="action-title">Data Santri</div>
                        <div class="action-desc">Kelola data peserta didik</div>
                    </div>
                </div>
                <div class="action-card" onclick="window.location.href='<?= base_url('admin/pembayaran') ?>'">
                    <div class="action-icon" style="background: var(--warning);"><i class="fas fa-money-bill-wave"></i></div>
                    <div class="action-info">
                        <div class="action-title">Keuangan</div>
                        <div class="action-desc">Cek status pembayaran</div>
                    </div>
                </div>
                <div class="action-card" onclick="window.location.href='<?= base_url('admin/laporan') ?>'">
                    <div class="action-icon" style="background: var(--info);"><i class="fas fa-file-alt"></i></div>
                    <div class="action-info">
                        <div class="action-title">Laporan</div>
                        <div class="action-desc">Data dan statistik lembaga</div>
                    </div>
                </div>
            </div>

            <!-- STATS CARDS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= $total_santri ?? 0 ?></div>
                        <div class="stat-label">Total Santri Aktif</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= $total_pengajar ?? 0 ?></div>
                        <div class="stat-label">Total Pengajar / Ustadz</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= $total_kelas ?? 0 ?></div>
                        <div class="stat-label">Total Kelas Aktif</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-school"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= $pembayaran_belum_lunas ?? 0 ?></div>
                        <div class="stat-label">Tagihan Belum Lunas</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= isset($santri_terbaru) && is_array($santri_terbaru) ? count($santri_terbaru) : 0 ?></div>
                        <div class="stat-label">Pendaftar Baru</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-user-plus"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= $persentase_kehadiran ?? 0 ?>%</div>
                        <div class="stat-label">Kehadiran Rata-rata</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                </div>
            </div>

            <!-- TRANSAKSI PEMBAYARAN TERAKHIR -->
            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(26,95,180,.1);color:var(--primary);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        Transaksi Pembayaran Terakhir
                    </div>
                    <a href="<?= base_url('admin/pembayaran') ?>" style="color:var(--primary); font-size:0.85rem;">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Santri</th>
                                <th>Jenis Tagihan</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($pembayaran_terakhir)): ?>
                                <?php foreach($pembayaran_terakhir as $pembayaran): ?>
                                    <tr>
                                        <td data-label="Nama Santri"><strong><?= htmlspecialchars($pembayaran['nama_santri'] ?? '-') ?></strong></td>
                                        <td data-label="Jenis Tagihan"><?= htmlspecialchars($pembayaran['jenis_pembayaran'] ?? '-') ?></td>
                                        <td data-label="Tanggal"><?= date('d/m/Y', strtotime($pembayaran['tanggal'] ?? date('Y-m-d'))) ?></td>
                                        <td data-label="Jumlah"><strong>Rp <?= number_format($pembayaran['jumlah'] ?? 0, 0, ',', '.') ?></strong></td>
                                        <td data-label="Status">
                                            <?php if(($pembayaran['status'] ?? '') === 'Lunas'): ?>
                                                <span class="badge badge-success"><i class="fas fa-check-circle"></i> Lunas</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning"><i class="fas fa-clock"></i> <?= htmlspecialchars($pembayaran['status'] ?? 'Pending') ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;padding:40px;color:var(--gray);">
                                        <i class="fas fa-money-bill-wave" style="font-size:2rem; margin-bottom:10px; color:var(--light-gray);"></i>
                                        <p>Belum ada data pembayaran</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- INFORMASI DASHBOARD -->
            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(14,165,233,.1);color:var(--info);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        Informasi Dashboard
                    </div>
                </div>
                <div style="padding: 20px 24px;">
                    <p style="margin-bottom: 12px;">Dashboard Administrator PTQ Pencongan memberikan Anda kontrol penuh atas sistem manajemen pesantren. Anda dapat mengelola:</p>
                    <ul style="margin-left: 20px; margin-bottom: 15px;">
                        <li>• Akses Pengguna & Keamanan Sistem</li>
                        <li>• Data Pokok Santri dan Ustadz/Pengajar</li>
                        <li>• Administrasi Keuangan & Pembayaran</li>
                        <li>• Jadwal Kegiatan & Pemantauan Prestasi Hafalan</li>
                        <li>• Pengumuman dan Informasi untuk Seluruh Civitas</li>
                    </ul>
                    <p style="margin-top: 15px; padding-top: 12px; border-top: 1px solid var(--light-gray); font-size: 0.85rem; color: var(--gray);">
                        <i class="fas fa-chart-line"></i> Gunakan menu di sebelah kiri atau tombol aksi cepat untuk mengakses fitur-fitur manajemen.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar logic
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
        });
        
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        // User dropdown
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');
        
        userDropdownToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('active');
        });
        
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && !userDropdownToggle.contains(e.target)) {
                userDropdown.classList.remove('active');
            }
        });
        
        // Logout confirmation
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin keluar dari sistem?')) {
                    window.location.href = this.getAttribute('href');
                }
            });
        }
        
        // Close sidebar when clicking on menu item (mobile)
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
        
        // Auto hide alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 400);
            }, 5000);
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    </script>
</body>
</html>