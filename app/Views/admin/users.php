<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun - PTQ Al-Hikmah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET (From Uniform Dashboard) */
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
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 0; position: sticky; top: 0; z-index: 1000;
        }
        .header-content { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; }
        .logo-section { display: flex; align-items: center; gap: 15px; }
        .logo { display: flex; align-items: center; gap: 12px; padding: 8px 12px; border-radius: var(--radius); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); }
        .logo img { height: 36px; filter: brightness(0) invert(1); }
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
        .page-title { font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        
        /* USERS PAGE SPECIFIC STYLES */
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); flex-wrap: wrap; gap: 10px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); display: flex; align-items: center; gap: 10px; }
        
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: .85rem; cursor: pointer; transition: .2s; border: none; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: var(--light-gray); color: var(--dark); }
        .btn-secondary:hover { background: #cbd5e0; }
        
        .filter-bar { padding: 16px 24px; background: var(--light); border-bottom: 1px solid var(--light-gray); display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .filter-label { font-size: .85rem; font-weight: 600; color: var(--gray); display: flex; align-items: center; gap: 6px; }
        .select-filter { padding: 6px 12px; border: 1px solid var(--light-gray); border-radius: 6px; font-size: .85rem; color: var(--dark); outline: none; background: #fff; }

        .table-responsive { overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { text-align: left; padding: 12px 24px; background: var(--light); font-size: .75rem; text-transform: uppercase; letter-spacing: .5px; color: var(--gray); font-weight: 700; border-bottom: 1px solid var(--light-gray); }
        .table td { padding: 14px 24px; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
        .table tr:last-child td { border-bottom: none; }
        .table tr:hover { background: #f8fafc; }

        .user-cell { display: flex; align-items: center; gap: 12px; }
        .u-avatar { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: .8rem; font-weight: 700; color: #fff; flex-shrink: 0; background: var(--gray); }
        .u-info .u-name { font-size: .875rem; font-weight: 600; color: var(--dark); }

        .badge { padding: 6px 12px; border-radius: 20px; font-size: .75rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; }
        .badge-role-admin { background: rgba(78,142,247,.1); color: #4e8ef7; }
        .badge-role-ustadz { background: rgba(78,142,247,.1); color: #4e8ef7; }
        .badge-role-ortu { background: rgba(245,166,35,.1); color: #d99014; }
        .dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; margin-right: 4px; }
        .badge-status-aktif { background: rgba(38,162,105,.1); color: var(--success); }
        .badge-status-aktif .dot { background: var(--success); }
        .badge-status-nonaktif { background: rgba(229,62,62,.1); color: var(--danger); }
        .badge-status-nonaktif .dot { background: var(--danger); }

        .action-cell { display: flex; gap: 6px; flex-wrap: wrap; }
        .act-btn { width: 32px; height: 32px; border-radius: 8px; border: none; display: flex; align-items: center; justify-content: center; font-size: .85rem; cursor: pointer; transition: .2s; outline: none; color: #fff; }
        .act-toggle-aktif { background: var(--success); }
        .act-toggle-aktif:hover { background: #1e8555; }
        .act-toggle-nonaktif { background: var(--danger); }
        .act-toggle-nonaktif:hover { background: #c53030; }
        .act-detail { background: var(--secondary); }
        .act-detail:hover { background: #1e8555; }
        .act-edit { background: var(--primary); }
        .act-edit:hover { background: var(--primary-dark); }
        .act-delete { background: var(--danger); }
        .act-delete:hover { background: #c53030; }

        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); border-left: 4px solid var(--success); }
        .alert-danger  { background: rgba(229,62,62,.1);  color: #c53030; border: 1px solid rgba(229,62,62,.2); border-left: 4px solid var(--danger); }

        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,.5); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 20px; }
        .modal-overlay.active { display: flex; }
        .modal-card { background: #fff; width: 100%; max-width: 480px; border-radius: var(--radius); box-shadow: 0 10px 30px rgba(0,0,0,.2); overflow: hidden; animation: slideUp .3s ease; }
        @keyframes slideUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }
        .modal-head { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); background: var(--light); }
        .modal-head h3 { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); }
        .btn-close { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: var(--gray); padding: 5px; border-radius: 5px; transition: var(--transition); }
        .btn-close:hover { background: var(--light-gray); color: var(--danger); }
        .modal-body { padding: 24px; max-height: 70vh; overflow-y: auto; }
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: .85rem; font-weight: 600; color: var(--dark); margin-bottom: 8px; }
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid var(--light-gray); border-radius: 6px; font-size: .9rem; color: var(--dark); outline: none; transition: .2s; background: #fff; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,95,180,.15); }
        .form-text { font-size: .75rem; color: var(--gray); margin-top: 4px; }
        .modal-foot { padding: 16px 24px; background: var(--light); border-top: 1px solid var(--light-gray); display: flex; justify-content: flex-end; gap: 10px; }
        .modal-foot .btn { min-width: 100px; }

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
            .u-info { text-align: right; }
            .user-cell { justify-content: flex-end; }
            .card-header { flex-direction: column; align-items: flex-start; }
            .filter-bar { flex-direction: column; align-items: flex-start; }
            .modal-card { max-width: 95%; margin: 10px; }
            .modal-head { padding: 15px; }
            .modal-body { padding: 15px; }
            .modal-foot { padding: 12px 15px; flex-direction: column; }
            .modal-foot .btn { width: 100%; justify-content: center; }
        }
        
        @media (max-width: 576px) {
            .action-cell { justify-content: flex-end; }
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
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PHBhdGggZD0iTTEyIDJMMiA3bDEwIDUgMTAtNS0xMC01eiI+PC9wYXRoPjxwYXRoIGQ9Ik0yIDE3bDEwIDUgMTAtNSI+PC9wYXRoPjxwYXRoIGQ9Ik0yIDEybDEwIDUgMTAtNSI+PC9wYXRoPjwvc3ZnPg==" alt="Logo PTQ">
                        <div class="logo-text">PTQ <span>Al-Hikmah</span></div>
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
            <h1 class="page-title"><i class="fas fa-users-cog"></i> Manajemen Akun</h1>

            <!-- ALERTS -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
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

            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(26,95,180,.1);color:var(--primary);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-users"></i>
                        </div>
                        Tabel Pengguna
                    </div>
                    <a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Akun Baru
                    </a>
                </div>
                
                <div class="filter-bar">
                    <div class="filter-label"><i class="fas fa-filter"></i> Filter:</div>
                    <select class="select-filter" onchange="window.location.href='<?= base_url('admin/users') ?>' + (this.value ? '?role='+this.value : '')">
                        <option value="">-- Semua Peran --</option>
                        <option value="admin" <?= ($roleFilter ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="ustadz" <?= ($roleFilter ?? '') === 'ustadz' ? 'selected' : '' ?>>Ustadz/Guru</option>
                        <option value="ortu" <?= ($roleFilter ?? '') === 'ortu' ? 'selected' : '' ?>>Orang Tua</option>
                    </select>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Peran (Role)</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($users)): ?>
                                <?php foreach($users as $u): ?>
                                    <tr>
                                        <td data-label="Username"><span style="color:var(--gray);font-size:.85rem;font-weight:500;">@<?= htmlspecialchars($u['username']) ?></span></td>
                                        <td data-label="Nama Lengkap">
                                            <div class="user-cell">
                                                <div class="u-avatar" style="background: linear-gradient(135deg, var(--primary) 0%, var(--info) 100%);">
                                                    <?php
                                                        $i = ''; $p = explode(' ', $u['nama_lengkap'] ?? $u['username']);
                                                        foreach($p as $w) { $i .= strtoupper(substr($w,0,1)); if(strlen($i)>=2) break; }
                                                        echo $i ?: 'U';
                                                    ?>
                                                </div>
                                                <div class="u-info">
                                                    <div class="u-name"><?= htmlspecialchars($u['nama_lengkap'] ?? '-') ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Peran (Role)">
                                            <span class="badge badge-role-<?= $u['role'] ?>">
                                                <i class="fas fa-user<?= $u['role'] === 'ustadz' ? '-tie' : ($u['role'] === 'ortu' ? '-friends' : '-cog') ?>"></i>
                                                <?php 
                                                    if($u['role'] == 'admin') echo 'Admin';
                                                    elseif($u['role'] == 'ustadz') echo 'Ustadz/Guru';
                                                    elseif($u['role'] == 'ortu') echo 'Orang Tua';
                                                    else echo ucfirst($u['role']);
                                                ?>
                                            </span>
                                        </td>
                                        <td data-label="Status">
                                            <span class="badge badge-status-<?= $u['status'] ?>">
                                                <span class="dot"></span><?= ucfirst($u['status']) ?>
                                            </span>
                                        </td>
                                        <td data-label="Aksi">
                                            <div class="action-cell">
                                                <a href="<?= base_url('admin/users/detail/' . $u['id']) ?>" class="act-btn act-detail" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <?php if($u['id'] != session()->get('id')): ?>
                                                    <?php if($u['status'] == 'aktif'): ?>
                                                        <a href="<?= base_url('admin/users/toggle/' . $u['id']) ?>" class="act-btn act-toggle-nonaktif" onclick="return confirm('Nonaktifkan akun ini? Pengguna tidak akan bisa login.')" title="Nonaktifkan Akun">
                                                            <i class="fas fa-lock"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?= base_url('admin/users/toggle/' . $u['id']) ?>" class="act-btn act-toggle-aktif" onclick="return confirm('Aktifkan akun ini? Pengguna akan bisa login kembali.')" title="Aktifkan Akun">
                                                            <i class="fas fa-lock-open"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <a href="<?= base_url('admin/users/edit/' . $u['id']) ?>" class="act-btn act-edit" title="Edit Akun">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <?php if($u['id'] != session()->get('id')): ?>
                                                    <a href="<?= base_url('admin/users/delete/' . $u['id']) ?>" class="act-btn act-delete" onclick="return confirm('Hapus akun ini secara permanen? Data tidak dapat dikembalikan.')" title="Hapus Akun">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;padding:60px;color:var(--gray);">
                                        <div style="background: rgba(0,0,0,0.02); border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                            <i class="fas fa-users-slash" style="font-size: 3rem; color: var(--light-gray);"></i>
                                        </div>
                                        <h3 style="margin-bottom: 8px; color: var(--dark); font-weight: 600;">Belum Ada Data Pengguna</h3>
                                        <p>Klik tombol "Tambah Akun Baru" untuk menambahkan pengguna.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <div style="padding:15px 24px;color:var(--gray);font-size:.85rem;border-top:1px solid var(--light-gray);">
                    <i class="fas fa-database"></i> Total <?= count($users ?? []) ?> akun.
                </div>
            </div>

            <!-- INFORMASI -->
            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(14,165,233,.1);color:var(--info);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        Informasi Manajemen Akun
                    </div>
                </div>
                <div style="padding: 20px 24px;">
                    <ul style="margin-left: 20px;">
                        <li>• <strong class="badge-status-aktif" style="background:transparent; padding:0;">Aktif</strong> - Akun dapat digunakan untuk login ke sistem</li>
                        <li>• <strong class="badge-status-nonaktif" style="background:transparent; padding:0;">Nonaktif</strong> - Akun tidak dapat digunakan untuk login</li>
                        <li>• <strong class="badge-role-admin" style="background:transparent; padding:0;">Admin</strong> - Memiliki akses penuh ke semua fitur</li>
                        <li>• <strong class="badge-role-ustadz" style="background:transparent; padding:0;">Ustadz</strong> - Akses terbatas pada fitur pengajaran dan penilaian</li>
                        <li>• <strong class="badge-role-ortu" style="background:transparent; padding:0;">Orang Tua</strong> - Akses hanya untuk memantau putra-putri</li>
                    </ul>
                    <p style="margin-top: 15px; padding-top: 12px; border-top: 1px solid var(--light-gray); font-size: 0.85rem; color: var(--gray);">
                        <i class="fas fa-shield-alt"></i> Anda tidak dapat menonaktifkan atau menghapus akun Anda sendiri.
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
        document.getElementById('logoutBtn').addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                window.location.href = this.getAttribute('href');
            }
        });

        // Auto-hide alert
        document.querySelectorAll('.alert').forEach(a => setTimeout(() => { a.style.opacity=0; setTimeout(()=>a.remove(),400); }, 5000));
    </script>
</body>
</html>