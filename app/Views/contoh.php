<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PTQ Al-Hikmah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET */
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
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        ul {
            list-style: none;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        /* IMPROVED HEADER/NAVBAR */
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px;
            border-radius: var(--radius);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .logo img {
            height: 36px;
            filter: brightness(0) invert(1);
        }
        
        .logo-text {
            font-size: 1.4rem;
            font-weight: 700;
            color: white;
            letter-spacing: 0.5px;
        }
        
        .logo-text span {
            color: var(--accent);
        }
        
        .mobile-menu-toggle {
            display: none;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: white;
            font-size: 1.4rem;
            width: 44px;
            height: 44px;
            border-radius: var(--radius);
            cursor: pointer;
            transition: var(--transition);
            align-items: center;
            justify-content: center;
        }
        
        .mobile-menu-toggle:hover {
            background: rgba(255, 255, 255, 0.25);
        }
        
        .user-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .notification-bell {
            position: relative;
            background: rgba(255, 255, 255, 0.15);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .notification-bell:hover {
            background: rgba(255, 255, 255, 0.25);
        }
        
        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: var(--accent);
            color: white;
            font-size: 0.7rem;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            border-radius: var(--radius);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: var(--transition);
            cursor: pointer;
        }
        
        .user-info:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            overflow: hidden;
            background: linear-gradient(135deg, var(--purple) 0%, var(--info) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        
        .user-details {
            color: white;
        }
        
        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .user-role {
            font-size: 0.8rem;
            opacity: 0.9;
        }
        
        .user-dropdown {
            position: relative;
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            width: 200px;
            background: white;
            border-radius: var(--radius);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            margin-top: 10px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--transition);
            z-index: 100;
        }
        
        .dropdown-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--dark);
            transition: var(--transition);
            border-bottom: 1px solid var(--light-gray);
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
        }
        
        .dropdown-item:hover {
            background: var(--light);
            color: var(--primary);
        }
        
        .dropdown-item i {
            width: 20px;
            text-align: center;
            color: var(--gray);
        }
        
        .dropdown-item:hover i {
            color: var(--primary);
        }
        
        .logout-btn {
            color: var(--danger);
        }
        
        .logout-btn:hover {
            background: rgba(229, 62, 62, 0.1);
        }
        
        /* DASHBOARD LAYOUT */
        .dashboard-container {
            display: flex;
            min-height: calc(100vh - 68px);
        }
        
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--primary-dark) 0%, #152a57 100%);
            color: white;
            padding: 20px 0;
            transition: var(--transition);
            position: relative;
            z-index: 99;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }
        
        .welcome-text {
            font-size: 1.1rem;
            margin-bottom: 5px;
            opacity: 0.9;
        }
        
        .admin-name {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--accent);
        }
        
        .sidebar-menu {
            padding: 0 15px;
        }
        
        .menu-item {
            margin-bottom: 5px;
        }
        
        .menu-item a {
            display: flex;
            align-items: center;
            padding: 14px 15px;
            border-radius: var(--radius);
            transition: var(--transition);
        }
        
        .menu-item a:hover, .menu-item.active a {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        
        .menu-item i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .dashboard-content {
            flex: 1;
            padding: 30px;
            background-color: #f5f7fa;
            overflow-y: auto;
            transition: var(--transition);
        }
        
        .page-title {
            font-size: 1.8rem;
            color: var(--primary-dark);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        /* STATS CARDS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: var(--transition);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card {
            padding: 20px;
            border-radius: var(--radius);
            color: white;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .stat-card.primary {
            background-color: var(--primary);
        }
        
        .stat-card.secondary {
            background-color: var(--secondary);
        }
        
        .stat-card.accent {
            background-color: var(--accent);
        }
        
        .stat-card.warning {
            background-color: var(--warning);
        }
        
        .stat-card.info {
            background-color: var(--info);
        }
        
        .stat-card.purple {
            background-color: var(--purple);
        }
        
        .stat-card.danger {
            background-color: var(--danger);
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
            position: relative;
            z-index: 1;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }
        
        .stat-icon {
            align-self: flex-end;
            margin-top: 10px;
            font-size: 1.8rem;
            opacity: 0.8;
            position: relative;
            z-index: 1;
        }
        
        /* DASHBOARD SECTIONS */
        .dashboard-section {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 1.4rem;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-actions a {
            color: var(--primary);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: var(--transition);
        }
        
        .section-actions a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        /* TABLE STYLES */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .data-table th {
            text-align: left;
            padding: 12px 15px;
            background-color: var(--light);
            color: var(--dark);
            font-weight: 600;
            border-bottom: 2px solid var(--light-gray);
        }
        
        .data-table td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .data-table tr:hover {
            background-color: #f8fafc;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .status-badge.active {
            background-color: rgba(56, 161, 105, 0.15);
            color: var(--success);
        }
        
        .status-badge.pending {
            background-color: rgba(221, 107, 32, 0.15);
            color: var(--warning);
        }
        
        .status-badge.inactive {
            background-color: rgba(113, 128, 150, 0.15);
            color: var(--gray);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: var(--radius);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
        }
        
        .btn-secondary {
            background-color: var(--light-gray);
            color: var(--dark);
        }
        
        .btn-secondary:hover {
            background-color: #d1d9e6;
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
        
        /* QUICK ACTIONS */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .action-card {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
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
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: white;
        }
        
        .action-title {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .action-desc {
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        /* OVERLAY FOR MOBILE SIDEBAR */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 98;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }
        
        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        /* RESPONSIVE STYLES */
        @media (max-width: 992px) {
            .dashboard-container {
                position: relative;
            }
            
            .sidebar {
                position: fixed;
                left: -280px;
                height: 100vh;
                top: 0;
                z-index: 99;
                transition: var(--transition);
                overflow-y: auto;
            }
            
            .sidebar.active {
                left: 0;
            }
            
            .mobile-menu-toggle {
                display: flex;
            }
            
            .dashboard-content {
                width: 100%;
            }
            
            .user-details {
                display: none;
            }
            
            .quick-actions {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .header-content {
                padding: 10px 0;
            }
            
            .logo-text {
                font-size: 1.2rem;
            }
            
            .logo img {
                height: 32px;
            }
            
            .notification-bell {
                width: 40px;
                height: 40px;
            }
            
            .user-avatar {
                width: 38px;
                height: 38px;
            }
            
            .dashboard-content {
                padding: 20px;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
            }
            
            .stat-card {
                padding: 15px;
            }
            
            .stat-value {
                font-size: 1.6rem;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .data-table {
                display: block;
                overflow-x: auto;
            }
        }
        
        @media (max-width: 576px) {
            .container {
                padding: 0 10px;
            }
            
            .logo-text span {
                display: none;
            }
            
            .user-info {
                padding: 6px;
            }
            
            .dashboard-content {
                padding: 15px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }
            
            .stat-card {
                padding: 12px;
            }
            
            .stat-value {
                font-size: 1.4rem;
            }
            
            .stat-label {
                font-size: 0.8rem;
            }
            
            .stat-icon {
                font-size: 1.2rem;
            }
            
            .page-title {
                font-size: 1.3rem;
            }
            
            .dashboard-section {
                padding: 15px;
            }
            
            .dropdown-menu {
                width: 180px;
            }
            
            .quick-actions {
                grid-template-columns: 1fr 1fr;
            }
            
            .action-card {
                padding: 15px;
            }
        }
        
        @media (max-width: 400px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
            
            .logo-text {
                font-size: 1rem;
            }
            
            .logo img {
                height: 28px;
            }
            
            .mobile-menu-toggle {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <!-- IMPROVED HEADER/NAVBAR -->
    <header class="dashboard-header">
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <button class="mobile-menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="logo">
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PHBhdGggZD0iTTEyIDJMMiA3bDEwIDUgMTAtNS0xMC01eiI+PC9wYXRoPjxwYXRoIGQ9Ik0yIDE3bDEwIDUgMTAtNSI+PC9wYXRoPjxwYXRoIGQ9Ik0yIDEybDEwIDUgMTAtNSI+PC9wYXRoPjwvc3ZnPg==" alt="Logo PTQ">
                        <div class="logo-text">PTQ <span>Al-Hikmah</span></div>
                    </div>
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
                                    // Ambil inisial dari nama admin
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
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user"></i>
                                <span>Profil Saya</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-cog"></i>
                                <span>Pengaturan</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-question-circle"></i>
                                <span>Bantuan</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url('auth/logout') ?>" class="dropdown-item logout-btn" id="logoutBtn">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Keluar</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- DASHBOARD LAYOUT -->
    <div class="dashboard-container">
        <!-- SIDEBAR OVERLAY FOR MOBILE -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <!-- SIDEBAR -->
        <div class="sidebar" id="sidebar">
            <!-- Sidebar Header -->
            <div class="sidebar-header">
                <div class="welcome-text">Selamat Datang,</div>
                <div class="admin-name"><?= htmlspecialchars($nama_admin ?? 'Administrator') ?></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item active">
                    <a href="<?= base_url('admin/dashboard') ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= base_url('admin/santri') ?>">
                        <i class="fas fa-users"></i>
                        <span>Data Santri</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= base_url('admin/pengajar') ?>">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Data Pengajar</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= base_url('admin/orangtua') ?>">
                        <i class="fas fa-user-friends"></i>
                        <span>Data Orang Tua</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= base_url('admin/hafalan') ?>">
                        <i class="fas fa-quran"></i>
                        <span>Progres Hafalan</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= base_url('admin/pembayaran') ?>">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Pembayaran</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= base_url('admin/jadwal') ?>">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Jadwal Kegiatan</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= base_url('admin/laporan') ?>">
                        <i class="fas fa-chart-bar"></i>
                        <span>Laporan</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="<?= base_url('admin/pengaturan') ?>">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan Sistem</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- MAIN CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <h1 class="page-title">
                <i class="fas fa-tachometer-alt"></i>
                <?= htmlspecialchars($judul ?? 'Dashboard Admin') ?>
            </h1>
            
            <!-- QUICK ACTIONS -->
            <div class="quick-actions">
                <div class="action-card" onclick="window.location.href='<?= base_url('admin/santri/tambah') ?>'">
                    <div class="action-icon" style="background-color: var(--primary);">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="action-title">Tambah Santri</div>
                    <div class="action-desc">Tambahkan santri baru</div>
                </div>
                
                <div class="action-card" onclick="window.location.href='<?= base_url('admin/pembayaran/input') ?>'">
                    <div class="action-icon" style="background-color: var(--success);">
                        <i class="fas fa-cash-register"></i>
                    </div>
                    <div class="action-title">Input Pembayaran</div>
                    <div class="action-desc">Catat pembayaran baru</div>
                </div>
                
                <div class="action-card" onclick="window.location.href='<?= base_url('admin/hafalan/input') ?>'">
                    <div class="action-icon" style="background-color: var(--warning);">
                        <i class="fas fa-quran"></i>
                    </div>
                    <div class="action-title">Input Hafalan</div>
                    <div class="action-desc">Catat perkembangan hafalan</div>
                </div>
                
                <div class="action-card" onclick="window.location.href='<?= base_url('admin/laporan/harian') ?>'">
                    <div class="action-icon" style="background-color: var(--info);">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="action-title">Buat Laporan</div>
                    <div class="action-desc">Generate laporan harian</div>
                </div>
            </div>
            
            <!-- STATS CARDS -->
            <div class="stats-grid">
                <div class="card stat-card primary">
                    <div class="stat-value"><?= $total_santri ?? 0 ?></div>
                    <div class="stat-label">Total Orang Tua Santri</div>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                
                <div class="card stat-card secondary">
                    <div class="stat-value"><?= $total_pengajar ?? 0 ?></div>
                    <div class="stat-label">Total Pengajar</div>
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                </div>
                
                <div class="card stat-card accent">
                    <div class="stat-value"><?= $total_kelas ?? 0 ?></div>
                    <div class="stat-label">Total Kelas</div>
                    <div class="stat-icon">
                        <i class="fas fa-school"></i>
                    </div>
                </div>
                
                <div class="card stat-card info">
                    <div class="stat-value"><?= $pembayaran_belum_lunas ?? 0 ?></div>
                    <div class="stat-label">Pembayaran Tertunda</div>
                    <div class="stat-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
                
                <div class="card stat-card purple">
                    <div class="stat-value">
                        <?php 
                            if(isset($santri_terbaru) && is_array($santri_terbaru)) {
                                echo count($santri_terbaru);
                            } else {
                                echo 0;
                            }
                        ?>
                    </div>
                    <div class="stat-label">Orang Tua Baru</div>
                    <div class="stat-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
                
                <div class="card stat-card danger">
                    <div class="stat-value"><?= $persentase_kehadiran ?? 0 ?>%</div>
                    <div class="stat-label">Kehadiran Rata-rata</div>
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
            
            <!-- ORANG TUA TERBARU SECTION -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-user-clock"></i>
                        Orang Tua Santri Terbaru
                    </h3>
                    <div class="section-actions">
                        <a href="<?= base_url('admin/orangtua') ?>">
                            <i class="fas fa-eye"></i>
                            Lihat Semua
                        </a>
                    </div>
                </div>
                
                <?php if(!empty($santri_terbaru)): ?>
                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Nama Orang Tua</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($santri_terbaru as $ortu): ?>
                                <tr>
                                    <td><?= htmlspecialchars($ortu['nama_lengkap'] ?? $ortu['username'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($ortu['email'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($ortu['no_telepon'] ?? $ortu['telepon'] ?? 'N/A') ?></td>
                                    <td>
                                        <?php 
                                            $created_at = $ortu['created_at'] ?? date('Y-m-d H:i:s');
                                            echo date('d/m/Y', strtotime($created_at));
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onclick="window.location.href='<?= base_url('admin/orangtua/detail/') . ($ortu['id'] ?? '#') ?>'">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div style="text-align: center; padding: 20px; color: var(--gray);">
                        <i class="fas fa-user-friends fa-2x" style="margin-bottom: 10px; opacity: 0.5;"></i>
                        <p>Tidak ada data orang tua santri terbaru</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- PEMBAYARAN TERAKHIR SECTION -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-money-check-alt"></i>
                        Pembayaran Terakhir
                    </h3>
                    <div class="section-actions">
                        <a href="<?= base_url('admin/pembayaran') ?>">
                            <i class="fas fa-eye"></i>
                            Lihat Semua
                        </a>
                    </div>
                </div>
                
                <?php if(!empty($pembayaran_terakhir)): ?>
                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Nama Santri/Orang Tua</th>
                                    <th>Jenis</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pembayaran_terakhir as $pembayaran): ?>
                                <tr>
                                    <td><?= htmlspecialchars($pembayaran['nama_santri'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars($pembayaran['jenis_pembayaran'] ?? 'N/A') ?></td>
                                    <td>
                                        <?php 
                                            $tanggal = $pembayaran['tanggal'] ?? date('Y-m-d');
                                            echo date('d/m/Y', strtotime($tanggal));
                                        ?>
                                    </td>
                                    <td>Rp <?= number_format($pembayaran['jumlah'] ?? 0, 0, ',', '.') ?></td>
                                    <td>
                                        <span class="status-badge <?= ($pembayaran['status'] ?? '') === 'Lunas' ? 'active' : 'pending' ?>">
                                            <?= htmlspecialchars($pembayaran['status'] ?? 'Pending') ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div style="text-align: center; padding: 20px; color: var(--gray);">
                        <i class="fas fa-money-bill-wave fa-2x" style="margin-bottom: 10px; opacity: 0.5;"></i>
                        <p>Belum ada data pembayaran</p>
                        <a href="<?= base_url('admin/pembayaran/input') ?>" class="btn btn-primary" style="margin-top: 10px;">
                            <i class="fas fa-plus"></i> Input Pembayaran Pertama
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- INFORMASI -->
            <div class="dashboard-section">
                <h3>Selamat Datang, <?= htmlspecialchars($nama_admin ?? 'Administrator') ?>!</h3>
                <p>Dashboard admin PTQ Al-Hikmah memberikan Anda kontrol penuh atas sistem manajemen pesantren. Anda dapat mengelola:</p>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>• Data santri dan pengajar</li>
                    <li>• Data orang tua santri</li>
                    <li>• Progres hafalan Al-Qur'an</li>
                    <li>• Pembayaran dan keuangan</li>
                    <li>• Jadwal kegiatan dan ujian</li>
                    <li>• Laporan dan statistik</li>
                    <li>• Pengaturan sistem</li>
                </ul>
                <p style="margin-top: 15px;">Saat ini sistem menampilkan <?= $total_santri ?? 0 ?> orang tua santri yang terdaftar.</p>
                <p>Gunakan menu di sebelah kiri atau tombol aksi cepat di atas untuk memulai.</p>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
        });
        
        // Close sidebar when clicking on overlay
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        // User dropdown toggle
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');
        
        userDropdownToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && !userDropdownToggle.contains(e.target)) {
                userDropdown.classList.remove('active');
            }
            
            if (window.innerWidth <= 992 && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
        
        // Close sidebar when clicking on a menu item (mobile)
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
        
        // Logout functionality
        document.getElementById('logoutBtn').addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                window.location.href = this.getAttribute('href');
            }
        });
        
        // Notification bell click
        document.querySelector('.notification-bell').addEventListener('click', function() {
            alert('Fitur notifikasi akan segera hadir');
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
        
        // Add swipe functionality for mobile
        let touchStartX = 0;
        let touchEndX = 0;
        
        document.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });
        
        document.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });
        
        function handleSwipe() {
            const swipeThreshold = 50;
            
            // Swipe right to open sidebar
            if (touchEndX > touchStartX + swipeThreshold && window.innerWidth <= 992) {
                sidebar.classList.add('active');
                sidebarOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
            
            // Swipe left to close sidebar
            if (touchStartX > touchEndX + swipeThreshold && window.innerWidth <= 992) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }
        
        // Prevent body scroll when sidebar is open on mobile
        document.addEventListener('DOMContentLoaded', function() {
            // Check if we're on mobile initially
            if (window.innerWidth <= 992) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            }
            
            // Highlight active menu item based on current URL
            const currentPath = window.location.pathname;
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                const linkPath = new URL(link.href, window.location.origin).pathname;
                if (currentPath === linkPath || currentPath.startsWith(linkPath + '/')) {
                    link.parentElement.classList.add('active');
                } else {
                    link.parentElement.classList.remove('active');
                }
            });
            
            // Action card animations
            document.querySelectorAll('.action-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>