<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Santri - PTQ Pencongan</title>
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
        .page-title { font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
        .page-subtitle { color: var(--gray); font-size: 0.9rem; margin-bottom: 25px; }
        
        /* SECTION CARD */
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); flex-wrap: wrap; gap: 10px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px; }
        
        /* STATS GRID */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px; margin-bottom: 32px; }
        .stat-card { background: white; padding: 20px; border-radius: var(--radius); border: 1px solid var(--light-gray); display: flex; align-items: center; gap: 16px; transition: var(--transition); box-shadow: var(--shadow); }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.08); }
        .stat-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
        .stat-info h3 { font-size: 0.75rem; color: var(--gray); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .stat-info p { font-size: 1.6rem; font-weight: 800; color: var(--dark); line-height: 1.2; }
        
        .bg-hadir { background: #ecfdf5; color: var(--success); }
        .bg-izin { background: #fffbeb; color: var(--warning); }
        .bg-sakit { background: #f0f9ff; color: var(--info); }
        .bg-alpa { background: #fef2f2; color: var(--danger); }
        .bg-total { background: #f5f3ff; color: var(--purple); }
        
        /* DATE NAVIGATOR */
        .date-navigator { background: white; padding: 16px 24px; border-radius: var(--radius); border: 1px solid var(--light-gray); margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; gap: 15px; flex-wrap: wrap; box-shadow: var(--shadow); }
        .date-controls { display: flex; align-items: center; gap: 12px; }
        .date-input-group { display: flex; align-items: center; }
        .form-control { padding: 10px 16px; border: 1.5px solid var(--light-gray); border-radius: var(--radius); font-size: 0.9rem; font-weight: 500; outline: none; transition: var(--transition); background: white; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26, 95, 180, 0.1); }
        
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 20px; border-radius: var(--radius); font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: var(--transition); border: none; white-space: nowrap; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); box-shadow: 0 4px 12px rgba(26, 95, 180, 0.25); transform: translateY(-1px); }
        .btn-ghost { background: var(--light); color: var(--dark); border: 1px solid var(--light-gray); }
        .btn-ghost:hover { background: var(--light-gray); border-color: var(--gray); }
        .btn-sm { padding: 8px 14px; font-size: 0.8rem; }
        
        .quick-nav { display: flex; gap: 12px; flex-wrap: wrap; }
        
        /* TABLE CARD */
        .table-card { background: white; border-radius: var(--radius); border: 1px solid var(--light-gray); overflow: hidden; box-shadow: var(--shadow); margin-bottom: 20px; }
        .table-header { padding: 20px 24px; border-bottom: 1px solid var(--light-gray); display: flex; justify-content: space-between; align-items: center; background: #fafafa; flex-wrap: wrap; gap: 12px; }
        .table-header h2 { font-size: 1rem; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px; }
        .badge-count { background: var(--primary); color: white; padding: 4px 12px; border-radius: 30px; font-size: 0.75rem; font-weight: 700; }
        
        .table-responsive { width: 100%; overflow-x: auto; }
        .absensi-table { width: 100%; border-collapse: collapse; }
        .absensi-table th { background: white; padding: 16px 20px; text-align: left; font-size: 0.7rem; font-weight: 700; color: var(--gray); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1.5px solid var(--light-gray); }
        .absensi-table td { padding: 18px 20px; border-bottom: 1px solid var(--light-gray); vertical-align: middle; }
        .absensi-table tr:last-child td { border-bottom: none; }
        .absensi-table tr:hover { background-color: #fafcff; }
        
        /* STUDENT PROFILE */
        .student-profile { display: flex; align-items: center; gap: 14px; }
        .student-avatar { width: 44px; height: 44px; border-radius: 12px; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); }
        .student-info h4 { font-size: 0.95rem; font-weight: 700; color: var(--dark); margin-bottom: 2px; }
        .student-info p { font-size: 0.75rem; color: var(--gray); display: flex; align-items: center; gap: 6px; }
        
        /* STATUS OPTIONS */
        .status-options { display: flex; gap: 8px; flex-wrap: wrap; }
        .status-radio { position: relative; cursor: pointer; }
        .status-radio input { position: absolute; opacity: 0; width: 0; height: 0; }
        .status-label { display: flex; align-items: center; justify-content: center; min-width: 65px; padding: 6px 14px; border-radius: 30px; font-size: 0.75rem; font-weight: 600; border: 1.5px solid var(--light-gray); background: white; color: var(--gray); transition: var(--transition); user-select: none; }
        .status-label i { margin-right: 6px; font-size: 0.7rem; }
        
        .status-radio input:checked + .lbl-hadir { background: var(--success); border-color: var(--success); color: white; }
        .status-radio input:checked + .lbl-izin { background: var(--warning); border-color: var(--warning); color: white; }
        .status-radio input:checked + .lbl-sakit { background: var(--info); border-color: var(--info); color: white; }
        .status-radio input:checked + .lbl-alpa { background: var(--danger); border-color: var(--danger); color: white; }
        
        .recorded-by { margin-top: 8px; font-size: 0.65rem; color: var(--gray); display: flex; align-items: center; gap: 5px; }
        .recorded-by i { color: var(--success); font-size: 0.6rem; }
        
        .note-input { width: 100%; min-width: 180px; border: 1.5px solid var(--light-gray); border-radius: var(--radius); padding: 10px 14px; font-size: 0.85rem; outline: none; transition: var(--transition); background: white; }
        .note-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26, 95, 180, 0.08); }
        
        /* FORM ACTIONS */
        .absensi-actions { padding: 20px 24px; background: #fafafa; border-top: 1px solid var(--light-gray); display: flex; justify-content: flex-end; gap: 12px; flex-wrap: wrap; }
        
        /* ALERTS */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); border-left: 4px solid var(--success); }
        .alert-error { background: rgba(229,62,62,.1); color: #c53030; border: 1px solid rgba(229,62,62,.2); border-left: 4px solid var(--danger); }
        
        /* MODAL */
        .modal { display: none; position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); align-items: center; justify-content: center; }
        .modal-content { background: white; margin: auto; border-radius: var(--radius); width: 90%; max-width: 450px; box-shadow: 0 20px 35px rgba(0,0,0,0.2); overflow: hidden; animation: modalSlideIn 0.3s ease; }
        @keyframes modalSlideIn { from { transform: scale(0.95) translateY(-20px); opacity: 0; } to { transform: scale(1) translateY(0); opacity: 1; } }
        .modal-header { padding: 20px 24px; border-bottom: 1px solid var(--light-gray); display: flex; justify-content: space-between; align-items: center; background: white; }
        .modal-header h3 { font-size: 1.1rem; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .modal-body { padding: 20px 24px; max-height: 400px; overflow-y: auto; }
        .present-list { list-style: none; }
        .present-item { display: flex; align-items: center; gap: 14px; padding: 14px 0; border-bottom: 1px solid var(--light-gray); }
        .present-item:last-child { border-bottom: none; }
        .present-item .avatar { width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, var(--primary) 0%, var(--purple) 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; }
        
        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 80px 20px; background: white; border-radius: var(--radius); box-shadow: var(--shadow); }
        .empty-state i { font-size: 4rem; color: var(--light-gray); margin-bottom: 20px; }
        .empty-state h3 { font-size: 1.3rem; color: var(--dark); margin-bottom: 10px; font-weight: 600; }
        .empty-state p { font-size: 0.9rem; color: var(--gray); }
        
        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; transition: var(--transition); }
        .sidebar-overlay.active { display: block; opacity: 1; }
        
        /* RESPONSIVE */
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-container { position: relative; }
            .sidebar { position: absolute; left: -280px; height: 100%; }
            .sidebar.active { left: 0; box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2); }
            .sidebar-overlay.active { display: block; opacity: 1; }
            .user-name, .user-role { display: none; }
            .stats-grid { grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px; }
        }
        @media (max-width: 768px) {
            .page-title { font-size: 1.5rem; }
            .dashboard-content { padding: 20px 15px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .absensi-table thead { display: none; }
            .absensi-table tr { display: block; margin-bottom: 16px; border: 1px solid var(--light-gray); border-radius: var(--radius); padding: 16px; background: white; }
            .absensi-table td { display: block; padding: 8px 0; border: none; }
            .absensi-table td::before { content: attr(data-label); font-weight: 700; font-size: 0.7rem; color: var(--gray); text-transform: uppercase; display: block; margin-bottom: 8px; }
            .status-options { justify-content: flex-start; }
            .note-input { width: 100%; }
            .date-navigator { flex-direction: column; align-items: stretch; }
            .date-controls { justify-content: center; }
            .quick-nav { justify-content: center; }
        }
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
            .stat-card { padding: 12px; }
            .stat-icon { width: 40px; height: 40px; font-size: 1rem; }
            .stat-info p { font-size: 1.2rem; }
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
                <div class="menu-item"><a href="<?= base_url('ustadz/dashboard') ?>"><i class="fas fa-th-large"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/santri') ?>"><i class="fas fa-graduation-cap"></i><span>Santri Binaan</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('ustadz/absensi') ?>"><i class="fas fa-user-check"></i><span>Absensi Santri</span></a></div>
                
                <div style="padding: 15px 15px 5px; color: rgba(255,255,255,0.4); font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Manajemen Hafalan</div>
                <div class="menu-item"><a href="<?= base_url('ustadz/hafalan') ?>"><i class="fas fa-book-open"></i><span>Setoran Hafalan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/murojaah') ?>"><i class="fas fa-sync-alt"></i><span>Muroja'ah</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/progres-kelas') ?>"><i class="fas fa-chart-line"></i><span>Progres Kelas</span></a></div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <h1 class="page-title"><i class="fas fa-calendar-check"></i> Manajemen Absensi</h1>
            <p class="page-subtitle">Kelola kehadiran santri dan tinjau riwayat presensi harian</p>

            <!-- MESSAGES -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- STATS CARDS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon bg-hadir"><i class="fas fa-user-check"></i></div>
                    <div class="stat-info">
                        <h3>Hadir</h3>
                        <p><?= $stats['Hadir'] ?? 0 ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-izin"><i class="fas fa-envelope-open-text"></i></div>
                    <div class="stat-info">
                        <h3>Izin</h3>
                        <p><?= $stats['Izin'] ?? 0 ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-sakit"><i class="fas fa-thermometer-half"></i></div>
                    <div class="stat-info">
                        <h3>Sakit</h3>
                        <p><?= $stats['Sakit'] ?? 0 ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-alpa"><i class="fas fa-user-slash"></i></div>
                    <div class="stat-info">
                        <h3>Alpa</h3>
                        <p><?= $stats['Alpa'] ?? 0 ?></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon bg-total"><i class="fas fa-users"></i></div>
                    <div class="stat-info">
                        <h3>Total Santri</h3>
                        <p><?= $stats['Total'] ?? 0 ?></p>
                    </div>
                </div>
            </div>

            <!-- DATE NAVIGATOR -->
            <div class="date-navigator">
                <div class="date-controls">
                    <a href="<?= base_url('ustadz/absensi?tanggal=' . date('Y-m-d', strtotime($tanggal . ' -1 day'))) ?>" class="btn btn-ghost btn-sm">
                        <i class="fas fa-chevron-left"></i> Sebelumnya
                    </a>
                    
                    <form action="<?= base_url('ustadz/absensi') ?>" method="get" class="date-input-group">
                        <input type="date" name="tanggal" class="form-control" value="<?= $tanggal ?? date('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" onchange="this.form.submit()">
                    </form>

                    <a href="<?= base_url('ustadz/absensi?tanggal=' . date('Y-m-d', strtotime($tanggal . ' +1 day'))) ?>" class="btn btn-ghost btn-sm" <?= ($tanggal ?? date('Y-m-d')) >= date('Y-m-d') ? 'disabled style="opacity:0.5;pointer-events:none;"' : '' ?>>
                        Selanjutnya <i class="fas fa-chevron-right"></i>
                    </a>
                </div>

                <div class="quick-nav">
                    <?php if(($tanggal ?? date('Y-m-d')) != date('Y-m-d')): ?>
                        <a href="<?= base_url('ustadz/absensi') ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-calendar-day"></i> Hari Ini
                        </a>
                    <?php endif; ?>
                    <button type="button" class="btn btn-ghost btn-sm" id="markAllHadir">
                        <i class="fas fa-check-double"></i> Tandai Semua Hadir
                    </button>
                    <button type="button" class="btn btn-ghost btn-sm" id="showPresentList">
                        <i class="fas fa-users"></i> Daftar Hadir
                    </button>
                </div>
            </div>

            <!-- FORM START -->
            <form action="<?= base_url('ustadz/absensi/store') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="tanggal" value="<?= $tanggal ?? date('Y-m-d') ?>">

                <div class="table-card">
                    <div class="table-header">
                        <h2><i class="fas fa-clipboard-list"></i> Presensi Santri Bimbingan</h2>
                        <span class="badge-count"><?= $stats['Terisi'] ?? 0 ?> dari <?= $stats['Total'] ?? 0 ?> terisi</span>
                    </div>

                    <div class="table-responsive">
                        <table class="absensi-table">
                            <thead>
                                <tr>
                                    <th style="width: 35%">Santri & Kelas</th>
                                    <th style="width: 35%">Status Kehadiran</th>
                                    <th style="width: 30%">Keterangan / Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($santri) && count($santri) > 0): ?>
                                    <?php foreach($santri as $s): ?>
                                        <?php 
                                            $r = $riwayat[$s['id']] ?? null;
                                            $rStatus = $r['status'] ?? 'Hadir'; 
                                            $rKet = $r['keterangan'] ?? '';
                                            $rUstadz = $r['nama_ustadz'] ?? null;
                                        ?>
                                        <tr class="row-santri">
                                            <td data-label="Santri">
                                                <div class="student-profile">
                                                    <div class="student-avatar">
                                                        <?= strtoupper(substr($s['nama_santri'], 0, 1)) ?>
                                                    </div>
                                                    <div class="student-info">
                                                        <h4><?= htmlspecialchars($s['nama_santri']) ?></h4>
                                                        <p><i class="fas fa-school"></i> <?= htmlspecialchars($s['nama_kelas'] ?? 'Kelas belum ditentukan') ?></p>
                                                    </div>
                                                </div>
                                              </td>
                                            <td data-label="Status">
                                                <div class="status-options">
                                                    <label class="status-radio">
                                                        <input type="radio" name="absensi[<?= $s['id'] ?>][status]" value="Hadir" <?= $rStatus == 'Hadir' ? 'checked' : '' ?> class="radio-hadir">
                                                        <span class="status-label lbl-hadir"><i class="fas fa-check"></i> Hadir</span>
                                                    </label>
                                                    <label class="status-radio">
                                                        <input type="radio" name="absensi[<?= $s['id'] ?>][status]" value="Izin" <?= $rStatus == 'Izin' ? 'checked' : '' ?>>
                                                        <span class="status-label lbl-izin"><i class="fas fa-envelope"></i> Izin</span>
                                                    </label>
                                                    <label class="status-radio">
                                                        <input type="radio" name="absensi[<?= $s['id'] ?>][status]" value="Sakit" <?= $rStatus == 'Sakit' ? 'checked' : '' ?>>
                                                        <span class="status-label lbl-sakit"><i class="fas fa-thermometer-half"></i> Sakit</span>
                                                    </label>
                                                    <label class="status-radio">
                                                        <input type="radio" name="absensi[<?= $s['id'] ?>][status]" value="Alpa" <?= $rStatus == 'Alpa' ? 'checked' : '' ?>>
                                                        <span class="status-label lbl-alpa"><i class="fas fa-times"></i> Alpa</span>
                                                    </label>
                                                </div>
                                                <?php if($rUstadz): ?>
                                                    <div class="recorded-by">
                                                        <i class="fas fa-check-circle"></i> Dicatat oleh: <?= htmlspecialchars($rUstadz) ?>
                                                    </div>
                                                <?php endif; ?>
                                              </td>
                                            <td data-label="Keterangan">
                                                <input type="text" name="absensi[<?= $s['id'] ?>][keterangan]" class="note-input" value="<?= htmlspecialchars($rKet) ?>" placeholder="Tambahkan catatan (opsional)...">
                                              </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center; padding: 60px;">
                                            <div class="empty-state" style="box-shadow: none; padding: 40px;">
                                                <i class="fas fa-user-slash"></i>
                                                <h3>Belum Ada Santri</h3>
                                                <p>Anda belum memiliki santri bimbingan di kelas manapun.<br>Silakan hubungi administrator untuk penempatan kelas.</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if(!empty($santri) && count($santri) > 0): ?>
                        <div class="absensi-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Absensi
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL PRESENT LIST -->
    <div id="presentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-user-check" style="color: var(--success);"></i> Daftar Santri Hadir</h3>
                <button class="btn btn-ghost btn-sm" id="closeModal" style="background: transparent; padding: 8px 12px; font-size: 1.2rem;">&times;</button>
            </div>
            <div class="modal-body">
                <ul class="present-list" id="presentListContainer"></ul>
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
        
        // Logout confirmation modal
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const logoutUrl = this.getAttribute('href');
                
                const modalHtml = `
                <div id="logoutModal" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity 0.3s;backdrop-filter:blur(3px);">
                    <div style="background:white;padding:30px;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.2);text-align:center;max-width:350px;width:90%;transform:translateY(-20px);transition:transform 0.3s;">
                        <div style="width:60px;height:60px;background:rgba(229,62,62,0.1);color:#e53e3e;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2rem;margin:0 auto 15px;">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <h3 style="margin-bottom:10px;color:#2d3748;font-size:1.2rem;font-weight:700;">Konfirmasi Keluar</h3>
                        <p style="color:#718096;margin-bottom:25px;font-size:0.95rem;">Apakah Anda yakin ingin keluar dari sistem PTQ Pencongan?</p>
                        <div style="display:flex;gap:10px;justify-content:center;">
                            <button id="cancelLogout" style="padding:10px 20px;border-radius:8px;border:1px solid #e2e8f0;background:white;color:#4a5568;font-weight:600;cursor:pointer;flex:1;transition:all 0.2s;">Batal</button>
                            <a href="${logoutUrl}" style="padding:10px 20px;border-radius:8px;border:none;background:#e53e3e;color:white;font-weight:600;cursor:pointer;text-decoration:none;flex:1;transition:all 0.2s;display:flex;align-items:center;justify-content:center;">Ya, Keluar</a>
                        </div>
                    </div>
                </div>`;
                
                document.body.insertAdjacentHTML('beforeend', modalHtml);
                const modal = document.getElementById('logoutModal');
                const cancelBtn = document.getElementById('cancelLogout');
                
                setTimeout(() => {
                    modal.style.opacity = '1';
                    modal.children[0].style.transform = 'translateY(0)';
                }, 10);
                
                let cancelHover = function() { this.style.background = '#f7fafc'; };
                let cancelOut = function() { this.style.background = 'white'; };
                cancelBtn.addEventListener('mouseover', cancelHover);
                cancelBtn.addEventListener('mouseout', cancelOut);
                
                const closeModal = () => {
                    modal.style.opacity = '0';
                    modal.children[0].style.transform = 'translateY(-20px)';
                    setTimeout(() => modal.remove(), 300);
                };
                
                cancelBtn.addEventListener('click', closeModal);
                modal.addEventListener('click', (ev) => {
                    if(ev.target === modal) closeModal();
                });
            });
        }
        
        // Modal Logic
        const modal = document.getElementById('presentModal');
        const showBtn = document.getElementById('showPresentList');
        const closeBtn = document.getElementById('closeModal');

        showBtn.onclick = function() {
            const list = document.getElementById('presentListContainer');
            list.innerHTML = '';
            
            let found = false;
            document.querySelectorAll('.row-santri').forEach(row => {
                const radioHadir = row.querySelector('input[value="Hadir"]');
                const isHadir = radioHadir && radioHadir.checked;
                if(isHadir) {
                    const name = row.querySelector('.student-info h4').textContent;
                    const kelas = row.querySelector('.student-info p').textContent;
                    const initial = name.charAt(0).toUpperCase();
                    
                    const li = document.createElement('li');
                    li.className = 'present-item';
                    li.innerHTML = `
                        <div class="avatar">${initial}</div>
                        <div style="flex:1;">
                            <div style="font-weight: 600; font-size: 0.9rem;">${name}</div>
                            <div style="font-size: 0.7rem; color: var(--gray);">${kelas}</div>
                        </div>
                        <i class="fas fa-check-circle" style="color: var(--success); font-size: 1.1rem;"></i>
                    `;
                    list.appendChild(li);
                    found = true;
                }
            });

            if(!found) {
                list.innerHTML = '<li style="text-align: center; padding: 30px; color: var(--gray);"><i class="fas fa-user-check" style="font-size: 2rem; margin-bottom: 10px; display: block; color: var(--light-gray);"></i>Belum ada santri yang ditandai hadir.</li>';
            }
            modal.style.display = "flex";
        }

        closeBtn.onclick = () => modal.style.display = "none";
        window.onclick = (e) => { if(e.target == modal) modal.style.display = "none"; }

        // Quick Action: Mark All Present
        const markAllBtn = document.getElementById('markAllHadir');
        if(markAllBtn) {
            markAllBtn.onclick = function() {
                if(confirm('Tandai semua santri sebagai "Hadir"?')) {
                    document.querySelectorAll('.radio-hadir').forEach(input => {
                        input.checked = true;
                    });
                }
            };
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