<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Progres Hafalan Kelas - PTQ Pencongan</title>
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
        .page-title { font-size: 1.5rem; color: var(--primary-dark); margin-bottom: 8px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .page-subtitle { color: var(--gray); font-size: 0.85rem; margin-bottom: 20px; }
        
        /* SECTION CARD */
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 18px; border-bottom: 1px solid var(--light-gray); flex-wrap: wrap; gap: 8px; }
        .card-title { font-size: 1rem; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px; }
        
        /* CLASS GRID */
        .class-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 20px; }
        .class-card { background: white; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; transition: var(--transition); border: 1px solid var(--light-gray); }
        .class-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); border-color: var(--primary); }
        
        .class-card-header { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); padding: 16px 18px; color: white; display: flex; justify-content: space-between; align-items: center; }
        .class-card-header h3 { font-size: 1rem; font-weight: 700; display: flex; align-items: center; gap: 8px; }
        .class-icon { width: 36px; height: 36px; background: rgba(255,255,255,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
        
        .class-card-body { padding: 16px; }
        .stat-item { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 10px; border-bottom: 1px solid var(--light-gray); }
        .stat-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .stat-label { font-size: 0.8rem; color: var(--gray); font-weight: 600; display: flex; align-items: center; gap: 8px; }
        .stat-label i { width: 18px; color: var(--primary); font-size: 0.8rem; }
        .stat-value { font-weight: 700; color: var(--dark); font-size: 0.85rem; }
        
        /* PROGRESS BAR */
        .progress-container { margin-top: 16px; padding-top: 12px; border-top: 1px solid var(--light-gray); }
        .progress-label { display: flex; justify-content: space-between; font-size: 0.7rem; font-weight: 700; margin-bottom: 6px; color: var(--gray); }
        .progress-bar { height: 6px; background: var(--light-gray); border-radius: 4px; overflow: hidden; }
        .progress-fill { height: 100%; background: var(--secondary); border-radius: 4px; transition: width 1s ease; }
        
        /* STUDENT TABLE */
        .student-section { margin-top: 18px; }
        .student-title { font-size: 0.7rem; font-weight: 800; color: var(--gray); text-transform: uppercase; margin-bottom: 10px; display: flex; align-items: center; gap: 6px; letter-spacing: 0.5px; }
        .student-table-container { max-height: 280px; overflow-y: auto; border: 1px solid var(--light-gray); border-radius: 8px; }
        .student-table { width: 100%; border-collapse: collapse; font-size: 0.8rem; }
        .student-table th { text-align: left; padding: 8px 10px; background: var(--light); color: var(--gray); font-weight: 700; text-transform: uppercase; font-size: 0.6rem; border-bottom: 2px solid var(--light-gray); position: sticky; top: 0; background: #f1f5f9; }
        .student-table td { padding: 10px; border-bottom: 1px solid var(--light-gray); vertical-align: middle; }
        .student-table tr:last-child td { border-bottom: none; }
        
        .s-name-cell { font-weight: 700; color: var(--dark); font-size: 0.8rem; }
        .s-nis-cell { font-size: 0.6rem; color: var(--gray); margin-top: 2px; }
        .s-surah-cell { color: var(--primary-dark); font-weight: 600; font-size: 0.75rem; }
        .s-ayat-cell { color: var(--gray); font-size: 0.65rem; margin-top: 2px; }

        .badge-mini { padding: 3px 8px; border-radius: 20px; font-size: 0.65rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }
        .badge-lancar { background: #ecfdf5; color: var(--success); border: 1px solid rgba(56,161,105,0.2); }
        .badge-mengulang { background: #fef2f2; color: var(--danger); border: 1px solid rgba(229,62,62,0.2); }
        .badge-none { background: #f1f5f9; color: #94a3b8; }
        
        .card-footer { padding: 12px 16px; background: var(--light); border-top: 1px solid var(--light-gray); text-align: center; }
        .btn-detail { color: var(--primary); font-weight: 700; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 6px; transition: var(--transition); }
        .btn-detail:hover { color: var(--primary-dark); transform: translateX(3px); }
        
        /* INFO LIST */
        .info-list { padding: 16px 20px; }
        .info-list ul { margin-left: 20px; font-size: 0.8rem; color: var(--gray); display: flex; flex-direction: column; gap: 6px; }
        .info-list li { line-height: 1.4; }
        
        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 50px 20px; background: white; border-radius: var(--radius); box-shadow: var(--shadow); border: 1px solid var(--light-gray); }
        .empty-state i { font-size: 3.5rem; color: var(--light-gray); margin-bottom: 16px; }
        .empty-state h3 { font-size: 1.2rem; color: var(--dark); margin-bottom: 8px; font-weight: 600; }
        .empty-state p { font-size: 0.85rem; color: var(--gray); max-width: 300px; margin: 0 auto; }
        
        /* ALERT */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: 0.85rem; animation: fadeInDown 0.4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); border-left: 4px solid var(--success); }
        
        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; transition: opacity 0.3s; pointer-events: none; }
        .sidebar-overlay.active { display: block; opacity: 1; pointer-events: auto; }
        
        /* RESPONSIVE - SAME AS EXAMPLE */
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-content { padding: 16px; }
            .user-name, .user-role { display: block; }
            .user-info { padding: 6px 12px; }
            .class-grid { grid-template-columns: 1fr; gap: 16px; }
        }
        
        @media (max-width: 768px) {
            .header-content { padding: 10px 0; }
            .logo-text { font-size: 1.1rem; }
            .logo img { height: 30px; }
            .logo { padding: 6px 10px; gap: 8px; }
            .page-title { font-size: 1.3rem; }
            .page-subtitle { font-size: 0.8rem; margin-bottom: 16px; }
            .dashboard-content { padding: 12px; }
            .class-card-header { padding: 12px 14px; }
            .class-card-header h3 { font-size: 0.9rem; }
            .class-card-body { padding: 12px; }
            .stat-item { margin-bottom: 10px; padding-bottom: 8px; }
            .stat-label { font-size: 0.75rem; }
            .stat-value { font-size: 0.8rem; }
            .student-table-container { max-height: 220px; }
            .student-table th, .student-table td { padding: 6px 8px; }
            .s-name-cell { font-size: 0.75rem; }
            .s-surah-cell { font-size: 0.7rem; }
            .info-list { padding: 12px 16px; }
            .info-list ul { margin-left: 16px; font-size: 0.75rem; gap: 4px; }
            
            .user-details { display: none; }
            .user-info { padding: 6px 8px; gap: 6px; }
            .user-avatar { width: 36px; height: 36px; font-size: 0.9rem; }
            .notification-bell { width: 38px; height: 38px; }
        }
        
        @media (max-width: 576px) {
            .dashboard-content { padding: 10px; }
            .page-title { font-size: 1.2rem; }
            .class-card-header { padding: 10px 12px; }
            .class-card-header h3 { font-size: 0.85rem; }
            .class-icon { width: 30px; height: 30px; font-size: 0.8rem; }
            .class-card-body { padding: 10px; }
            .stat-label i { width: 16px; font-size: 0.7rem; }
            .progress-label { font-size: 0.65rem; }
            .student-table-container { max-height: 200px; }
            .badge-mini { padding: 2px 6px; font-size: 0.6rem; }
            .btn-detail { font-size: 0.75rem; }
            .info-list ul { font-size: 0.7rem; }
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
                <div class="menu-item"><a href="<?= base_url('ustadz/santri') ?>"><i class="fas fa-user-graduate"></i><span>Santri Binaan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/absensi') ?>"><i class="fas fa-calendar-check"></i><span>Absensi Santri</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/hafalan') ?>"><i class="fas fa-quran"></i><span>Setoran Hafalan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/murojaah') ?>"><i class="fas fa-sync-alt"></i><span>Muroja'ah</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('ustadz/progres-kelas') ?>"><i class="fas fa-chart-line"></i><span>Progres Kelas</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/jadwal') ?>"><i class="fas fa-calendar-alt"></i><span>Jadwal Saya</span></a></div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <h1 class="page-title"><i class="fas fa-chart-line"></i> Progres Hafalan Kelas</h1>
            <p class="page-subtitle">Pantau perkembangan hafalan seluruh kelas yang Anda ampu secara real-time.</p>

            <!-- Alert Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <!-- CLASS GRID -->
            <?php if(!empty($progres)): ?>
                <div class="class-grid">
                    <?php foreach($progres as $p): ?>
                        <div class="class-card">
                            <div class="class-card-header">
                                <h3><i class="fas fa-chalkboard-user"></i> <?= htmlspecialchars($p['kelas']['nama_kelas']) ?></h3>
                                <div class="class-icon">
                                    <i class="fas fa-book-quran"></i>
                                </div>
                            </div>
                            <div class="class-card-body">
                                <div class="stat-item">
                                    <div class="stat-label"><i class="fas fa-users"></i> Jumlah Santri</div>
                                    <div class="stat-value"><?= $p['total_santri'] ?> Santri</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label"><i class="fas fa-check-double"></i> Persentase Tuntas</div>
                                    <div class="stat-value" style="color:var(--secondary); font-weight: 800;"><?= $p['percent_tuntas'] ?>%</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label"><i class="fas fa-chart-simple"></i> Rata-rata Nilai</div>
                                    <div class="stat-value"><?= $p['avg_nilai'] ?></div>
                                </div>
                                
                                <div class="progress-container">
                                    <div class="progress-label">
                                        <span><i class="fas fa-flag-checkered"></i> Progres Ketuntasan</span>
                                        <span><?= $p['percent_tuntas'] ?>%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: <?= $p['percent_tuntas'] ?>%;"></div>
                                    </div>
                                </div>

                                <div class="student-section">
                                    <div class="student-title">
                                        <i class="fas fa-list-ul" style="color: var(--primary);"></i> PROGRES TERBARU SANTRI
                                    </div>
                                    <div class="student-table-container">
                                        <table class="student-table">
                                            <thead>
                                                <tr>
                                                    <th>Santri</th>
                                                    <th>Surah Terakhir</th>
                                                    <th style="text-align: center;">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($p['students'] as $s): ?>
                                                    <tr>
                                                        <td style="width: 38%;">
                                                            <div class="s-name-cell"><?= htmlspecialchars($s['nama_santri']) ?></div>
                                                            <div class="s-nis-cell">NIS: <?= htmlspecialchars($s['nis'] ?? '-') ?></div>
                                                        </td>
                                                        <td style="width: 42%;">
                                                            <?php if(!empty($s['surah']) && $s['surah'] != '-'): ?>
                                                                <div class="s-surah-cell"><?= htmlspecialchars($s['surah']) ?></div>
                                                                <?php if(isset($s['ayat_awal']) && $s['ayat_awal']): ?>
                                                                    <div class="s-ayat-cell">Ayat <?= $s['ayat_awal'] ?>-<?= $s['ayat_akhir'] ?></div>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <span style="color:var(--gray); font-style:italic; font-size:0.7rem;">Belum ada setoran</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center; width: 20%;">
                                                            <?php if($s['nilai'] !== null && $s['nilai'] > 0): ?>
                                                                <?php 
                                                                    $bClass = ($s['nilai'] >= 8) ? 'badge-lancar' : 'badge-mengulang';
                                                                    $icon = ($s['nilai'] >= 8) ? 'fa-star' : 'fa-book-open';
                                                                ?>
                                                                <span class="badge-mini <?= $bClass ?>">
                                                                    <i class="fas <?= $icon ?>"></i> <?= $s['nilai'] ?>/9
                                                                </span>
                                                            <?php else: ?>
                                                                <span class="badge-mini badge-none">-</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url('ustadz/santri?kelas=' . $p['kelas']['id']) ?>" class="btn-detail">
                                    Lihat Detail Per Santri <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-chart-line"></i>
                    <h3>Belum Ada Data Kelas</h3>
                    <p>Anda belum terdaftar sebagai pengampu di kelas manapun.<br>Silakan hubungi administrator untuk menambahkan kelas binaan.</p>
                </div>
            <?php endif; ?>

            <!-- INFORMASI DASHBOARD -->
            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:32px;height:32px;border-radius:8px;background:rgba(14,165,233,.1);color:var(--info);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-circle-info"></i>
                        </div>
                        Informasi Progres Hafalan
                    </div>
                </div>
                <div class="info-list">
                    <ul>
                        <li><strong>Persentase Tuntas</strong> - Persentase santri yang mencapai nilai minimal 8 pada setoran terakhir</li>
                        <li><strong>Rata-rata Nilai</strong> - Nilai rata-rata dari seluruh santri di kelas (skala 1-9)</li>
                        <li><strong>Surah Terakhir</strong> - Materi terbaru yang disetorkan oleh santri</li>
                        <li><strong>Status Nilai</strong> - <span style="color:var(--success); font-weight:700;">Nilai ≥ 8: Tuntas (Lancar)</span> | <span style="color:var(--danger); font-weight:700;">Nilai 1-7: Muroja'ah</span></li>
                    </ul>
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
        
        // Auto hide alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 400);
            }, 5000);
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
        
        // Animate progress bars on load
        document.querySelectorAll('.progress-fill').forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 100);
        });
    </script>
</body>
</html>