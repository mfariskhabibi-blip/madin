<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun Baru - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET */
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
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 0; position: sticky; top: 0; z-index: 1000;
        }
        .header-content { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; }
        .logo-section { display: flex; align-items: center; gap: 15px; }
        .logo { display: flex; align-items: center; gap: 12px; padding: 8px 12px; border-radius: var(--radius); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); }
        .logo img { height: 36px; border-radius: 6px; }
        .logo-text { font-size: 1.4rem; font-weight: 700; color: white; letter-spacing: 0.5px; }
        .logo-text span { color: var(--accent); }
        
        .mobile-menu-toggle {
            display: none; background: rgba(255, 255, 255, 0.15); border: none; color: white; font-size: 1.4rem;
            width: 44px; height: 44px; border-radius: var(--radius); cursor: pointer; transition: var(--transition);
            align-items: center; justify-content: center;
        }
        .mobile-menu-toggle:hover { background: rgba(255, 255, 255, 0.25); }
        
        .user-section { display: flex; align-items: center; gap: 15px; }
        .notification-bell {
            position: relative; background: rgba(255, 255, 255, 0.15); width: 44px; height: 44px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; transition: var(--transition);
        }
        .notification-bell:hover { background: rgba(255, 255, 255, 0.25); }
        .notification-badge {
            position: absolute; top: -2px; right: -2px; background: var(--accent); color: white; font-size: 0.7rem;
            width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;
        }
        
        .user-info {
            display: flex; align-items: center; gap: 12px; padding: 8px 16px; border-radius: var(--radius);
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); transition: var(--transition); cursor: pointer;
        }
        .user-info:hover { background: rgba(255, 255, 255, 0.2); }
        .user-avatar {
            width: 42px; height: 42px; border-radius: 50%; overflow: hidden; background: linear-gradient(135deg, var(--purple) 0%, var(--info) 100%);
            color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.1rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        .user-details { color: white; }
        .user-name { font-weight: 600; font-size: 0.95rem; }
        .user-role { font-size: 0.8rem; opacity: 0.9; }
        
        .user-dropdown { position: relative; }
        .dropdown-menu {
            position: absolute; top: 100%; right: 0; width: 200px; background: white; border-radius: var(--radius);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); margin-top: 10px; opacity: 0; visibility: hidden;
            transform: translateY(-10px); transition: var(--transition); z-index: 100;
        }
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
        .sidebar {
            width: 280px; background: linear-gradient(180deg, var(--primary-dark) 0%, #152a57 100%); color: white;
            padding: 20px 0; transition: var(--transition); position: relative; z-index: 99; box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar-header { padding: 0 20px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 20px; }
        .welcome-text { font-size: 1.1rem; margin-bottom: 5px; opacity: 0.9; }
        .admin-name { font-weight: 700; font-size: 1.2rem; color: var(--accent); }
        .sidebar-menu { padding: 0 15px; }
        .menu-item { margin-bottom: 5px; }
        .menu-item a { display: flex; align-items: center; padding: 14px 15px; border-radius: var(--radius); transition: var(--transition); }
        .menu-item a:hover, .menu-item.active a { background: rgba(255, 255, 255, 0.1); transform: translateX(5px); }
        .menu-item i { margin-right: 12px; width: 20px; text-align: center; font-size: 1.1rem; }
        
        .dashboard-content { flex: 1; padding: 30px; background-color: #f5f7fa; overflow-y: auto; transition: var(--transition); }

        /* TOP NAV & BACK BUTTON */
        .top-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .btn-back { display: inline-flex; align-items: center; gap: 8px; background: white; padding: 10px 20px; border-radius: 8px; color: var(--gray); font-weight: 600; font-size: 0.85rem; box-shadow: var(--shadow); transition: var(--transition); }
        .btn-back:hover { color: var(--primary); transform: translateX(-5px); }

        /* PAGE HEADER CARD */
        .page-header-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 12px; padding: 35px 40px; color: white; margin-bottom: 30px;
            display: flex; align-items: center; gap: 25px;
            box-shadow: 0 10px 25px rgba(26, 95, 180, 0.25);
            position: relative; overflow: hidden;
        }
        .page-header-card::before {
            content: ''; position: absolute; top: -50%; right: -10%; width: 300px; height: 300px;
            background: rgba(255,255,255,0.05); border-radius: 50%;
        }
        .page-header-card::after {
            content: ''; position: absolute; bottom: -60%; right: 10%; width: 200px; height: 200px;
            background: rgba(255,255,255,0.03); border-radius: 50%;
        }
        .header-icon {
            width: 80px; height: 80px; border-radius: 50%; background: rgba(255,255,255,0.15);
            display: flex; align-items: center; justify-content: center; font-size: 2rem;
            border: 3px solid rgba(255,255,255,0.2); flex-shrink: 0; backdrop-filter: blur(10px);
        }
        .header-text h1 { font-size: 1.8rem; font-weight: 700; margin-bottom: 6px; }
        .header-text p { opacity: 0.85; font-size: 0.95rem; }

        /* FORM CARD */
        .form-card { background: white; border-radius: 12px; box-shadow: var(--shadow); overflow: hidden; margin-bottom: 25px; }
        .form-card-header { 
            padding: 20px 28px; border-bottom: 1px solid var(--light-gray); 
            display: flex; align-items: center; gap: 12px;
        }
        .form-card-header .icon-box {
            width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; flex-shrink: 0;
        }
        .form-card-header h3 { font-size: 1.05rem; font-weight: 700; color: var(--primary-dark); }
        .form-card-header p { font-size: 0.8rem; color: var(--gray); margin-top: 2px; }

        .form-card-body { padding: 28px; }

        /* FORM GRID */
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 22px; }
        .form-grid .form-group.full-width { grid-column: 1 / -1; }

        .form-group { margin-bottom: 0; }
        .form-label { 
            display: flex; align-items: center; gap: 8px;
            font-size: 0.85rem; font-weight: 600; color: var(--dark); margin-bottom: 8px;
        }
        .form-label i { color: var(--primary); font-size: 0.8rem; }
        .form-label .required { color: var(--danger); margin-left: 2px; }

        .form-control {
            width: 100%; padding: 12px 16px; border: 2px solid var(--light-gray); border-radius: 10px;
            font-size: 0.9rem; color: var(--dark); outline: none; transition: var(--transition);
            background: #fafbfc;
        }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(26,95,180,.1); background: white; }
        .form-control::placeholder { color: #a0aec0; }

        select.form-control { 
            appearance: none; 
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23718096' d='M6 8.825L.575 3.4l.85-.85L6 7.125 10.575 2.55l.85.85z'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;
        }

        .form-hint { font-size: 0.75rem; color: var(--gray); margin-top: 6px; display: flex; align-items: center; gap: 5px; }
        .form-hint i { font-size: 0.7rem; }

        .password-wrapper { position: relative; }
        .password-wrapper .form-control { padding-right: 44px; }
        .password-toggle {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; color: var(--gray); cursor: pointer; font-size: 1rem;
            padding: 4px; transition: var(--transition);
        }
        .password-toggle:hover { color: var(--primary); }

        /* ROLE SELECTOR CARDS */
        .role-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .role-card {
            border: 2px solid var(--light-gray); border-radius: 12px; padding: 20px 16px;
            text-align: center; cursor: pointer; transition: var(--transition);
            background: #fafbfc; position: relative;
        }
        .role-card:hover { border-color: var(--primary); background: rgba(26,95,180,0.02); }
        .role-card.selected { border-color: var(--primary); background: rgba(26,95,180,0.05); box-shadow: 0 0 0 4px rgba(26,95,180,0.1); }
        .role-card input { position: absolute; opacity: 0; pointer-events: none; }
        .role-card .role-icon {
            width: 50px; height: 50px; border-radius: 12px; margin: 0 auto 12px;
            display: flex; align-items: center; justify-content: center; font-size: 1.3rem; transition: var(--transition);
        }
        .role-card .role-name { font-weight: 700; font-size: 0.9rem; color: var(--dark); margin-bottom: 4px; }
        .role-card .role-desc { font-size: 0.7rem; color: var(--gray); line-height: 1.4; }

        .role-card.admin-card .role-icon { background: rgba(26,95,180,0.1); color: var(--primary); }
        .role-card.admin-card.selected .role-icon { background: var(--primary); color: white; }
        .role-card.ustadz-card .role-icon { background: rgba(38,162,105,0.1); color: var(--secondary); }
        .role-card.ustadz-card.selected .role-icon { background: var(--secondary); color: white; }
        .role-card.ortu-card .role-icon { background: rgba(229,165,10,0.1); color: var(--accent); }
        .role-card.ortu-card.selected .role-icon { background: var(--accent); color: white; }

        .role-card .check-mark {
            position: absolute; top: 10px; right: 10px; width: 22px; height: 22px;
            background: var(--primary); border-radius: 50%; color: white;
            display: none; align-items: center; justify-content: center; font-size: 0.7rem;
        }
        .role-card.selected .check-mark { display: flex; }

        /* CONDITIONAL ORTU SECTIONS */
        .ortu-sections { display: none; animation: slideDown 0.4s ease; }
        .ortu-sections.active { display: block; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-15px); } to { opacity: 1; transform: translateY(0); } }

        .section-divider {
            display: flex; align-items: center; gap: 12px; margin: 30px 0 25px;
            color: var(--accent); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;
        }
        .section-divider::before, .section-divider::after {
            content: ''; flex: 1; height: 2px; background: linear-gradient(90deg, var(--accent), transparent);
        }
        .section-divider::before { background: linear-gradient(90deg, transparent, var(--accent)); }
        .section-divider i { font-size: 1rem; }

        .santri-entry { position: relative; background: #fafbfc; border: 2px solid var(--light-gray); border-radius: 12px; padding: 24px; margin-bottom: 16px; transition: var(--transition); }
        .santri-entry:hover { border-color: rgba(229,165,10,0.3); }
        .santri-entry-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
        .santri-entry-header h4 { font-size: 0.9rem; font-weight: 700; color: var(--accent); display: flex; align-items: center; gap: 8px; }
        .santri-entry-header h4 .entry-num {
            width: 28px; height: 28px; border-radius: 8px; background: var(--accent); color: white;
            display: flex; align-items: center; justify-content: center; font-size: 0.8rem;
        }
        .btn-remove-santri {
            background: rgba(229,62,62,0.1); color: var(--danger); border: none; padding: 6px 12px;
            border-radius: 8px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: var(--transition);
            display: flex; align-items: center; gap: 5px;
        }
        .btn-remove-santri:hover { background: rgba(229,62,62,0.2); }
        .btn-add-santri {
            display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%;
            padding: 14px; border: 2px dashed var(--light-gray); border-radius: 12px; background: transparent;
            color: var(--gray); font-weight: 600; font-size: 0.85rem; cursor: pointer; transition: var(--transition);
        }
        .btn-add-santri:hover { border-color: var(--accent); color: var(--accent); background: rgba(229,165,10,0.03); }

        /* FORM ACTIONS */
        .form-actions {
            display: flex; justify-content: flex-end; gap: 12px; padding: 20px 28px;
            background: var(--light); border-top: 1px solid var(--light-gray);
        }
        .btn { 
            display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; 
            border-radius: 10px; font-weight: 600; font-size: 0.9rem; cursor: pointer; 
            transition: var(--transition); border: none; 
        }
        .btn-primary { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: #fff; box-shadow: 0 4px 12px rgba(26,95,180,0.3); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(26,95,180,0.4); }
        .btn-secondary { background: white; color: var(--gray); border: 2px solid var(--light-gray); }
        .btn-secondary:hover { background: var(--light); color: var(--dark); border-color: #cbd5e0; }

        /* ALERT */
        .alert { padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 0.875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); border-left: 4px solid var(--success); }
        .alert-danger  { background: rgba(229,62,62,.1);  color: #c53030; border: 1px solid rgba(229,62,62,.2); border-left: 4px solid var(--danger); }

        /* INFO CARD */
        .info-card { background: white; border-radius: 12px; box-shadow: var(--shadow); overflow: hidden; }
        .info-card-header {
            padding: 18px 24px; border-bottom: 1px solid var(--light-gray);
            display: flex; align-items: center; gap: 10px;
        }
        .info-card-header .icon-box {
            width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center;
            background: rgba(14,165,233,0.1); color: var(--info); font-size: 1rem;
        }
        .info-card-header h4 { font-size: 0.95rem; font-weight: 700; color: var(--primary-dark); }
        .info-card-body { padding: 20px 24px; }
        .info-card-body ul { margin-left: 8px; }
        .info-card-body li { font-size: 0.8rem; color: var(--gray); margin-bottom: 8px; display: flex; align-items: flex-start; gap: 8px; }
        .info-card-body li i { color: var(--info); margin-top: 3px; font-size: 0.7rem; }
        .info-card-body li:last-child { margin-bottom: 0; }

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
        
        @media (max-width: 768px) {
            .dashboard-content { padding: 20px 15px; }
            .page-header-card { flex-direction: column; text-align: center; padding: 25px 20px; }
            .header-icon { width: 60px; height: 60px; font-size: 1.5rem; }
            .header-text h1 { font-size: 1.4rem; }
            .form-grid { grid-template-columns: 1fr; }
            .role-cards { grid-template-columns: 1fr; }
            .form-actions { flex-direction: column; }
            .form-actions .btn { width: 100%; justify-content: center; }
            .form-card-body { padding: 20px; }
            .top-nav { flex-direction: column; align-items: flex-start; gap: 10px; }
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
                                    $nama = session()->get('nama_lengkap') ?? 'AD';
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
                                <div class="user-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Administrator') ?></div>
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
                <div class="admin-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Administrator') ?></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('admin/users') ?>"><i class="fas fa-users-cog"></i><span>Manajemen Akun</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/santri') ?>"><i class="fas fa-user-graduate"></i><span>Data Santri</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/ustadz') ?>"><i class="fas fa-chalkboard-teacher"></i><span>Data Ustadz</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/kelas') ?>"><i class="fas fa-school"></i><span>Data Kelas</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/hafalan') ?>"><i class="fas fa-quran"></i><span>Progres Hafalan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pembayaran') ?>"><i class="fas fa-money-bill-wave"></i><span>Keuangan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pengumuman') ?>"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="dashboard-content" id="mainContent">
            
            <!-- BACK BUTTON -->
            <div class="top-nav">
                <a href="<?= base_url('admin/users') ?>" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pengguna
                </a>
            </div>

            <!-- ALERTS -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <div style="display:flex;flex-direction:column;">
                        <?php foreach(session()->getFlashdata('errors') as $err): ?>
                            <span><?= $err ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- PAGE HEADER -->
            <div class="page-header-card">
                <div class="header-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="header-text">
                    <h1>Tambah Akun Baru</h1>
                    <p>Buat akun pengguna baru untuk mengakses sistem PTQ Pencongan</p>
                </div>
            </div>

            <form action="<?= base_url('admin/users/store') ?>" method="POST" id="createUserForm">
                <?= csrf_field() ?>

                <!-- FORM CARD: DATA AKUN -->
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="icon-box" style="background: rgba(26,95,180,0.1); color: var(--primary);">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div>
                            <h3>Data Akun</h3>
                            <p>Informasi login dan identitas pengguna</p>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-user"></i> Nama Lengkap <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan nama lengkap pengguna" value="<?= old('nama_lengkap') ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-at"></i> Username <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" name="username" placeholder="Masukkan username untuk login" value="<?= old('username') ?>" required>
                                <div class="form-hint"><i class="fas fa-info-circle"></i> Username harus unik dan minimal 3 karakter</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <input type="email" class="form-control" name="email" placeholder="contoh@email.com (opsional)" value="<?= old('email') ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-lock"></i> Password <span class="required">*</span>
                                </label>
                                <div class="password-wrapper">
                                    <input type="password" class="form-control" name="password" id="passwordField" placeholder="Minimal 5 karakter" required>
                                    <button type="button" class="password-toggle" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="passwordIcon"></i>
                                    </button>
                                </div>
                                <div class="form-hint"><i class="fas fa-shield-alt"></i> Gunakan kombinasi huruf dan angka untuk keamanan</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM CARD: PILIH PERAN -->
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="icon-box" style="background: rgba(139,92,246,0.1); color: var(--purple);">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div>
                            <h3>Pilih Peran (Role)</h3>
                            <p>Tentukan hak akses pengguna dalam sistem</p>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="role-cards">
                            <label class="role-card admin-card <?= old('role') === 'admin' ? 'selected' : '' ?>">
                                <input type="radio" name="role" value="admin" <?= old('role') === 'admin' ? 'checked' : '' ?> required>
                                <div class="check-mark"><i class="fas fa-check"></i></div>
                                <div class="role-icon"><i class="fas fa-user-cog"></i></div>
                                <div class="role-name">Admin</div>
                                <div class="role-desc">Akses penuh ke seluruh fitur manajemen sistem</div>
                            </label>
                            <label class="role-card ustadz-card <?= old('role') === 'ustadz' ? 'selected' : '' ?>">
                                <input type="radio" name="role" value="ustadz" <?= old('role') === 'ustadz' ? 'checked' : '' ?>>
                                <div class="check-mark"><i class="fas fa-check"></i></div>
                                <div class="role-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                                <div class="role-name">Ustadz / Guru</div>
                                <div class="role-desc">Kelola absensi, hafalan, dan jadwal mengajar</div>
                            </label>
                            <label class="role-card ortu-card <?= old('role') === 'ortu' ? 'selected' : '' ?>">
                                <input type="radio" name="role" value="ortu" <?= old('role') === 'ortu' ? 'checked' : '' ?>>
                                <div class="check-mark"><i class="fas fa-check"></i></div>
                                <div class="role-icon"><i class="fas fa-user-friends"></i></div>
                                <div class="role-name">Orang Tua</div>
                                <div class="role-desc">Pantau progres hafalan dan pembayaran anak</div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- CONDITIONAL: ORTU SECTIONS -->
                <div class="ortu-sections" id="ortuSections">

                    <!-- DIVIDER -->
                    <div class="section-divider"><i class="fas fa-child"></i> Data Tambahan Orang Tua</div>

                    <!-- FORM CARD: DATA ORANG TUA / WALI -->
                    <div class="form-card">
                        <div class="form-card-header">
                            <div class="icon-box" style="background: rgba(229,165,10,0.1); color: var(--accent);">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div>
                                <h3>Data Orang Tua / Wali</h3>
                                <p>Informasi kontak dan identitas orang tua</p>
                            </div>
                        </div>
                        <div class="form-card-body">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-male"></i> Nama Ayah
                                    </label>
                                    <input type="text" class="form-control" name="nama_ayah" placeholder="Masukkan nama ayah" value="<?= old('nama_ayah') ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-female"></i> Nama Ibu
                                    </label>
                                    <input type="text" class="form-control" name="nama_ibu" placeholder="Masukkan nama ibu" value="<?= old('nama_ibu') ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-phone-alt"></i> No. HP Ayah
                                    </label>
                                    <input type="text" class="form-control" name="no_telepon_ayah" placeholder="Contoh: 08123456xxxx" value="<?= old('no_telepon_ayah') ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-phone-alt"></i> No. HP Ibu
                                    </label>
                                    <input type="text" class="form-control" name="no_telepon_ibu" placeholder="Contoh: 08123456xxxx" value="<?= old('no_telepon_ibu') ?>">
                                </div>
                                <div class="form-group full-width">
                                    <label class="form-label">
                                        <i class="fas fa-map-marker-alt"></i> Alamat Orang Tua
                                    </label>
                                    <input type="text" class="form-control" name="alamat_ortu" placeholder="Alamat lengkap orang tua" value="<?= old('alamat_ortu') ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FORM CARD: BIODATA SANTRI -->
                    <div class="form-card">
                        <div class="form-card-header">
                            <div class="icon-box" style="background: rgba(38,162,105,0.1); color: var(--secondary);">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div>
                                <h3>Biodata Santri (Anak)</h3>
                                <p>Data anak yang ditautkan ke akun orang tua ini</p>
                            </div>
                        </div>
                        <div class="form-card-body">
                            <div id="santriContainer">
                                <!-- Santri Entry 1 -->
                                <div class="santri-entry" data-index="0">
                                    <div class="santri-entry-header">
                                        <h4><span class="entry-num">1</span> Santri ke-1</h4>
                                    </div>
                                    <div class="form-grid">
                                        <div class="form-group full-width">
                                            <label class="form-label">
                                                <i class="fas fa-user"></i> Nama Lengkap Santri <span class="required">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="santri[0][nama_santri]" placeholder="Nama lengkap anak" value="<?= old('santri.0.nama_santri') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-venus-mars"></i> Jenis Kelamin <span class="required">*</span>
                                            </label>
                                            <select class="form-control" name="santri[0][jenis_kelamin]">
                                                <option value="">-- Pilih --</option>
                                                <option value="L" <?= old('santri.0.jenis_kelamin') === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                                <option value="P" <?= old('santri.0.jenis_kelamin') === 'P' ? 'selected' : '' ?>>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-map-pin"></i> Tempat Lahir
                                            </label>
                                            <input type="text" class="form-control" name="santri[0][tempat_lahir]" placeholder="Kota/Kabupaten" value="<?= old('santri.0.tempat_lahir') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-calendar-alt"></i> Tanggal Lahir <span class="required">*</span>
                                            </label>
                                            <input type="date" class="form-control" name="santri[0][tanggal_lahir]" value="<?= old('santri.0.tanggal_lahir') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-home"></i> Alamat Lengkap
                                            </label>
                                            <input type="text" class="form-control" name="santri[0][alamat]" placeholder="Alamat lengkap santri" value="<?= old('santri.0.alamat') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-graduation-cap"></i> Tahun Angkatan
                                            </label>
                                            <input type="number" class="form-control" name="santri[0][tahun_angkatan]" placeholder="<?= date('Y') ?>" value="<?= old('santri.0.tahun_angkatan') ?? date('Y') ?>" min="2000" max="2099">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn-add-santri" id="btnAddSantri" onclick="addSantriEntry()">
                                <i class="fas fa-plus-circle"></i> Tambah Data Santri Lainnya
                            </button>
                        </div>
                    </div>
                </div>

                <!-- FORM ACTIONS -->
                <div class="form-card" style="box-shadow:none; background:transparent;">
                    <div class="form-actions" style="border-radius: 12px;">
                        <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save"></i> Simpan Akun
                        </button>
                    </div>
                </div>
            </form>

            <!-- INFO CARD -->
            <div class="info-card">
                <div class="info-card-header">
                    <div class="icon-box"><i class="fas fa-lightbulb"></i></div>
                    <h4>Panduan Pembuatan Akun</h4>
                </div>
                <div class="info-card-body">
                    <ul>
                        <li><i class="fas fa-circle"></i> Pastikan username belum digunakan oleh pengguna lain dalam sistem.</li>
                        <li><i class="fas fa-circle"></i> Password yang kuat sebaiknya terdiri dari minimal 5 karakter dengan kombinasi huruf dan angka.</li>
                        <li><i class="fas fa-circle"></i> Peran <strong>Admin</strong> memiliki akses penuh, termasuk mengelola akun pengguna lain.</li>
                        <li><i class="fas fa-circle"></i> Peran <strong>Ustadz</strong> memberikan akses ke fitur pengajaran dan penilaian hafalan.</li>
                        <li><i class="fas fa-circle"></i> Peran <strong>Orang Tua</strong> hanya dapat memantau perkembangan putra/putrinya.</li>
                        <li><i class="fas fa-circle"></i> Akun yang dibuat akan langsung berstatus <strong>Aktif</strong> dan dapat digunakan untuk login.</li>
                    </ul>
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

        // Auto-hide alert
        document.querySelectorAll('.alert').forEach(a => setTimeout(() => { 
            a.style.opacity = '0'; 
            a.style.transition = 'opacity 0.4s';
            setTimeout(() => a.remove(), 400); 
        }, 5000));

        // Password toggle
        function togglePassword() {
            const field = document.getElementById('passwordField');
            const icon = document.getElementById('passwordIcon');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Role selector — listen on radio change events
        document.querySelectorAll('input[name="role"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const card = this.closest('.role-card');
                document.querySelectorAll('.role-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');

                // Show/hide ortu sections
                const ortuSections = document.getElementById('ortuSections');
                if (this.value === 'ortu') {
                    ortuSections.classList.add('active');
                    // Scroll to show the new sections
                    setTimeout(() => ortuSections.scrollIntoView({ behavior: 'smooth', block: 'start' }), 100);
                } else {
                    ortuSections.classList.remove('active');
                }
            });
        });

        // Add more santri entries
        let santriIndex = 1;
        function addSantriEntry() {
            const container = document.getElementById('santriContainer');
            const idx = santriIndex;
            santriIndex++;
            const entry = document.createElement('div');
            entry.className = 'santri-entry';
            entry.dataset.index = idx;
            entry.innerHTML = `
                <div class="santri-entry-header">
                    <h4><span class="entry-num">${idx + 1}</span> Santri ke-${idx + 1}</h4>
                    <button type="button" class="btn-remove-santri" onclick="removeSantriEntry(this)">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap Santri <span class="required">*</span></label>
                        <input type="text" class="form-control" name="santri[${idx}][nama_santri]" placeholder="Nama lengkap anak">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin <span class="required">*</span></label>
                        <select class="form-control" name="santri[${idx}][jenis_kelamin]">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-map-pin"></i> Tempat Lahir</label>
                        <input type="text" class="form-control" name="santri[${idx}][tempat_lahir]" placeholder="Kota/Kabupaten">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-calendar-alt"></i> Tanggal Lahir <span class="required">*</span></label>
                        <input type="date" class="form-control" name="santri[${idx}][tanggal_lahir]">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-home"></i> Alamat Lengkap</label>
                        <input type="text" class="form-control" name="santri[${idx}][alamat]" placeholder="Alamat lengkap santri">
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-graduation-cap"></i> Tahun Angkatan</label>
                        <input type="number" class="form-control" name="santri[${idx}][tahun_angkatan]" placeholder="${new Date().getFullYear()}" value="${new Date().getFullYear()}" min="2000" max="2099">
                    </div>
                </div>
            `;
            container.appendChild(entry);
            entry.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        function removeSantriEntry(btn) {
            if (confirm('Hapus data santri ini?')) {
                btn.closest('.santri-entry').remove();
                // Re-number entries
                document.querySelectorAll('.santri-entry').forEach((e, i) => {
                    e.querySelector('.entry-num').textContent = i + 1;
                    e.querySelector('h4').childNodes[1].textContent = ` Santri ke-${i + 1}`;
                });
            }
        }

        // On page load, check if ortu was previously selected (old input)
        document.addEventListener('DOMContentLoaded', function() {
            const checkedRole = document.querySelector('input[name="role"]:checked');
            if (checkedRole && checkedRole.value === 'ortu') {
                document.getElementById('ortuSections').classList.add('active');
            }
        });
    </script>
</body>
</html>
