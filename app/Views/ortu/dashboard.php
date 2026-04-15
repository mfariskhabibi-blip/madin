<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
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
        .header-content { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; gap: 12px; flex-wrap: wrap; }
        .logo-section { display: flex; align-items: center; gap: 15px; flex: 1; }
        .logo { display: flex; align-items: center; gap: 12px; padding: 8px 12px; border-radius: var(--radius); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); }
        .logo img { height: 36px; border-radius: 6px; }
        .logo-text { font-size: 1.4rem; font-weight: 700; color: white; letter-spacing: 0.5px; }
        .logo-text span { color: var(--accent); }
        
        .mobile-menu-toggle { display: none; background: rgba(255, 255, 255, 0.15); border: none; color: white; font-size: 1.4rem; width: 44px; height: 44px; border-radius: var(--radius); cursor: pointer; transition: var(--transition); align-items: center; justify-content: center; }
        .mobile-menu-toggle:hover { background: rgba(255, 255, 255, 0.25); }
        
        .user-section { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
        .user-info { display: flex; align-items: center; gap: 12px; padding: 6px 14px; border-radius: var(--radius); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); transition: var(--transition); cursor: pointer; }
        .user-info:hover { background: rgba(255, 255, 255, 0.2); }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; overflow: hidden; background: linear-gradient(135deg, var(--purple) 0%, var(--info) 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); flex-shrink: 0; }
        .user-details { color: white; display: block; }
        .user-name { font-weight: 600; font-size: 0.9rem; line-height: 1.3; }
        .user-role { font-size: 0.7rem; opacity: 0.9; }
        
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
        
        .notification-bell { position: relative; background: rgba(255, 255, 255, 0.15); width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; transition: var(--transition); flex-shrink: 0; }
        .notification-bell:hover { background: rgba(255, 255, 255, 0.25); }
        .notification-badge { position: absolute; top: -2px; right: -2px; background: var(--accent); color: white; font-size: 0.7rem; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        
        /* DASHBOARD LAYOUT - improved for mobile */
        .dashboard-container { display: flex; min-height: calc(100vh - 68px); position: relative; }
        .sidebar { width: 280px; background: linear-gradient(180deg, var(--primary-dark) 0%, #152a57 100%); color: white; padding: 20px 0; transition: transform 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1); position: fixed; top: 68px; left: 0; bottom: 0; z-index: 99; transform: translateX(-100%); box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1); overflow-y: auto; }
        .sidebar.active { transform: translateX(0); }
        .sidebar-header { padding: 0 20px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 20px; }
        .welcome-text { font-size: 1rem; margin-bottom: 5px; opacity: 0.9; }
        .admin-name { font-weight: 700; font-size: 1.2rem; color: var(--accent); word-break: break-word; }
        .sidebar-menu { padding: 0 15px; }
        .menu-item { margin-bottom: 5px; }
        .menu-item a { display: flex; align-items: center; padding: 12px 15px; border-radius: var(--radius); transition: var(--transition); font-size: 0.95rem; }
        .menu-item a:hover, .menu-item.active a { background: rgba(255, 255, 255, 0.1); transform: translateX(5px); }
        .menu-item i { margin-right: 12px; width: 20px; text-align: center; font-size: 1rem; }
        
        .dashboard-content { flex: 1; padding: 20px 16px; background-color: #f5f7fa; transition: margin-left 0.3s; width: 100%; margin-left: 0; }
        .page-title { font-size: 1.5rem; color: var(--primary-dark); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        
        /* SECTION CARD */
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 18px; border-bottom: 1px solid var(--light-gray); flex-wrap: wrap; gap: 8px; }
        .card-title { font-size: 1rem; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px; }
        
        /* WELCOME CARD */
        .welcome-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: var(--radius);
            padding: 20px 18px;
            margin-bottom: 24px;
            color: white;
        }
        .welcome-card h2 { font-size: 1.3rem; margin-bottom: 6px; word-break: break-word; }
        .welcome-card p { opacity: 0.9; margin-bottom: 12px; font-size: 0.9rem; }
        .welcome-stats { display: flex; gap: 12px; margin-top: 8px; flex-wrap: wrap; }
        .welcome-stat { display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.15); padding: 6px 14px; border-radius: 30px; font-size: 0.8rem; }
        .welcome-stat i { font-size: 0.85rem; opacity: 0.8; }
        .welcome-stat span { font-weight: 600; }
        
        /* STATS CARDS - responsive grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        
        .stat-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: var(--transition);
        }
        
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); }
        .stat-info { flex: 1; }
        .stat-value { font-size: 1.8rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 4px; line-height: 1.2; }
        .stat-label { font-size: 0.75rem; color: var(--gray); font-weight: 500; }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; background: rgba(26, 95, 180, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
        
        /* CHILDREN GRID */
        .children-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 18px;
            margin-bottom: 8px;
        }
        
        .child-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: var(--transition);
        }
        
        .child-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); }
        .child-header { background: rgba(26, 95, 180, 0.05); padding: 16px; border-bottom: 1px solid var(--light-gray); display: flex; align-items: center; gap: 12px; }
        .child-img { width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, var(--primary) 0%, var(--info) 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.1rem; flex-shrink: 0; }
        .child-meta h4 { font-size: 0.95rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 4px; }
        .child-meta p { font-size: 0.7rem; color: var(--gray); }
        .child-body { padding: 16px; }
        .child-info-item { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 0.8rem; flex-wrap: wrap; gap: 6px; }
        .child-info-item span:first-child { color: var(--gray); }
        .child-info-item span:last-child { font-weight: 600; color: var(--dark); text-align: right; flex: 1; }
        
        /* BADGES */
        .badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; }
        .badge-aktif { background: rgba(38, 162, 105, 0.1); color: var(--success); }
        .badge-primary { background: rgba(26, 95, 180, 0.1); color: var(--primary); }
        
        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.7rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: var(--light-gray); color: var(--dark); }
        .btn-secondary:hover { background: #d1d9e6; }
        .btn-sm { padding: 6px 10px; font-size: 0.7rem; }
        
        /* ANNOUNCEMENT STYLES */
        .announcement-item { padding: 16px 18px; border-bottom: 1px solid var(--light-gray); transition: var(--transition); }
        .announcement-item:last-child { border-bottom: none; }
        .announcement-item:hover { background: #f8fafc; }
        .announcement-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px; flex-wrap: wrap; gap: 8px; }
        .announcement-title { font-size: 0.95rem; font-weight: 700; color: var(--primary-dark); }
        .announcement-badge { padding: 3px 10px; border-radius: 20px; font-size: 0.65rem; font-weight: 600; background: rgba(229, 165, 10, 0.1); color: var(--accent); white-space: nowrap; }
        .announcement-content { color: var(--dark); font-size: 0.85rem; line-height: 1.5; margin-bottom: 8px; word-break: break-word; }
        .announcement-date { font-size: 0.7rem; color: var(--gray); display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
        
        /* ALERT */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: 0.85rem; animation: fadeInDown 0.4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border-left: 4px solid var(--success); }
        
        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 40px 20px; color: var(--gray); background: white; border-radius: var(--radius); }
        .empty-state i { font-size: 3rem; color: var(--light-gray); margin-bottom: 16px; }
        .empty-state h3 { font-size: 1.2rem; color: var(--dark); margin-bottom: 8px; font-weight: 600; }
        .empty-state p { font-size: 0.85rem; }
        
        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; transition: opacity 0.3s; pointer-events: none; }
        .sidebar-overlay.active { display: block; opacity: 1; pointer-events: auto; }
        
        /* RESPONSIVE FIXES - MOBILE FIRST IMPROVED */
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-content { padding: 16px; }
            .user-name, .user-role { display: block; }
            .user-info { padding: 6px 12px; }
        }
        
        @media (max-width: 768px) {
            .header-content { padding: 10px 0; }
            .logo-text { font-size: 1.1rem; }
            .logo img { height: 30px; }
            .logo { padding: 6px 10px; gap: 8px; }
            .page-title { font-size: 1.3rem; margin-bottom: 16px; }
            .welcome-card { padding: 16px; }
            .welcome-card h2 { font-size: 1.1rem; }
            .welcome-stats { gap: 8px; }
            .welcome-stat { padding: 4px 10px; font-size: 0.7rem; }
            .stats-grid { gap: 12px; grid-template-columns: 1fr; }
            .stat-card { padding: 12px; }
            .stat-value { font-size: 1.5rem; }
            .stat-icon { width: 42px; height: 42px; font-size: 1.2rem; }
            .children-grid { grid-template-columns: 1fr; gap: 16px; }
            .card-header { padding: 14px 16px; }
            .card-title { font-size: 0.95rem; }
            .child-header { padding: 14px; }
            .child-body { padding: 14px; }
            .announcement-item { padding: 14px; }
            .announcement-title { font-size: 0.9rem; }
            .user-details { display: none; } /* compact mobile */
            .user-info { padding: 6px 8px; gap: 6px; }
            .user-avatar { width: 36px; height: 36px; font-size: 0.9rem; }
            .notification-bell { width: 38px; height: 38px; }
        }
        
        @media (max-width: 576px) {
            .dashboard-content { padding: 12px; }
            .page-title { font-size: 1.2rem; }
            .welcome-card { padding: 14px; }
            .welcome-card h2 { font-size: 1rem; }
            .welcome-card p { font-size: 0.8rem; }
            .stat-value { font-size: 1.3rem; }
            .stat-label { font-size: 0.7rem; }
            .btn-sm { padding: 5px 8px; font-size: 0.65rem; }
            .child-info-item { flex-direction: column; align-items: flex-start; gap: 2px; }
            .child-info-item span:last-child { text-align: left; }
            .announcement-header { flex-direction: column; align-items: flex-start; }
            .announcement-badge { white-space: normal; }
            .sidebar { width: 260px; }
        }
        
        /* Fix for very small devices */
        @media (max-width: 400px) {
            .logo-text { font-size: 0.9rem; }
            .user-avatar { width: 32px; height: 32px; }
            .notification-bell { width: 34px; height: 34px; font-size: 0.9rem; }
        }
        
        /* restore desktop sidebar behavior */
        @media (min-width: 993px) {
            .sidebar { transform: translateX(0); position: relative; top: 0; bottom: auto; }
            .mobile-menu-toggle { display: none; }
            .sidebar-overlay { display: none !important; }
            .dashboard-content { margin-left: 0; }
            .user-details { display: block; }
        }
    </style>
</head>
<body>

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
                            <i class="fas fa-chevron-down" style="font-size: 0.8rem; color: rgba(255,255,255,0.7);"></i>
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

    <div class="dashboard-container">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
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

        <div class="dashboard-content" id="mainContent">
            <h1 class="page-title"><i class="fas fa-tachometer-alt"></i> Dashboard Wali Murid</h1>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <div class="welcome-card">
                <h2>Assalamu'alaikum, <?= htmlspecialchars(explode(' ', $nama_ortu ?? 'Wali Murid')[0]) ?>!</h2>
                <p>Pantau perkembangan pendidikan dan administrasi putra-putri Anda di satu tempat.</p>
                <div class="welcome-stats">
                    <div class="welcome-stat"><i class="fas fa-children"></i> <span><?= count($anak ?? []) ?> Santri</span></div>
                    <div class="welcome-stat"><i class="fas fa-file-invoice-dollar"></i> <span><?= $tagihan_aktif ?? 0 ?> Tagihan Aktif</span></div>
                    <div class="welcome-stat"><i class="fas fa-chart-line"></i> <span>Terintegrasi</span></div>
                </div>
            </div>

            <?php if(!empty($pengumuman)): ?>
            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:32px;height:32px;border-radius:8px;background:rgba(229,165,10,.1);color:var(--accent);display:flex;align-items:center;justify-content:center;">
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
                        <i class="fas fa-user" style="margin-left: 8px;"></i> <?= htmlspecialchars($p['nama_penulis'] ?? 'Admin') ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

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

            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:32px;height:32px;border-radius:8px;background:rgba(26,95,180,.1);color:var(--primary);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        Profil Putra-Putri Anda
                    </div>
                </div>
                
                <div style="padding: 16px 18px;">
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
                                                        <span style="display:inline-block; background:rgba(26,95,180,0.1); color:var(--primary); padding:2px 8px; border-radius:15px; font-size:0.7rem; font-weight:600; margin:2px 2px;">
                                                            <i class="fas fa-chalkboard-teacher" style="font-size:0.65rem;"></i>
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
                                        <div style="display: flex; gap: 10px; margin-top: 15px; flex-wrap: wrap;">
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

            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:32px;height:32px;border-radius:8px;background:rgba(14,165,233,.1);color:var(--info);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        Informasi Dashboard
                    </div>
                </div>
                <div style="padding: 16px 18px;">
                    <p style="margin-bottom: 10px; font-size: 0.85rem;">Dashboard Wali Murid PTQ Pencongan memungkinkan Anda untuk:</p>
                    <ul style="margin-left: 18px; margin-bottom: 12px; font-size: 0.85rem;">
                        <li>• Memantau hafalan Al-Qur'an putra-putri Anda</li>
                        <li>• Melihat rekam kehadiran santri</li>
                        <li>• Mengecek tagihan dan pembayaran</li>
                        <li>• Mendapatkan pengumuman terbaru dari sekolah</li>
                    </ul>
                    <p style="margin-top: 12px; padding-top: 10px; border-top: 1px solid var(--light-gray); font-size: 0.8rem;">Gunakan menu di sebelah kiri untuk mengakses informasi lengkap tentang perkembangan pendidikan putra-putri Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        function closeSidebar() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        if(menuToggle) {
            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            });
        }
        
        if(sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebar);
        }
        
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');
        
        if(userDropdownToggle) {
            userDropdownToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdown.classList.toggle('active');
            });
        }
        
        document.addEventListener('click', function(e) {
            if(userDropdown && userDropdownToggle && !userDropdown.contains(e.target) && !userDropdownToggle.contains(e.target)) {
                userDropdown.classList.remove('active');
            }
        });
        
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const logoutUrl = this.getAttribute('href');
                const modalHtml = `
                <div id="logoutModal" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity 0.3s;backdrop-filter:blur(3px);">
                    <div style="background:white;padding:25px;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.2);text-align:center;max-width:320px;width:90%;transform:translateY(-20px);transition:transform 0.3s;">
                        <div style="width:55px;height:55px;background:rgba(229,62,62,0.1);color:#e53e3e;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.8rem;margin:0 auto 12px;">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <h3 style="margin-bottom:8px;color:#2d3748;font-size:1.1rem;font-weight:700;">Konfirmasi Keluar</h3>
                        <p style="color:#718096;margin-bottom:22px;font-size:0.9rem;">Apakah Anda yakin ingin keluar dari sistem PTQ Pencongan?</p>
                        <div style="display:flex;gap:10px;justify-content:center;">
                            <button id="cancelLogout" style="padding:8px 16px;border-radius:8px;border:1px solid #e2e8f0;background:white;color:#4a5568;font-weight:600;cursor:pointer;flex:1;transition:all 0.2s;">Batal</button>
                            <a href="${logoutUrl}" style="padding:8px 16px;border-radius:8px;border:none;background:#e53e3e;color:white;font-weight:600;cursor:pointer;text-decoration:none;flex:1;display:flex;align-items:center;justify-content:center;">Ya, Keluar</a>
                        </div>
                    </div>
                </div>`;
                document.body.insertAdjacentHTML('beforeend', modalHtml);
                const modal = document.getElementById('logoutModal');
                const cancelBtn = document.getElementById('cancelLogout');
                setTimeout(() => {
                    if(modal) {
                        modal.style.opacity = '1';
                        if(modal.children[0]) modal.children[0].style.transform = 'translateY(0)';
                    }
                }, 10);
                const closeModal = () => {
                    if(modal) {
                        modal.style.opacity = '0';
                        if(modal.children[0]) modal.children[0].style.transform = 'translateY(-20px)';
                        setTimeout(() => modal.remove(), 300);
                    }
                };
                if(cancelBtn) cancelBtn.addEventListener('click', closeModal);
                if(modal) modal.addEventListener('click', (ev) => { if(ev.target === modal) closeModal(); });
            });
        }
        
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) closeSidebar();
            });
        });
        
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 400);
            }, 5000);
        });
        
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992 && sidebar.classList.contains('active')) {
                closeSidebar();
            }
            if (window.innerWidth > 992) {
                sidebar.style.transform = '';
            } else {
                if(!sidebar.classList.contains('active')) sidebar.style.transform = '';
            }
        });
    </script>
</body>
</html>