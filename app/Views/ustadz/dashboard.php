<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Ustadz - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET - Consistent with All Pages */
        :root {
            --primary: #1a5fb4; --primary-dark: #1c3d78; --secondary: #26a269;
            --accent: #e5a50a; --light: #f8f9fa; --gray: #718096;
            --light-gray: #e2e8f0; --dark: #2d3748; --danger: #e53e3e;
            --success: #38a169; --warning: #dd6b20; --info: #0ea5e9;
            --purple: #8b5cf6; --shadow: 0 4px 6px rgba(0,0,0,0.1);
            --radius: 8px; --transition: all 0.3s ease;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f5f7fa; color: var(--dark); overflow-x: hidden; line-height: 1.6; }
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
        
        .mobile-menu-toggle { display: none; background: rgba(255, 255, 255, 0.15); border: none; color: white; font-size: 1.4rem; width: 44px; height: 44px; border-radius: var(--radius); cursor: pointer; align-items: center; justify-content: center; transition: var(--transition); }
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
        .page-title { font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 25px; display: flex; align-items: center; gap: 12px; font-weight: 800; letter-spacing: -0.5px; }
        
        /* SECTION CARD */
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); flex-wrap: wrap; gap: 10px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px; }
        
        /* STATS CARDS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
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
            font-size: 0.75rem;
            color: var(--gray);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            background: rgba(26, 95, 180, 0.08);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            box-shadow: inset 0 0 0 1px rgba(26, 95, 180, 0.1);
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
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
        
        .student-cell { display: flex; flex-direction: column; }
        .student-name { font-weight: 700; color: var(--primary-dark); font-size: 0.9rem; }
        .student-nis { font-size: 0.7rem; color: var(--gray); font-family: monospace; margin-top: 2px; }
        
        .score-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.8rem;
            background: rgba(229, 165, 10, 0.1);
            color: var(--accent);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border: 1px solid rgba(229, 165, 10, 0.15);
        }
        
        /* ANNOUNCEMENT STYLES */
        .announcement-item {
            padding: 16px 20px;
            border-bottom: 1px solid var(--light-gray);
            transition: var(--transition);
        }
        .announcement-item:last-child { border-bottom: none; }
        .announcement-item:hover { background: #f8fafc; }
        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
            flex-wrap: wrap;
            gap: 8px;
        }
        .announcement-title {
            font-size: 0.95rem;
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
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .announcement-content {
            color: var(--dark);
            font-size: 0.85rem;
            line-height: 1.5;
            margin-bottom: 8px;
        }
        .announcement-date {
            font-size: 0.7rem;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        /* WELCOME BANNER */
        .welcome-banner {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 12px;
            padding: 35px 40px;
            margin-bottom: 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            box-shadow: 0 10px 20px rgba(26, 95, 180, 0.2);
            position: relative;
            overflow: hidden;
        }
        .welcome-banner::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }
        .welcome-banner h2 { font-size: 1.8rem; margin-bottom: 10px; font-weight: 700; }
        .welcome-banner p { opacity: 0.9; margin-bottom: 0; font-size: 1rem; max-width: 600px; }
        .banner-date {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 12px 24px;
            border-radius: 30px;
            font-size: 0.95rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* ALERT */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); border-left: 4px solid var(--success); }
        
        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; }
        
        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .quick-actions { grid-template-columns: repeat(2, 1fr); }
        }
        
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-container { position: relative; }
            .sidebar { position: absolute; left: -280px; height: 100%; }
            .sidebar.active { left: 0; box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2); }
            .sidebar-overlay.active { display: block; opacity: 1; }
            .user-name, .user-role { display: none; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
            .quick-actions { grid-template-columns: repeat(2, 1fr); gap: 15px; }
        }
        
        @media (max-width: 768px) {
            .page-title { font-size: 1.5rem; }
            .dashboard-content { padding: 20px 15px; }
            .stats-grid { grid-template-columns: 1fr; }
            .quick-actions { grid-template-columns: 1fr; }
            .welcome-banner { padding: 20px; flex-direction: column; align-items: flex-start; }
            .welcome-banner h2 { font-size: 1.2rem; }
            .table thead { display: none; }
            .table, .table tbody, .table tr, .table td { display: block; width: 100%; }
            .table tr { margin-bottom: 15px; padding: 15px; border-radius: 12px; border: 1px solid var(--light-gray); background: #fff; box-shadow: 0 2px 6px rgba(0,0,0,.04); }
            .table td { display: flex; justify-content: space-between; align-items: flex-start; padding: 10px 0; border-bottom: 1px dashed var(--light-gray); text-align: right; }
            .table td:last-child { border-bottom: none; }
            .table td::before { content: attr(data-label); font-weight: 600; color: var(--gray); font-size: .75rem; text-transform: uppercase; float: left; text-align: left; width: 40%; }
            .card-header { flex-direction: column; align-items: flex-start; }
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
                    <a href="<?= base_url('ustadz/dashboard') ?>" class="logo" style="text-decoration:none;">
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
                                    $nama = session()->get('nama_lengkap') ?? 'US';
                                    $words = explode(' ', $nama);
                                    $initials = '';
                                    foreach($words as $word) {
                                        $initials .= strtoupper(substr($word, 0, 1));
                                        if(strlen($initials) >= 2) break;
                                    }
                                    echo $initials ?: 'US';
                                ?>
                            </div>
                            <div class="user-details">
                                <div class="user-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Ustadz') ?></div>
                                <div class="user-role">Ustadz/Pengajar</div>
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
                <div class="welcome-text">Selamat Mengajar,</div>
                <div class="admin-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Ustadz') ?></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item active"><a href="<?= base_url('ustadz/dashboard') ?>"><i class="fas fa-th-large"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/santri') ?>"><i class="fas fa-graduation-cap"></i><span>Santri Binaan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/absensi') ?>"><i class="fas fa-user-check"></i><span>Absensi Santri</span></a></div>
                
                <div style="padding: 15px 15px 5px; color: rgba(255,255,255,0.4); font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Manajemen Hafalan</div>
                <div class="menu-item"><a href="<?= base_url('ustadz/hafalan') ?>"><i class="fas fa-book-open"></i><span>Setoran Hafalan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/murojaah') ?>"><i class="fas fa-sync-alt"></i><span>Muroja'ah</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/progres-kelas') ?>"><i class="fas fa-chart-line"></i><span>Progres Kelas</span></a></div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <h1 class="page-title"><i class="fas fa-th-large"></i> Dashboard Ustadz</h1>

            <!-- Alert Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <!-- WELCOME BANNER -->
            <div class="welcome-banner">
                <div>
                    <h2>Assalamu'alaikum, <?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Ustadz') ?>!</h2>
                    <p>Selamat datang kembali di sistem manajemen PTQ Pencongan. Mari bantu santri mencapai target hafalannya hari ini.</p>
                </div>
                <div class="banner-date">
                    <i class="fas fa-calendar-check"></i>
                    <?= date('d F Y') ?>
                </div>
            </div>

            <!-- QUICK ACTIONS -->
            <div class="quick-actions">
                <div class="action-card" onclick="window.location.href='<?= base_url('ustadz/absensi') ?>'">
                    <div class="action-icon" style="background: var(--primary);"><i class="fas fa-clipboard-list"></i></div>
                    <div class="action-info">
                        <div class="action-title">Isi Absensi</div>
                        <div class="action-desc">Catat kehadiran santri</div>
                    </div>
                </div>
                <div class="action-card" onclick="window.location.href='<?= base_url('ustadz/hafalan') ?>'">
                    <div class="action-icon" style="background: var(--success);"><i class="fas fa-plus-circle"></i></div>
                    <div class="action-info">
                        <div class="action-title">Catat Setoran</div>
                        <div class="action-desc">Input hafalan santri</div>
                    </div>
                </div>
                <div class="action-card" onclick="window.location.href='<?= base_url('ustadz/santri') ?>'">
                    <div class="action-icon" style="background: var(--warning);"><i class="fas fa-users"></i></div>
                    <div class="action-info">
                        <div class="action-title">Santri Binaan</div>
                        <div class="action-desc">Lihat daftar santri</div>
                    </div>
                </div>
                <div class="action-card" onclick="window.location.href='<?= base_url('ustadz/jadwal') ?>'">
                    <div class="action-icon" style="background: var(--info);"><i class="fas fa-calendar-alt"></i></div>
                    <div class="action-info">
                        <div class="action-title">Jadwal Saya</div>
                        <div class="action-desc">Lihat jadwal mengajar</div>
                    </div>
                </div>
            </div>

            <!-- STATS CARDS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= $total_santri ?? 0 ?></div>
                        <div class="stat-label">Santri Binaan</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= $total_kelas ?? 0 ?></div>
                        <div class="stat-label">Kelas Diajar</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-door-open"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= $kehadiran ?? 0 ?>%</div>
                        <div class="stat-label">Kehadiran Hari Ini</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                </div>
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-value"><?= $avg_nilai ?? 0 ?></div>
                        <div class="stat-label">Rata-rata Nilai</div>
                    </div>
                    <div class="stat-icon"><i class="fas fa-star"></i></div>
                </div>
            </div>

            <!-- DASHBOARD GRID: 2 COLUMNS -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 22px;">
                <!-- LEFT: RECENT HAFALAN -->
                <div class="section-card">
                    <div class="card-header">
                        <div class="card-title">
                            <div style="width:36px;height:36px;border-radius:8px;background:rgba(26,95,180,.1);color:var(--primary);display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-history"></i>
                            </div>
                            Setoran Hafalan Terkini
                        </div>
                        <a href="<?= base_url('ustadz/hafalan') ?>" style="color:var(--primary); font-size:0.85rem;">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr><th>Santri</th><th>Hafalan</th><th>Nilai</th><th>Tanggal</th></tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($recent_hafalan)): ?>
                                    <?php foreach($recent_hafalan as $h): ?>
                                    <tr>
                                        <td data-label="Santri">
                                            <div class="student-cell">
                                                <span class="student-name"><?= htmlspecialchars($h['nama_santri']) ?></span>
                                                <span class="student-nis"><?= htmlspecialchars($h['nis'] ?? '-') ?></span>
                                            </div>
                                        </td>
                                        <td data-label="Hafalan">
                                            <div style="font-weight: 600;"><?= htmlspecialchars($h['surah']) ?></div>
                                            <div style="font-size: 0.75rem; color: var(--gray);">Ayat <?= $h['ayat_awal'] ?> - <?= $h['ayat_akhir'] ?></div>
                                        </td>
                                        <td data-label="Nilai"><span class="score-badge"><?= number_format($h['nilai'], 1) ?></span></td>
                                        <td data-label="Tanggal" style="color: var(--gray);"><?= date('d M Y', strtotime($h['tanggal'])) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" style="text-align:center;padding:40px;color:var(--gray);">Belum ada setoran tercatat.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- RIGHT: PENGUMUMAN -->
                <div class="section-card">
                    <div class="card-header">
                        <div class="card-title">
                            <div style="width:36px;height:36px;border-radius:8px;background:rgba(229,165,10,.1);color:var(--accent);display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            Pengumuman Terbaru
                        </div>
                    </div>
                    <?php if(!empty($pengumuman)): ?>
                        <?php foreach($pengumuman as $p): ?>
                        <div class="announcement-item">
                            <div class="announcement-header">
                                <div class="announcement-title"><?= htmlspecialchars($p['judul'] ?? 'Pengumuman') ?></div>
                                <span class="announcement-badge"><i class="fas fa-tag"></i> <?= htmlspecialchars($p['kategori'] ?? 'Informasi') ?></span>
                            </div>
                            <div class="announcement-content">
                                <?= nl2br(htmlspecialchars(substr($p['konten'] ?? '', 0, 120))) ?>
                                <?php if(strlen($p['konten'] ?? '') > 120): ?>...<?php endif; ?>
                            </div>
                            <div class="announcement-date">
                                <i class="fas fa-calendar"></i> <?= date('d/m/Y H:i', strtotime($p['created_at'] ?? 'now')) ?>
                                <i class="fas fa-user" style="margin-left: 8px;"></i> <?= htmlspecialchars($p['nama_penulis'] ?? 'Admin') ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="text-align:center; padding:40px; color:var(--gray);">
                            <i class="fas fa-bullhorn" style="font-size:2rem; margin-bottom:10px; opacity:0.3;"></i>
                            <p>Tidak ada pengumuman terbaru.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- INFORMASI DASHBOARD -->
            <div class="section-card" style="margin-top: 22px; border-top: 4px solid var(--info);">
                <div class="card-header" style="background: rgba(14, 165, 233, 0.02);">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(14,165,233,.1);color:var(--info);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        Panduan Cepat Dashboard
                    </div>
                </div>
                <div style="padding: 24px;">
                    <p style="margin-bottom: 15px; color: var(--gray); font-size: 0.95rem;">Gunakan dashboard ini untuk memantau aktivitas harian santri bimbingan Anda:</p>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <i class="fas fa-check-double" style="color: var(--success); margin-top: 4px;"></i>
                            <div>
                                <span style="display: block; font-weight: 700; font-size: 0.9rem;">Manajemen Kehadiran</span>
                                <span style="font-size: 0.8rem; color: var(--gray);">Pastikan absensi diisi setiap hari sebelum kelas dimulai.</span>
                            </div>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <i class="fas fa-star" style="color: var(--accent); margin-top: 4px;"></i>
                            <div>
                                <span style="display: block; font-weight: 700; font-size: 0.9rem;">Pencatatan Hafalan</span>
                                <span style="font-size: 0.8rem; color: var(--gray);">Input nilai kelancaran dan surat yang sedang dihafal.</span>
                            </div>
                        </div>
                    </div>
                    <p style="margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--light-gray); font-size: 0.85rem; color: var(--gray);">
                        Saat ini Anda mengampu <strong><?= $total_kelas ?? 0 ?> kelas</strong> dengan total <strong><?= $total_santri ?? 0 ?> santri</strong>.
                    </p>
                </div>
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