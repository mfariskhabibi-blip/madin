<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?> - PTQ Al-Hikmah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
        .logo img { height: 36px; filter: brightness(0) invert(1); }
        .logo-text { font-size: 1.4rem; font-weight: 700; color: white; letter-spacing: 0.5px; }
        .logo-text span { color: var(--accent); }
        
        .mobile-menu-toggle { display: none; background: rgba(255, 255, 255, 0.15); border: none; color: white; font-size: 1.4rem; width: 44px; height: 44px; border-radius: var(--radius); cursor: pointer; transition: var(--transition); align-items: center; justify-content: center; }
        .mobile-menu-toggle:hover { background: rgba(255, 255, 255, 0.25); }
        
        .user-section { display: flex; align-items: center; gap: 15px; }
        .notification-bell { position: relative; background: rgba(255, 255, 255, 0.15); width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; transition: var(--transition); }
        .notification-bell:hover { background: rgba(255, 255, 255, 0.25); }
        .notification-badge { position: absolute; top: -2px; right: -2px; background: var(--accent); color: white; font-size: 0.7rem; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        
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
        .logout-btn:hover { background: rgba(229, 62, 62, 0.1); }
        
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
        .menu-item i { margin-right: 12px; width: 20px; text-align: center; }
        
        .dashboard-content { flex: 1; padding: 30px; background-color: #f5f7fa; overflow-y: auto; transition: var(--transition); }
        
        /* FINANCIAL DASHBOARD SPECIFIC */
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px; }
        .page-title-group { display: flex; align-items: center; gap: 15px; }
        .page-icon { width: 48px; height: 48px; border-radius: 12px; background: white; color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; box-shadow: var(--shadow); }
        .page-title-group h1 { font-size: 1.6rem; color: var(--primary-dark); font-weight: 800; }
        
        .header-actions { display: flex; align-items: center; gap: 12px; }
        .filter-select { padding: 10px 16px; border-radius: var(--radius); border: 1px solid var(--light-gray); background: white; font-weight: 600; color: var(--dark); outline: none; cursor: pointer; }
        
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: var(--radius); font-weight: 700; font-size: 0.9rem; cursor: pointer; transition: var(--transition); border: none; }
        .btn-primary { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: white; box-shadow: 0 4px 15px rgba(26, 95, 180, 0.3); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(26, 95, 180, 0.4); }

        /* STAT CARDS - FIXED 4 COLUMNS */
        .stats-grid { 
            display: grid; 
            grid-template-columns: repeat(4, 1fr); 
            gap: 20px; 
            margin-bottom: 30px; 
        }
        
        .stat-card { 
            border-radius: 16px; 
            padding: 20px; 
            color: white; 
            position: relative; 
            overflow: hidden; 
            box-shadow: var(--shadow); 
            transition: var(--transition);
            min-width: 0;
        }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-card i.bg-icon { 
            position: absolute; 
            right: -20px; 
            bottom: -20px; 
            font-size: 7rem; 
            opacity: 0.15; 
            transform: rotate(-15deg); 
        }
        
        .stat-label { 
            font-size: 0.7rem; 
            font-weight: 800; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            margin-bottom: 8px; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
            opacity: 0.9; 
        }
        .stat-value { 
            font-size: 1.5rem; 
            font-weight: 800; 
            margin-bottom: 12px; 
            word-wrap: break-word;
            line-height: 1.2;
        }
        .stat-footer { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            background: rgba(255, 255, 255, 0.2); 
            padding: 6px 12px; 
            border-radius: 20px; 
            font-size: 0.7rem; 
            font-weight: 700; 
        }
        
        .card-green { background: linear-gradient(135deg, #26a269 0%, #1c7d50 100%); }
        .card-red { background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%); }
        .card-orange { background: linear-gradient(135deg, #dd6b20 0%, #c05621 100%); }
        .card-purple { background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); }

        /* MAIN CONTENT AREA */
        .premium-card { background: white; border-radius: 16px; box-shadow: var(--shadow); overflow: hidden; border: 1px solid var(--light-gray); }
        .premium-card-header { padding: 24px; border-bottom: 1px solid var(--light-gray); display: flex; align-items: center; gap: 12px; }
        .premium-card-header h2 { font-size: 1.2rem; font-weight: 800; color: var(--primary-dark); }
        .premium-card-header i { color: var(--primary); font-size: 1.2rem; }

        /* TABLE STYLES */
        .table-responsive { width: 100%; overflow-x: auto; }
        .custom-table { width: 100%; border-collapse: collapse; }
        .custom-table th { background: #f8fafc; padding: 16px 24px; text-align: left; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; color: var(--gray); border-bottom: 2px solid var(--light-gray); }
        .custom-table td { padding: 18px 24px; border-bottom: 1px solid var(--light-gray); vertical-align: middle; }
        .custom-table tr:hover { background: #f1f5f9; }

        /* MOBILE CARD STYLES */
        .santri-cards-container {
            display: none;
            gap: 16px;
            flex-direction: column;
            padding: 16px;
        }
        
        .santri-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid var(--light-gray);
            transition: var(--transition);
        }
        
        .santri-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--light-gray);
        }
        
        .card-header-left {
            flex: 1;
        }
        
        .card-nis {
            font-size: 0.75rem;
            color: var(--gray);
            font-family: monospace;
            margin-bottom: 4px;
        }
        
        .card-name {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--primary-dark);
        }
        
        .card-body {
            margin-bottom: 16px;
        }
        
        .card-info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .card-info-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .card-info-value {
            font-weight: 700;
            font-size: 0.9rem;
        }
        
        .card-footer {
            margin-top: 12px;
            display: flex;
            justify-content: flex-end;
        }
        
        .card-action-btn {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius);
            padding: 10px 20px;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            justify-content: center;
        }
        
        .card-action-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .student-nis { font-size: 0.85rem; color: var(--gray); font-family: 'Courier New', Courier, monospace; }
        .student-name { font-weight: 700; color: var(--dark); font-size: 1rem; }
        
        .status-overall { font-weight: 700; font-size: 0.85rem; display: flex; align-items: center; gap: 8px; }
        .status-dot { width: 8px; height: 8px; border-radius: 50%; }
        .paid-status { color: var(--success); }
        .paid-dot { background: var(--success); box-shadow: 0 0 10px var(--success); }
        .unpaid-status { color: var(--danger); }
        .unpaid-dot { background: var(--danger); box-shadow: 0 0 10px var(--danger); }

        .action-btn { background: var(--primary); color: white; border: none; border-radius: var(--radius); padding: 8px 16px; font-weight: 700; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; transition: var(--transition); }
        .action-btn:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 4px 10px rgba(26, 95, 180, 0.2); }
        .action-btn i { font-size: 0.9rem; }

        /* ALERTS */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); border-left: 4px solid var(--success); }
        .alert-error { background: rgba(229,62,62,.1); color: #c53030; border: 1px solid rgba(229,62,62,.2); border-left: 4px solid var(--danger); }

        /* MODAL */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,.5); z-index: 1000; display: none; align-items: center; justify-content: center; overflow-y: auto; padding: 20px; }
        .modal-overlay.active { display: flex; }
        .modal-card { background: #fff; width: 100%; max-width: 800px; border-radius: 16px; box-shadow: 0 15px 40px rgba(0,0,0,.3); animation: slideUp .3s ease; overflow: hidden; }
        @keyframes slideUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }
        .modal-head { display: flex; justify-content: space-between; align-items: center; padding: 24px; border-bottom: 1px solid var(--light-gray); background: var(--light); }
        .modal-head h3 { font-size: 1.2rem; font-weight: 800; color: var(--primary-dark); display: flex; align-items: center; gap: 10px; }
        .btn-close { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: var(--gray); padding: 5px; border-radius: 5px; transition: var(--transition); }
        .btn-close:hover { background: var(--light-gray); color: var(--danger); }
        .modal-body { padding: 24px; }

        .history-item { display: flex; justify-content: space-between; align-items: center; padding: 15px; border-bottom: 1px solid var(--light-gray); }
        .history-item:last-child { border-bottom: none; }
        .history-info h4 { font-size: 0.95rem; font-weight: 700; color: var(--dark); }
        .history-info p { font-size: 0.8rem; color: var(--gray); }
        .history-amount { text-align: right; }
        .history-amount .price { font-weight: 800; font-size: 1rem; color: var(--primary); }
        
        .badge { padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; }
        .badge-lunas { background: rgba(38,162,105,0.1); color: var(--success); }
        .badge-pending { background: rgba(221,107,32,0.1); color: var(--warning); }

        /* RESPONSIVE BREAKPOINTS */
        @media (max-width: 1200px) {
            .stats-grid { 
                grid-template-columns: repeat(4, 1fr); 
                gap: 15px;
            }
            .stat-value { font-size: 1.2rem; }
            .stat-label { font-size: 0.65rem; }
            .stat-card { padding: 15px; }
        }

        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-container { position: relative; }
            .sidebar { position: absolute; left: -280px; height: 100%; border-right: none; z-index: 1000; }
            .sidebar.active { left: 0; }
            .user-name, .user-role { display: none; }
            .stats-grid { 
                grid-template-columns: repeat(2, 1fr); 
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .page-header { flex-direction: column; align-items: flex-start; }
            .header-actions { width: 100%; justify-content: space-between; }
            .stats-grid { 
                grid-template-columns: 1fr; 
                gap: 12px;
            }
            
            /* Hide table on mobile */
            .table-responsive {
                display: none;
            }
            
            /* Show cards on mobile */
            .santri-cards-container {
                display: flex;
            }
        }

        @media (max-width: 480px) {
            .dashboard-content { padding: 15px; }
            .santri-card { padding: 16px; }
            .card-name { font-size: 1rem; }
        }
    </style>
</head>
<body>

    <header class="dashboard-header">
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <button class="mobile-menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <a href="<?= base_url('admin/dashboard') ?>" class="logo">
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PHBhdGggZD0iTTEyIDJMMiA3bDEwIDUgMTAtNS0xMC01eiI+PC9wYXRoPjxwYXRoIGQ9Ik0yIDE3bDEwIDUgMTAtNSI+PC9wYXRoPjxwYXRoIGQ9Ik0yIDEybDEwIDUgMTAtNSI+PC9wYXRoPjwvc3ZnPg==" alt="Logo">
                        <div class="logo-text">PTQ <span>Al-Hikmah</span></div>
                    </a>
                </div>
                
                <div class="user-section">
                    <div class="notification-bell"><i class="fas fa-bell"></i><span class="notification-badge">0</span></div>
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
                            <i class="fas fa-chevron-down" style="font-size: 0.8rem; opacity: 0.7;"></i>
                        </div>
                        <div class="dropdown-menu" id="userDropdown">
                            <a href="#" class="dropdown-item"><i class="fas fa-user-circle"></i><span>Profil</span></a>
                            <a href="#" class="dropdown-item"><i class="fas fa-cog"></i><span>Pengaturan</span></a>
                            <a href="<?= base_url('auth/logout') ?>" class="dropdown-item logout-btn"><i class="fas fa-sign-out-alt"></i><span>Keluar</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="welcome-text">Selamat Datang,</div>
                <div class="admin-name"><?= htmlspecialchars($nama_admin ?? session()->get('nama_lengkap') ?? 'Administrator') ?></div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/users') ?>"><i class="fas fa-users-cog"></i><span>Manajemen Akun</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/santri') ?>"><i class="fas fa-user-graduate"></i><span>Data Santri</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/ustadz') ?>"><i class="fas fa-chalkboard-teacher"></i><span>Data Ustadz</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/kelas') ?>"><i class="fas fa-school"></i><span>Data Kelas</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/hafalan') ?>"><i class="fas fa-quran"></i><span>Progres Hafalan</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('admin/pembayaran') ?>"><i class="fas fa-money-bill-wave"></i><span>Keuangan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pengumuman') ?>"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></div>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="page-header">
                <div class="page-title-group">
                    <div class="page-icon"><i class="fas fa-wallet"></i></div>
                    <h1>Keuangan Santri</h1>
                </div>
                <div class="header-actions">
                    <select class="filter-select" id="statusFilter">
                        <option value="all">Semua Status</option>
                        <option value="lunas">Lunas</option>
                        <option value="tunggakan">Ada Tunggakan</option>
                    </select>
                   
                    <button class="btn btn-primary" style="background:var(--secondary);" onclick="document.getElementById('addModal').classList.add('active')">
                        <i class="fas fa-plus"></i> Buat Tagihan Mingguan
                    </button>
                </div>
            </div>

            <!-- ALERTS -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- STATS GRID - 4 CARDS IN ONE ROW -->
            <div class="stats-grid">
                <div class="stat-card card-green">
                    <i class="fas fa-money-bill-trend-up bg-icon"></i>
                    <div class="stat-label"><i class="fas fa-circle-check"></i> Total Kas Masuk</div>
                    <div class="stat-value">Rp <?= number_format($stats['masuk'] ?? 0, 0, ',', '.') ?></div>
                    <div class="stat-footer">
                        <span>Pembayaran Lunas</span>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                <div class="stat-card card-red">
                    <i class="fas fa-hand-holding-dollar bg-icon"></i>
                    <div class="stat-label"><i class="fas fa-circle-exclamation"></i> Total Tunggakan</div>
                    <div class="stat-value">Rp <?= number_format($stats['tunggakan'] ?? 0, 0, ',', '.') ?></div>
                    <div class="stat-footer">
                        <span>Belum Dibayar</span>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                <div class="stat-card card-orange">
                    <i class="fas fa-hourglass-half bg-icon"></i>
                    <div class="stat-label"><i class="fas fa-clock-rotate-left"></i> Validasi Tertunda</div>
                    <div class="stat-value"><?= number_format($stats['pending'] ?? 0) ?></div>
                    <div class="stat-footer">
                        <span>Butuh Persetujuan</span>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                <div class="stat-card card-purple">
                    <i class="fas fa-file-invoice-dollar bg-icon"></i>
                    <div class="stat-label"><i class="fas fa-layer-group"></i> Total Ditagihkan</div>
                    <div class="stat-value">Rp <?= number_format($stats['total'] ?? 0, 0, ',', '.') ?></div>
                    <div class="stat-footer">
                        <span>Seluruh Tagihan SPP</span>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>

            <div class="premium-card">
                <div class="premium-card-header">
                    <i class="fas fa-list-check"></i>
                    <h2>Daftar Tagihan Per Santri</h2>
                </div>
                
                <!-- TABLE VIEW (Desktop) -->
                <div class="table-responsive">
                    <table class="custom-table" id="santriTable">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama Santri</th>
                                <th>Status Keseluruhan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="santriTableBody">
                            <?php if(!empty($santriOverview)): ?>
                                <?php foreach($santriOverview as $s): ?>
                                    <tr data-status="<?= ($s['total_bill'] ?? 0) == 0 ? 'none' : (($s['unpaid_bill'] ?? 0) == 0 ? 'lunas' : 'tunggakan') ?>">
                                        <td><span class="student-nis"><?= htmlspecialchars($s['nis'] ?? '-') ?></span></td>
                                        <td><div class="student-name"><?= htmlspecialchars($s['nama_santri']) ?></div></td>
                                        <td>
                                            <?php if(($s['total_bill'] ?? 0) == 0): ?>
                                                <div class="status-overall" style="color:var(--gray);">
                                                    <span class="status-dot" style="background:var(--gray);"></span> Belum Ada Tagihan
                                                </div>
                                            <?php elseif(($s['unpaid_bill'] ?? 0) == 0): ?>
                                                <div class="status-overall paid-status">
                                                    <span class="status-dot paid-dot"></span> Lunas (<?= $s['paid_bill'] ?? 0 ?> Tagihan)
                                                </div>
                                            <?php else: ?>
                                                <div class="status-overall unpaid-status">
                                                    <span class="status-dot unpaid-dot"></span> Belum Bayar (<?= $s['unpaid_bill'] ?? 0 ?> Minggu)
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/pembayaran/detail/' . $s['id']) ?>" class="action-btn">
                                                <i class="fas fa-list"></i> <span>Lihat Detail</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="text-align:center; padding:50px; color:var(--gray);">Data santri tidak ditemukan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- CARD VIEW (Mobile) -->
                <div class="santri-cards-container" id="santriCardsContainer">
                    <?php if(!empty($santriOverview)): ?>
                        <?php foreach($santriOverview as $s): ?>
                            <div class="santri-card" data-status="<?= ($s['total_bill'] ?? 0) == 0 ? 'none' : (($s['unpaid_bill'] ?? 0) == 0 ? 'lunas' : 'tunggakan') ?>">
                                <div class="card-header">
                                    <div class="card-header-left">
                                        <div class="card-nis">NIS: <?= htmlspecialchars($s['nis'] ?? '-') ?></div>
                                        <div class="card-name"><?= htmlspecialchars($s['nama_santri']) ?></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-info-row">
                                        <span class="card-info-label">Status Keseluruhan</span>
                                        <span class="card-info-value">
                                            <?php if(($s['total_bill'] ?? 0) == 0): ?>
                                                <span style="color:var(--gray);">Belum Ada Tagihan</span>
                                            <?php elseif(($s['unpaid_bill'] ?? 0) == 0): ?>
                                                <span style="color:var(--success);">✓ Lunas (<?= $s['paid_bill'] ?? 0 ?> Tagihan)</span>
                                            <?php else: ?>
                                                <span style="color:var(--danger);">⚠ Belum Bayar (<?= $s['unpaid_bill'] ?? 0 ?> Minggu)</span>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="<?= base_url('admin/pembayaran/detail/' . $s['id']) ?>" class="card-action-btn">
                                        <i class="fas fa-list"></i> Lihat Detail Tagihan
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="text-align:center; padding:50px; color:var(--gray);">Data santri tidak ditemukan.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH TAGIHAN -->
    <div class="modal-overlay" id="addModal">
        <form action="<?= base_url('admin/pembayaran/store') ?>" method="post" class="modal-card" style="max-width:500px;">
            <?= csrf_field() ?>
            <div class="modal-head">
                <h3><i class="fas fa-plus-circle"></i> Buat Tagihan Baru</h3>
                <button type="button" class="btn-close" onclick="document.getElementById('addModal').classList.remove('active')"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div style="margin-bottom: 15px;">
                    <label style="display:block; font-weight:700; margin-bottom:5px;">Pilih Santri</label>
                    <select name="id_santri" style="width:100%; padding:10px; border-radius:8px; border:1px solid var(--light-gray);" required>
                        <option value="">-- Pilih Santri --</option>
                        <?php foreach($santriList ?? [] as $sl): ?>
                            <option value="<?= $sl['id'] ?>"><?= htmlspecialchars($sl['nama_santri']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display:block; font-weight:700; margin-bottom:5px;">Jenis Tagihan</label>
                    <input type="text" name="jenis_pembayaran" style="width:100%; padding:10px; border-radius:8px; border:1px solid var(--light-gray);" required placeholder="Contoh: SPP Minggu ke-2 Agustus">
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display:block; font-weight:700; margin-bottom:5px;">Nominal (Rp)</label>
                    <input type="number" name="jumlah" style="width:100%; padding:10px; border-radius:8px; border:1px solid var(--light-gray);" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display:block; font-weight:700; margin-bottom:5px;">Status</label>
                    <select name="status" style="width:100%; padding:10px; border-radius:8px; border:1px solid var(--light-gray);" required>
                        <option value="Pending">Pending</option>
                        <option value="Lunas">Lunas</option>
                    </select>
                </div>
            </div>
            <div style="padding: 24px; border-top: 1px solid var(--light-gray); display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn" onclick="document.getElementById('addModal').classList.remove('active')" style="background:var(--light-gray);">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Tagihan</button>
            </div>
        </form>
    </div>

    <script>
        // Sidebar & UI Logic
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');

        if(menuToggle) {
            menuToggle.onclick = () => sidebar.classList.toggle('active');
        }
        
        if(userDropdownToggle) {
            userDropdownToggle.onclick = (e) => { 
                e.stopPropagation(); 
                if(userDropdown) userDropdown.classList.toggle('active');
            }
        }
        
        window.onclick = () => {
            if(userDropdown) userDropdown.classList.remove('active');
        }

        // Filter functionality for both table and cards
        const statusFilter = document.getElementById('statusFilter');
        const tableRows = document.querySelectorAll('#santriTableBody tr');
        const cardElements = document.querySelectorAll('.santri-card');
        
        if(statusFilter) {
            statusFilter.addEventListener('change', function() {
                const filterValue = this.value;
                
                // Filter table rows
                tableRows.forEach(row => {
                    if(filterValue === 'all') {
                        row.style.display = '';
                    } else {
                        const rowStatus = row.getAttribute('data-status');
                        if(rowStatus === filterValue) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
                
                // Filter card elements
                cardElements.forEach(card => {
                    if(filterValue === 'all') {
                        card.style.display = '';
                    } else {
                        const cardStatus = card.getAttribute('data-status');
                        if(cardStatus === filterValue) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        }
    </script>
</body>
</html>