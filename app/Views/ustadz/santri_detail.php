<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title><?= $judul ?> - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET - Consistent with All Pages */
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
        
        /* HEADER/NAVBAR - SAME AS EXAMPLE */
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
        
        /* DASHBOARD LAYOUT - SAME AS EXAMPLE */
        .dashboard-container { display: flex; min-height: calc(100vh - 68px); position: relative; }
        .sidebar { width: 280px; background: linear-gradient(180deg, var(--primary-dark) 0%, #152a57 100%); color: white; padding: 20px 0; transition: transform 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1); position: fixed; top: 68px; left: 0; bottom: 0; z-index: 99; transform: translateX(-100%); box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1); overflow-y: auto; }
        .sidebar.active { transform: translateX(0); }
        .sidebar-header { padding: 0 20px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 20px; }
        .welcome-text { font-size: 1rem; margin-bottom: 5px; opacity: 0.9; }
        .admin-name { font-weight: 700; font-size: 1.2rem; color: var(--accent); word-break: break-word; }
        .sidebar-menu { padding: 0 15px; }
        .menu-item { margin-bottom: 5px; }
        .menu-item a { display: flex; align-items: center; padding: 12px 15px; border-radius: var(--radius); transition: var(--transition); font-size: 0.95rem; color: white; }
        .menu-item a:hover, .menu-item.active a { background: rgba(255, 255, 255, 0.1); transform: translateX(5px); }
        .menu-item i { margin-right: 12px; width: 20px; text-align: center; font-size: 1rem; }
        
        .dashboard-content { flex: 1; padding: 20px 16px; background-color: #f5f7fa; transition: margin-left 0.3s; width: 100%; margin-left: 0; }
        
        /* DETAIL PAGE STYLES */
        .top-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px; }
        .btn-back { display: inline-flex; align-items: center; gap: 8px; background: white; padding: 8px 16px; border-radius: 6px; color: var(--gray); font-weight: 600; font-size: 0.8rem; box-shadow: var(--shadow); transition: var(--transition); border: 1px solid var(--light-gray); }
        .btn-back:hover { color: var(--primary); transform: translateX(-3px); }
        
        .profile-card { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); border-radius: 12px; padding: 24px 28px; color: white; margin-bottom: 24px; display: flex; align-items: center; gap: 24px; flex-wrap: wrap; box-shadow: 0 10px 20px rgba(26, 95, 180, 0.2); }
        .profile-img { width: 80px; height: 80px; border-radius: 50%; background: white; color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700; border: 3px solid rgba(255, 255, 255, 0.3); flex-shrink: 0; }
        .profile-info h1 { font-size: 1.5rem; margin-bottom: 8px; }
        .profile-meta { display: flex; gap: 12px; align-items: center; flex-wrap: wrap; margin-top: 8px; }
        .badge-info { background: rgba(255, 255, 255, 0.2); padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 6px; }

        /* Stats overview */
        .stats-overview { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: white; border-radius: 12px; padding: 16px; display: flex; align-items: center; gap: 12px; box-shadow: var(--shadow); transition: var(--transition); border: 1px solid var(--light-gray); }
        .stat-card:hover { transform: translateY(-3px); }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
        .stat-content { display: flex; flex-direction: column; }
        .stat-label { font-size: 0.7rem; color: var(--gray); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-val { font-size: 1.2rem; font-weight: 700; color: var(--dark); }

        .detail-row { display: grid; grid-template-columns: 340px 1fr; gap: 24px; }
        .col-left, .col-right { display: flex; flex-direction: column; gap: 20px; }

        .premium-card { background: white; border-radius: 12px; box-shadow: var(--shadow); overflow: hidden; border: 1px solid var(--light-gray); height: fit-content; }
        .premium-card-header { padding: 14px 18px; border-bottom: 1px solid var(--light-gray); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; }
        .premium-card-header h3 { font-size: 0.95rem; font-weight: 700; color: var(--primary-dark); display: flex; align-items: center; gap: 8px; }
        .premium-card-header h3 i { color: var(--primary); }

        .biodata-list { padding: 18px; }
        .biodata-item { margin-bottom: 16px; }
        .biodata-item:last-child { margin-bottom: 0; }
        .biodata-label { font-size: 0.7rem; color: var(--gray); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; margin-bottom: 4px; }
        .biodata-value { font-weight: 600; color: var(--dark); font-size: 0.85rem; word-break: break-word; }

        .history-list { padding: 18px; display: flex; flex-direction: column; gap: 12px; }
        .history-item { border: 1px solid var(--light-gray); border-radius: 10px; padding: 14px; display: flex; gap: 12px; transition: var(--transition); }
        .history-item:hover { border-color: var(--primary); background: #f8fafc; }
        
        .history-icon { width: 36px; height: 36px; border-radius: 8px; background: rgba(26, 95, 180, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0; }
        .history-content { flex: 1; }
        .history-date { font-size: 0.7rem; color: var(--gray); margin-bottom: 4px; }
        .history-title { font-size: 0.9rem; font-weight: 700; color: var(--dark); margin-bottom: 6px; }
        .history-meta { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 8px; }
        .status-badge { padding: 3px 10px; border-radius: 20px; font-size: 0.65rem; font-weight: 600; }
        .status-badge.lancar { background: rgba(56, 161, 105, 0.1); color: var(--success); }
        .status-badge.sedang { background: rgba(221, 107, 32, 0.1); color: var(--warning); }
        .status-badge.mengulang { background: rgba(229, 62, 62, 0.1); color: var(--danger); }
        
        .history-note { font-size: 0.75rem; color: var(--gray); font-style: italic; border-left: 3px solid var(--light-gray); padding-left: 10px; margin-top: 8px; }
        
        .empty-biodata { text-align: center; padding: 30px 20px; color: var(--gray); }
        .empty-biodata i { font-size: 2rem; margin-bottom: 10px; opacity: 0.3; display: block; }
        .empty-biodata p { font-size: 0.8rem; }

        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; transition: opacity 0.3s; pointer-events: none; }
        .sidebar-overlay.active { display: block; opacity: 1; pointer-events: auto; }
        
        /* RESPONSIVE - SAME AS EXAMPLE */
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-content { padding: 16px; }
            .user-name, .user-role { display: block; }
            .user-info { padding: 6px 12px; }
            .detail-row { grid-template-columns: 1fr; gap: 20px; }
            .stats-overview { grid-template-columns: repeat(2, 1fr); gap: 12px; }
        }
        
        @media (max-width: 768px) {
            .header-content { padding: 10px 0; }
            .logo-text { font-size: 1.1rem; }
            .logo img { height: 30px; }
            .logo { padding: 6px 10px; gap: 8px; }
            .dashboard-content { padding: 12px; }
            .profile-card { padding: 16px 20px; flex-direction: column; text-align: center; gap: 16px; }
            .profile-img { width: 70px; height: 70px; font-size: 1.5rem; }
            .profile-info h1 { font-size: 1.3rem; }
            .profile-meta { justify-content: center; }
            .stats-overview { grid-template-columns: 1fr 1fr; gap: 10px; }
            .stat-card { padding: 12px; gap: 10px; }
            .stat-icon { width: 38px; height: 38px; font-size: 0.9rem; }
            .stat-val { font-size: 1rem; }
            .premium-card-header { padding: 12px 14px; }
            .premium-card-header h3 { font-size: 0.85rem; }
            .biodata-list { padding: 14px; }
            .history-list { padding: 14px; }
            .history-item { padding: 12px; gap: 10px; }
            .history-title { font-size: 0.85rem; }
            
            .user-details { display: none; }
            .user-info { padding: 6px 8px; gap: 6px; }
            .user-avatar { width: 36px; height: 36px; font-size: 0.9rem; }
            .notification-bell { width: 38px; height: 38px; }
        }
        
        @media (max-width: 576px) {
            .dashboard-content { padding: 10px; }
            .profile-card { padding: 14px; }
            .profile-img { width: 60px; height: 60px; font-size: 1.2rem; }
            .profile-info h1 { font-size: 1.1rem; }
            .badge-info { font-size: 0.65rem; padding: 3px 8px; }
            .stats-overview { grid-template-columns: 1fr; gap: 8px; }
            .stat-card { padding: 10px; }
            .stat-icon { width: 34px; height: 34px; font-size: 0.8rem; }
            .stat-label { font-size: 0.65rem; }
            .stat-val { font-size: 0.9rem; }
            .premium-card-header { padding: 10px 12px; }
            .premium-card-header h3 { font-size: 0.8rem; }
            .biodata-list { padding: 12px; }
            .biodata-label { font-size: 0.65rem; }
            .biodata-value { font-size: 0.8rem; }
            .history-list { padding: 12px; gap: 10px; }
            .history-item { padding: 10px; }
            .history-title { font-size: 0.8rem; }
            .history-date { font-size: 0.65rem; }
            .history-note { font-size: 0.7rem; }
            .sidebar { width: 260px; }
        }
        
        @media (max-width: 400px) {
            .logo-text { font-size: 0.9rem; }
            .user-avatar { width: 32px; height: 32px; }
            .notification-bell { width: 34px; height: 34px; font-size: 0.9rem; }
        }
        
        /* restore desktop sidebar behavior - SAME AS EXAMPLE */
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

    <!-- HEADER/NAVBAR - SAME AS EXAMPLE -->
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

    <!-- DASHBOARD LAYOUT -->
    <div class="dashboard-container">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <!-- SIDEBAR - SAME STRUCTURE AS EXAMPLE -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="welcome-text">Selamat Mengajar,</div>
                <div class="admin-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Ustadz') ?></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('ustadz/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('ustadz/santri') ?>"><i class="fas fa-user-graduate"></i><span>Santri Binaan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/absensi') ?>"><i class="fas fa-calendar-check"></i><span>Absensi Santri</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/hafalan') ?>"><i class="fas fa-quran"></i><span>Setoran Hafalan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/murojaah') ?>"><i class="fas fa-sync-alt"></i><span>Muroja'ah</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/progres-kelas') ?>"><i class="fas fa-chart-line"></i><span>Progres Kelas</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/jadwal') ?>"><i class="fas fa-calendar-alt"></i><span>Jadwal Saya</span></a></div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <div class="top-nav">
                <a href="<?= base_url('ustadz/santri') ?>" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>

            <!-- PROFILE CARD -->
            <div class="profile-card">
                <div class="profile-img">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="profile-info">
                    <h1><?= htmlspecialchars($santri['nama_santri']) ?></h1>
                    <div class="profile-meta">
                        <span class="badge-info">NIS: <?= htmlspecialchars($santri['nis']) ?></span>
                        <span class="badge-info"><i class="fas fa-circle" style="font-size: 0.5rem; color: #4ade80;"></i> <?= ucfirst($santri['status']) ?></span>
                        <span class="badge-info"><i class="fas fa-school"></i> <?= htmlspecialchars($santri['nama_kelas'] ?? 'Belum Ada Kelas') ?></span>
                        <span class="badge-info"><i class="fas fa-star"></i> Avg: <?= $avg_nilai ?></span>
                    </div>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="stats-overview">
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(56, 161, 105, 0.1); color: var(--success);"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Hadir</span>
                        <span class="stat-val"><?= $stats_absensi['Hadir'] ?></span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(14, 165, 233, 0.1); color: var(--info);"><i class="fas fa-info-circle"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Izin/Sakit</span>
                        <span class="stat-val"><?= $stats_absensi['Izin'] + $stats_absensi['Sakit'] ?></span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(229, 62, 62, 0.1); color: var(--danger);"><i class="fas fa-times-circle"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Alpa</span>
                        <span class="stat-val"><?= $stats_absensi['Alpa'] ?></span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(229, 165, 10, 0.1); color: var(--accent);"><i class="fas fa-percentage"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Kehadiran</span>
                        <span class="stat-val"><?= $stats_absensi['Total'] > 0 ? round(($stats_absensi['Hadir'] / $stats_absensi['Total']) * 100) : 0 ?>%</span>
                    </div>
                </div>
            </div>

            <div class="detail-row">
                <!-- LEFT COLUMN - Biodata -->
                <div class="col-left">
                    <div class="premium-card">
                        <div class="premium-card-header">
                            <h3><i class="fas fa-id-card"></i> Biodata Santri</h3>
                        </div>
                        <div class="biodata-list">
                            <div class="biodata-item">
                                <p class="biodata-label">Jenis Kelamin</p>
                                <p class="biodata-value"><?= $santri['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
                            </div>
                            <div class="biodata-item">
                                <p class="biodata-label">Tempat, Tanggal Lahir</p>
                                <p class="biodata-value"><?= $santri['tanggal_lahir'] ? date('d F Y', strtotime($santri['tanggal_lahir'])) : '-' ?></p>
                            </div>
                            <div class="biodata-item">
                                <p class="biodata-label">Alamat Lengkap</p>
                                <p class="biodata-value"><?= htmlspecialchars($santri['alamat'] ?? '-') ?></p>
                            </div>
                            <div class="biodata-item">
                                <p class="biodata-label">Tahun Angkatan</p>
                                <p class="biodata-value"><?= date('Y', strtotime($santri['created_at'])) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- DATA ORANG TUA -->
                    <div class="premium-card">
                        <div class="premium-card-header">
                            <h3><i class="fas fa-user-friends"></i> Data Orang Tua</h3>
                        </div>
                        <div class="biodata-list">
                            <?php if ($parent): ?>
                                <div class="biodata-item">
                                    <p class="biodata-label">Nama Ayah</p>
                                    <p class="biodata-value"><?= htmlspecialchars($parent['nama_ayah'] ?? '-') ?></p>
                                </div>
                                <div class="biodata-item">
                                    <p class="biodata-label">No. HP Ayah</p>
                                    <p class="biodata-value"><?= htmlspecialchars($parent['no_telepon_ayah'] ?? '-') ?></p>
                                </div>
                                <div class="biodata-item">
                                    <p class="biodata-label">Nama Ibu</p>
                                    <p class="biodata-value"><?= htmlspecialchars($parent['nama_ibu'] ?? '-') ?></p>
                                </div>
                                <div class="biodata-item">
                                    <p class="biodata-label">No. HP Ibu</p>
                                    <p class="biodata-value"><?= htmlspecialchars($parent['no_telepon_ibu'] ?? '-') ?></p>
                                </div>
                            <?php else: ?>
                                <div class="empty-biodata">
                                    <i class="fas fa-user-slash"></i>
                                    <p>Data profil orang tua belum ditautkan.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN - Riwayat Hafalan -->
                <div class="col-right">
                    <div class="premium-card">
                        <div class="premium-card-header">
                            <h3><i class="fas fa-book-quran"></i> 10 Riwayat Setoran Terakhir</h3>
                            <a href="<?= base_url('ustadz/hafalan') ?>" style="color: var(--primary); font-weight: 700; font-size: 0.7rem;">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="history-list">
                            <?php if (!empty($riwayat_hafalan)): ?>
                                <?php foreach ($riwayat_hafalan as $r): ?>
                                    <div class="history-item">
                                        <div class="history-icon"><i class="fas fa-book-open"></i></div>
                                        <div class="history-content">
                                            <p class="history-date"><i class="fas fa-calendar-alt"></i> <?= date('d F Y', strtotime($r['tanggal'])) ?></p>
                                            <h4 class="history-title"><?= htmlspecialchars($r['surah']) ?> <span style="font-weight: 400; font-size: 0.75rem;">(Ayat <?= $r['ayat_awal'] ?>-<?= $r['ayat_akhir'] ?>)</span></h4>
                                            <div class="history-meta">
                                                <?php 
                                                    $sClass = strtolower($r['status']);
                                                    if($sClass == 'lancar') $sClass = 'lancar';
                                                    elseif($sClass == 'sedang') $sClass = 'sedang';
                                                    else $sClass = 'mengulang';
                                                ?>
                                                <span class="status-badge <?= $sClass ?>"><?= ucfirst($r['status']) ?></span>
                                                <?php if(isset($r['nilai'])): ?>
                                                    <span class="status-badge" style="background: rgba(139, 92, 246, 0.1); color: var(--purple);"><i class="fas fa-star"></i> Nilai: <?= $r['nilai'] ?>/9</span>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ($r['keterangan']): ?>
                                                <p class="history-note">"<?= htmlspecialchars($r['keterangan']) ?>"</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="empty-biodata" style="padding: 40px;">
                                    <i class="fas fa-book-half"></i>
                                    <p>Belum ada riwayat setoran hafalan untuk santri ini.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle logic - SAME AS EXAMPLE
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
        
        // User dropdown logic - SAME AS EXAMPLE
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');
        
        if(userDropdownToggle && userDropdown) {
            userDropdownToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdown.classList.toggle('active');
            });
            
            document.addEventListener('click', function(e) {
                if (!userDropdown.contains(e.target) && !userDropdownToggle.contains(e.target)) {
                    userDropdown.classList.remove('active');
                }
            });
        }
        
        // Logout confirmation modal - SAME AS EXAMPLE
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
        
        // Close sidebar when clicking on menu item (mobile) - SAME AS EXAMPLE
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) closeSidebar();
            });
        });
        
        // Handle window resize - SAME AS EXAMPLE
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