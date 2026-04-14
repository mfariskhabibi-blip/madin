<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Wali Murid - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET - Consistent with Ustadz Pages */
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
        .logout-btn:hover { background: rgba(229, 62, 62, 0.1); color: var(--danger); }
        
        .notification-bell { position: relative; background: rgba(255, 255, 255, 0.15); width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; transition: var(--transition); }
        .notification-bell:hover { background: rgba(255, 255, 255, 0.25); }
        .notification-badge { position: absolute; top: -2px; right: -2px; background: var(--accent); color: white; font-size: 0.7rem; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        
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
        .welcome-stats {
            display: flex;
            gap: 25px;
            margin-top: 10px;
            flex-wrap: wrap;
        }
        .welcome-stat {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.15);
            padding: 8px 16px;
            border-radius: 30px;
        }
        .welcome-stat i { font-size: 1rem; opacity: 0.8; }
        .welcome-stat span { font-weight: 600; }
        
        /* STATS CARDS - 3 cards in one row */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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
        
        /* CHILDREN GRID */
        .children-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .child-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: var(--transition);
        }
        
        .child-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .child-header {
            background: rgba(26, 95, 180, 0.05);
            padding: 20px;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .child-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--info) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .child-meta h4 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 4px;
        }
        
        .child-meta p {
            font-size: 0.75rem;
            color: var(--gray);
        }
        
        .child-body {
            padding: 20px;
        }
        
        .child-info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 0.85rem;
        }
        
        .child-info-item span:first-child {
            color: var(--gray);
        }
        
        .child-info-item span:last-child {
            font-weight: 600;
            color: var(--dark);
        }
        
        /* BADGES */
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        .badge-aktif { background: rgba(38, 162, 105, 0.1); color: var(--success); }
        .badge-primary { background: rgba(26, 95, 180, 0.1); color: var(--primary); }
        
        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.75rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: var(--light-gray); color: var(--dark); }
        .btn-secondary:hover { background: #d1d9e6; }
        .btn-sm { padding: 6px 12px; font-size: 0.7rem; }
        
        /* ANNOUNCEMENT STYLES */
        .announcement-item {
            padding: 20px 24px;
            border-bottom: 1px solid var(--light-gray);
            transition: var(--transition);
        }
        .announcement-item:last-child { border-bottom: none; }
        .announcement-item:hover { background: #f8fafc; }
        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .announcement-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary-dark);
        }
        .announcement-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            background: rgba(229, 165, 10, 0.1);
            color: var(--accent);
        }
        .announcement-content {
            color: var(--dark);
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .announcement-date {
            font-size: 0.75rem;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        /* ALERT */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border-left: 4px solid var(--success); }
        
        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 60px 20px; color: var(--gray); background: white; border-radius: var(--radius); }
        .empty-state i { font-size: 4rem; color: var(--light-gray); margin-bottom: 20px; }
        .empty-state h3 { font-size: 1.3rem; color: var(--dark); margin-bottom: 10px; font-weight: 600; }
        .empty-state p { font-size: 0.95rem; }
        
        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; }
        
        /* RESPONSIVE */
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-container { position: relative; }
            .sidebar { position: absolute; left: -280px; height: 100%; }
            .sidebar.active { left: 0; box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2); }
            .sidebar-overlay.active { display: block; opacity: 1; }
            .user-name, .user-role { display: none; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
        }
        
        @media (max-width: 768px) {
            .page-title { font-size: 1.5rem; }
            .dashboard-content { padding: 20px 15px; }
            .welcome-card { padding: 20px; }
            .welcome-card h2 { font-size: 1.2rem; }
            .welcome-stats { gap: 12px; }
            .welcome-stat { padding: 6px 12px; font-size: 0.8rem; }
            .stats-grid { grid-template-columns: 1fr; gap: 15px; }
            .children-grid { grid-template-columns: 1fr; }
            .card-header { flex-direction: column; align-items: flex-start; }
        }
        
        @media (max-width: 576px) {
            .stat-card { padding: 15px; }
            .stat-value { font-size: 1.6rem; }
            .stat-icon { width: 45px; height: 45px; font-size: 1.3rem; }
            .child-header { padding: 15px; }
            .child-body { padding: 15px; }
            .announcement-header { flex-direction: column; align-items: flex-start; }
            .announcement-title { font-size: 0.95rem; }
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
                    <a href="<?= base_url('ortu/dashboard') ?>" class="logo" style="text-decoration:none;">
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
                                    $nama = $nama_ortu ?? 'WM';
                                    $words = explode(' ', $nama);
                                    $initials = '';
                                    foreach($words as $word) {
                                        $initials .= strtoupper(substr($word, 0, 1));
                                        if(strlen($initials) >= 2) break;
                                    }
                                    echo $initials ?: 'WM';
                                ?>
                            </div>
                            <div class="user-details">
                                <div class="user-name"><?= htmlspecialchars($nama_ortu ?? 'Wali Murid') ?></div>
                                <div class="user-role">Wali Murid</div>
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
                <div class="admin-name"><?= htmlspecialchars($nama_ortu ?? 'Wali Murid') ?></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item active"><a href="<?= base_url('ortu/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/progres') ?>"><i class="fas fa-chart-line"></i><span>Progres Santri</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/hafalan') ?>"><i class="fas fa-quran"></i><span>Hafalan Anak</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/kehadiran') ?>"><i class="fas fa-calendar-check"></i><span>Kehadiran</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/pembayaran') ?>"><i class="fas fa-wallet"></i><span>Pembayaran</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/jadwal') ?>"><i class="fas fa-calendar-alt"></i><span>Jadwal</span></a></div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <h1 class="page-title"><i class="fas fa-tachometer-alt"></i> Dashboard Wali Murid</h1>

            <!-- Alert Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <!-- WELCOME CARD -->
            <div class="welcome-card">
                <h2>Assalamu'alaikum, <?= htmlspecialchars(explode(' ', $nama_ortu ?? 'Wali Murid')[0]) ?>!</h2>
                <p>Pantau perkembangan pendidikan dan administrasi putra-putri Anda di satu tempat.</p>
                <div class="welcome-stats">
                    <div class="welcome-stat"><i class="fas fa-children"></i> <span><?= count($anak ?? []) ?> Santri</span></div>
                    <div class="welcome-stat"><i class="fas fa-file-invoice-dollar"></i> <span><?= $tagihan_aktif ?? 0 ?> Tagihan Aktif</span></div>
                    <div class="welcome-stat"><i class="fas fa-chart-line"></i> <span>Terintegrasi</span></div>
                </div>
            </div>

            <!-- PENGUMUMAN SECTION -->
            <?php if(!empty($pengumuman)): ?>
            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(229,165,10,.1);color:var(--accent);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        Pengumuman Terbaru
                    </div>
                </div>
                <?php foreach($pengumuman as $p): ?>
                <div class="announcement-item">
                    <div class="announcement-header">
                        <div class="announcement-title"><?= htmlspecialchars($p['judul'] ?? 'Pengumuman') ?></div>
                        <span class="announcement-badge"><i class="fas fa-tag"></i> <?= htmlspecialchars($p['kategori'] ?? 'Informasi') ?></span>
                    </div>
                    <div class="announcement-content">
                        <?= nl2br(htmlspecialchars(substr($p['konten'] ?? '', 0, 200))) ?>
                        <?php if(strlen($p['konten'] ?? '') > 200): ?>...<?php endif; ?>
                    </div>
                    <div class="announcement-date">
                        <i class="fas fa-calendar"></i> <?= date('d/m/Y H:i', strtotime($p['created_at'] ?? 'now')) ?>
                        <i class="fas fa-user" style="margin-left: 12px;"></i> <?= htmlspecialchars($p['nama_penulis'] ?? 'Admin') ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- STATS CARDS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= count($anak ?? []) ?></div>
                        <div class="stat-label">Total Santri</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-children"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= $tagihan_aktif ?? 0 ?></div>
                        <div class="stat-label">Tagihan Pending</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= $total_hafalan ?? 0 ?></div>
                        <div class="stat-label">Total Setoran Hafalan</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-quran"></i></div>
                </div>
            </div>

            <!-- PROFIL PUTRA-PUTRI -->
            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(26,95,180,.1);color:var(--primary);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        Profil Putra-Putri Anda
                    </div>
                </div>
                
                <div style="padding: 20px 24px;">
                    <?php if(!empty($anak)): ?>
                        <div class="children-grid">
                            <?php foreach($anak as $s): ?>
                                <div class="child-card">
                                    <div class="child-header">
                                        <div class="child-img"><?= strtoupper(substr($s['nama_santri'], 0, 1)) ?></div>
                                        <div class="child-meta">
                                            <h4><?= htmlspecialchars($s['nama_santri']) ?></h4>
                                            <p>NIS: <?= htmlspecialchars($s['nis'] ?? '-') ?></p>
                                        </div>
                                    </div>
                                    <div class="child-body">
                                        <div class="child-info-item">
                                            <span>Kelas</span>
                                            <span><?= htmlspecialchars($s['nama_kelas'] ?? 'Belum Ditentukan') ?></span>
                                        </div>
                                        <div class="child-info-item">
                                            <span>Ustadz Pengajar</span>
                                            <span>
                                                <?php if(!empty($s['ustadz_list'])): ?>
                                                    <?php foreach($s['ustadz_list'] as $u): ?>
                                                        <span style="display:inline-block; background:rgba(26,95,180,0.1); color:var(--primary); padding:3px 10px; border-radius:15px; font-size:0.8rem; font-weight:600; margin:2px 0;">
                                                            <i class="fas fa-chalkboard-teacher" style="font-size:0.7rem;"></i>
                                                            <?= htmlspecialchars($u['nama_lengkap']) ?>
                                                        </span>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    Belum Ditentukan
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        <div class="child-info-item">
                                            <span>Status</span>
                                            <span><span class="badge badge-aktif"><?= ucfirst($s['status'] ?? 'Aktif') ?></span></span>
                                        </div>
                                        <div style="display: flex; gap: 10px; margin-top: 15px;">
                                            <a href="<?= base_url('ortu/hafalan') ?>" class="btn btn-secondary btn-sm" style="flex:1;"><i class="fas fa-book"></i> Rapor Hafalan</a>
                                            <a href="<?= base_url('ortu/pembayaran') ?>" class="btn btn-primary btn-sm" style="flex:1;"><i class="fas fa-wallet"></i> Cek Tagihan</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <i class="fas fa-user-slash"></i>
                            <h3>Belum Ada Data Santri</h3>
                            <p>Belum ada data anak yang tertaut dengan akun Anda. Silakan hubungi Administrator.</p>
                        </div>
                    <?php endif; ?>
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
                    <p style="margin-bottom: 12px;">Dashboard Wali Murid PTQ Pencongan memungkinkan Anda untuk:</p>
                    <ul style="margin-left: 20px; margin-bottom: 15px;">
                        <li>• Memantau hafalan Al-Qur'an putra-putri Anda</li>
                        <li>• Melihat rekam kehadiran santri</li>
                        <li>• Mengecek tagihan dan pembayaran</li>
                        <li>• Mendapatkan pengumuman terbaru dari sekolah</li>
                    </ul>
                    <p style="margin-top: 15px; padding-top: 12px; border-top: 1px solid var(--light-gray);">Gunakan menu di sebelah kiri untuk mengakses informasi lengkap tentang perkembangan pendidikan putra-putri Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle logic
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
        
        // User dropdown logic
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