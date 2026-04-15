<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Muroja'ah Santri - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET - Consistent with All Pages */
        :root {
            --primary: #1a5fb4; --primary-dark: #1c3d78; --secondary: #26a269;
            --accent: #e5a50a; --light: #f8f9fa; --gray: #718096;
            --light-gray: #e2e8f0; --dark: #2d3748; --danger: #e53e3e;
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
        .page-title { font-size: 1.5rem; color: var(--primary-dark); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        
        /* SECTION CARD */
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 18px; border-bottom: 1px solid var(--light-gray); flex-wrap: wrap; gap: 10px; }
        .card-title { font-size: 1rem; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px; }
        
        /* FILTER SECTION */
        .filter-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; padding: 16px 18px; }
        .filter-form { display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end; }
        .filter-group { flex: 1; min-width: 160px; }
        .filter-label { font-size: 0.7rem; font-weight: 700; color: var(--gray); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 5px; display: block; }
        
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: 0.8rem; cursor: pointer; transition: var(--transition); border: none; }
        .btn-primary { background: var(--secondary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-1px); }
        .btn-outline { background: transparent; border: 1px solid var(--light-gray); color: var(--dark); }
        .btn-outline:hover { background: var(--light); }
        .btn-sm { padding: 6px 12px; font-size: 0.75rem; }
        
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid var(--light-gray); border-radius: 6px; font-size: 0.85rem; outline: none; transition: var(--transition); background: #fff; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26, 95, 180, 0.1); }
        
        /* TABLE STYLES */
        .table-responsive { overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { text-align: left; padding: 12px 16px; background: var(--light); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--gray); font-weight: 700; border-bottom: 1px solid var(--light-gray); }
        .table td { padding: 12px 16px; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
        .table tr:hover { background: #f8fafc; }
        
        /* STUDENT INFO */
        .s-name { font-weight: 600; font-size: 0.9rem; color: var(--dark); }
        .s-info { font-size: 0.7rem; color: var(--gray); margin-top: 4px; display: flex; gap: 10px; flex-wrap: wrap; }
        
        .surah-text { font-weight: 700; color: var(--primary-dark); font-size: 0.9rem; }
        .ayat-text { font-size: 0.75rem; color: var(--gray); margin-top: 4px; }
        
        /* BADGES */
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; }
        .badge-lancar { background: rgba(56, 161, 105, 0.1); color: var(--success); }
        .badge-mengulang { background: rgba(229, 62, 62, 0.1); color: var(--danger); }
        
        /* ACTION BUTTONS */
        .action-cell { display: flex; gap: 6px; }
        .act-btn { width: 32px; height: 32px; border-radius: 8px; border: none; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; cursor: pointer; transition: var(--transition); color: white; }
        .act-murojaah { background: var(--secondary); }
        .act-murojaah:hover { background: var(--primary-dark); transform: scale(1.05); }
        
        /* ALERT */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: 0.85rem; animation: fadeInDown 0.4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38, 162, 105, 0.1); color: #1e8555; border: 1px solid rgba(38, 162, 105, 0.2); border-left: 4px solid var(--success); }
        .alert-error { background: rgba(229, 62, 62, 0.1); color: #c53030; border: 1px solid rgba(229, 62, 62, 0.2); border-left: 4px solid var(--danger); }
        
        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 50px 20px; color: var(--gray); }
        .empty-state i { font-size: 3rem; color: var(--light-gray); margin-bottom: 15px; display: block; }
        .empty-state p { font-size: 0.85rem; }
        
        /* MODAL STYLES */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 15px; backdrop-filter: blur(4px); }
        .modal-overlay.active { display: flex; }
        .modal-card { background: white; width: 100%; max-width: 500px; border-radius: var(--radius); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); animation: slideUp 0.3s ease; overflow: hidden; }
        @keyframes slideUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }
        .modal-head { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid var(--light-gray); background: var(--light); }
        .modal-head h3 { font-size: 1rem; font-weight: 700; color: var(--primary-dark); display: flex; align-items: center; gap: 8px; }
        .btn-close { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: var(--gray); padding: 5px; border-radius: 5px; transition: var(--transition); }
        .btn-close:hover { background: var(--light-gray); color: var(--danger); }
        .modal-body { padding: 20px; max-height: 70vh; overflow-y: auto; }
        .form-group { margin-bottom: 16px; }
        .form-row { display: flex; gap: 15px; }
        .form-row .form-group { flex: 1; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 600; color: var(--dark); margin-bottom: 6px; }
        .modal-foot { padding: 14px 20px; background: var(--light); border-top: 1px solid var(--light-gray); display: flex; justify-content: flex-end; gap: 10px; }
        .modal-foot .btn { min-width: 100px; }
        .info-box { background: rgba(26, 95, 180, 0.05); padding: 12px; border-radius: 8px; margin-bottom: 16px; border-left: 4px solid var(--primary); }
        .info-box .label { font-size: 0.7rem; color: var(--gray); text-transform: uppercase; margin-bottom: 4px; }
        .info-box .value { font-weight: 700; color: var(--primary-dark); font-size: 0.95rem; }
        
        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; transition: opacity 0.3s; pointer-events: none; }
        .sidebar-overlay.active { display: block; opacity: 1; pointer-events: auto; }
        
        /* RESPONSIVE - SAME AS EXAMPLE */
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
            .dashboard-content { padding: 12px; }
            
            /* Convert table to cards on mobile */
            .table thead { display: none; }
            .table, .table tbody, .table tr, .table td { display: block; width: 100%; }
            .table tr { margin-bottom: 16px; padding: 14px; border-radius: 12px; border: 1px solid var(--light-gray); background: white; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04); }
            .table td { display: flex; justify-content: space-between; align-items: flex-start; padding: 8px 0; border-bottom: 1px dashed var(--light-gray); text-align: right; gap: 10px; }
            .table td:last-child { border-bottom: none; }
            .table td::before { content: attr(data-label); font-weight: 600; color: var(--gray); font-size: 0.7rem; text-transform: uppercase; float: left; text-align: left; width: 35%; flex-shrink: 0; }
            .table td div, .table td span, .table td .action-cell { text-align: left; flex: 1; }
            .action-cell { justify-content: flex-start; }
            
            .filter-form { flex-direction: column; }
            .filter-group { width: 100%; }
            .filter-group .btn { width: 100%; justify-content: center; }
            .form-row { flex-direction: column; gap: 0; }
            .modal-card { max-width: 95%; margin: 10px; }
            .modal-head { padding: 14px 16px; }
            .modal-body { padding: 16px; }
            .modal-foot { padding: 12px 16px; flex-direction: column; }
            .modal-foot .btn { width: 100%; justify-content: center; }
            
            .user-details { display: none; }
            .user-info { padding: 6px 8px; gap: 6px; }
            .user-avatar { width: 36px; height: 36px; font-size: 0.9rem; }
            .notification-bell { width: 38px; height: 38px; }
        }
        
        @media (max-width: 576px) {
            .dashboard-content { padding: 10px; }
            .page-title { font-size: 1.2rem; }
            .card-header { padding: 12px 14px; flex-direction: column; align-items: flex-start; }
            .table tr { padding: 12px; }
            .table td { padding: 6px 0; font-size: 0.8rem; }
            .table td::before { font-size: 0.65rem; width: 40%; }
            .s-name { font-size: 0.85rem; }
            .surah-text { font-size: 0.85rem; }
            .badge { padding: 3px 10px; font-size: 0.65rem; }
            .act-btn { width: 28px; height: 28px; font-size: 0.7rem; }
            .sidebar { width: 260px; }
        }
        
        @media (max-width: 400px) {
            .logo-text { font-size: 0.9rem; }
            .user-avatar { width: 32px; height: 32px; }
            .notification-bell { width: 34px; height: 34px; font-size: 0.9rem; }
            .table td::before { width: 45%; font-size: 0.6rem; }
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
                <div class="menu-item active"><a href="<?= base_url('ustadz/murojaah') ?>"><i class="fas fa-sync-alt"></i><span>Muroja'ah</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/progres-kelas') ?>"><i class="fas fa-chart-line"></i><span>Progres Kelas</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/jadwal') ?>"><i class="fas fa-calendar-alt"></i><span>Jadwal Saya</span></a></div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <h1 class="page-title"><i class="fas fa-sync-alt"></i> Muroja'ah Santri</h1>

            <!-- ALERTS -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- FILTER SECTION -->
            <div class="filter-card">
                <form action="<?= base_url('ustadz/murojaah') ?>" method="get" class="filter-form">
                    <div class="filter-group">
                        <label class="filter-label">Cari Santri</label>
                        <input type="text" name="santri" class="form-control" placeholder="Nama santri..." value="<?= htmlspecialchars($filter['santri'] ?? '') ?>">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Kelas</label>
                        <select name="id_kelas" class="form-control">
                            <option value="">-- Semua Kelas --</option>
                            <?php foreach($kelasList as $k): ?>
                                <option value="<?= $k['id'] ?>" <?= ($filter['id_kelas'] == $k['id']) ? 'selected' : '' ?>><?= htmlspecialchars($k['nama_kelas']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= htmlspecialchars($filter['tanggal'] ?? '') ?>">
                    </div>
                    <div class="filter-group" style="display: flex; gap: 8px; align-items: center;">
                        <button type="submit" class="btn btn-primary" style="height: 42px;">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <?php if(!empty($filter['santri']) || !empty($filter['id_kelas']) || !empty($filter['tanggal'])): ?>
                            <a href="<?= base_url('ustadz/murojaah') ?>" class="btn btn-outline" style="height: 42px;">
                                <i class="fas fa-times"></i> Reset
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <!-- MAIN TABLE CARD -->
            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:32px;height:32px;border-radius:8px;background:rgba(38,162,105,.1);color:var(--secondary);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-history"></i>
                        </div>
                        Riwayat Muroja'ah Santri
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal & Santri</th>
                                <th>Materi Muroja'ah</th>
                                <th>Kinerja (Nilai)</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($riwayat)): ?>
                                <?php foreach($riwayat as $r): ?>
                                    <tr>
                                        <td data-label="Tanggal & Santri">
                                            <div class="s-name"><?= htmlspecialchars($r['nama_santri']) ?></div>
                                            <div class="s-info">
                                                <span><i class="fas fa-calendar-day"></i> <?= date('d M Y', strtotime($r['tanggal'])) ?></span>
                                                <span><i class="fas fa-hashtag"></i> <?= htmlspecialchars($r['nis'] ?? '-') ?></span>
                                            </div>
                                        </td>
                                        <td data-label="Materi Muroja'ah">
                                            <div class="surah-text"><?= htmlspecialchars($r['surah']) ?></div>
                                            <div class="ayat-text">Ayat: <?= htmlspecialchars($r['ayat_awal']) ?> - <?= htmlspecialchars($r['ayat_akhir']) ?></div>
                                        </td>
                                        <td data-label="Kinerja (Nilai)">
                                            <?php
                                                $bClass = 'badge-lancar';
                                                $bIcon = 'fa-check-double';
                                                $label = 'Tuntas (' . $r['nilai'] . ')';
                                                if($r['nilai'] < 8) { 
                                                    $bClass = 'badge-mengulang'; 
                                                    $bIcon = 'fa-redo'; 
                                                    $label = 'Muroja\'ah (' . $r['nilai'] . ')';
                                                }
                                            ?>
                                            <span class="badge <?= $bClass ?>">
                                                <i class="fas <?= $bIcon ?>"></i> <?= $label ?>
                                            </span>
                                        </td>
                                        <td data-label="Keterangan">
                                            <span style="font-size: 0.8rem; color: var(--gray);"><?= htmlspecialchars($r['keterangan'] ?? '-') ?></span>
                                        </td>
                                        <td data-label="Aksi">
                                            <div class="action-cell">
                                                <button class="act-btn act-murojaah" onclick='prepMurojaah(<?= htmlspecialchars(json_encode($r)) ?>)' title="Muroja'ah Kembali">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        <i class="fas fa-sync-alt"></i>
                                        <p>Belum ada catatan muroja'ah dari Santri.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH MUROJAAH -->
    <div class="modal-overlay" id="addModal">
        <form action="<?= base_url('ustadz/murojaah/store') ?>" method="post" class="modal-card">
            <?= csrf_field() ?>
            <div class="modal-head">
                <h3><i class="fas fa-plus-circle"></i> Input Muroja'ah Baru</h3>
                <button type="button" class="btn-close" onclick="document.getElementById('addModal').classList.remove('active')"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div id="santri_info_display" style="display:none;" class="info-box">
                    <div class="label">Muroja'ah Untuk Santri:</div>
                    <div class="value" id="display_nama_santri"></div>
                </div>
                <div class="form-group" id="santri_select_group">
                    <label class="form-label">Santri *</label>
                    <select name="id_santri" id="add_id_santri" class="form-control" required>
                        <option value="">-- Pilih Santri --</option>
                        <?php foreach($santriList as $s): ?>
                            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['nama_santri']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="add_tanggal" class="form-control" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Surah *</label>
                    <input type="text" name="surah" id="add_surah" class="form-control" required placeholder="Contoh: Al-Baqarah">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Ayat Awal *</label>
                        <input type="number" name="ayat_awal" id="add_ayat_awal" class="form-control" required min="1" placeholder="1">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ayat Akhir *</label>
                        <input type="number" name="ayat_akhir" id="add_ayat_akhir" class="form-control" required min="1" placeholder="10">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nilai / Kinerja *</label>
                    <select name="nilai" class="form-control" required>
                        <option value="9">Istimewa (9)</option>
                        <option value="8">Lancar (8)</option>
                        <option value="7">Cukup / Muroja'ah (7)</option>
                        <option value="6">Kurang / Muroja'ah (6)</option>
                        <option value="5">Sangat Kurang / Muroja'ah (5)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="2" placeholder="Catatan muroja'ah..."></textarea>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn btn-outline" onclick="document.getElementById('addModal').classList.remove('active')">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Record</button>
            </div>
        </form>
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
        
        // Modal functions
        function openAddModal() {
            document.getElementById('add_id_santri').value = '';
            document.getElementById('santri_select_group').style.display = 'block';
            document.getElementById('santri_info_display').style.display = 'none';
            document.getElementById('add_surah').value = '';
            document.getElementById('add_ayat_awal').value = '';
            document.getElementById('add_ayat_akhir').value = '';
            document.getElementById('add_tanggal').value = new Date().toISOString().split('T')[0];
            document.getElementById('addModal').classList.add('active');
        }

        function prepMurojaah(data) {
            document.getElementById('add_id_santri').value = data.id_santri || '';
            document.getElementById('display_nama_santri').innerText = data.nama_santri || '';
            document.getElementById('santri_select_group').style.display = 'none';
            document.getElementById('santri_info_display').style.display = 'block';
            document.getElementById('add_surah').value = data.surah || '';
            document.getElementById('add_ayat_awal').value = data.ayat_awal || '';
            document.getElementById('add_ayat_akhir').value = data.ayat_akhir || '';
            document.getElementById('add_tanggal').value = new Date().toISOString().split('T')[0];
            document.getElementById('addModal').classList.add('active');
        }
    </script>
</body>
</html>