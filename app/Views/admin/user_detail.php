<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?> - PTQ Pencongan</title>
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
        .page-title { font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        
        /* PROFILE PAGE SPECIFIC STYLES */
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); flex-wrap: wrap; gap: 10px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); display: flex; align-items: center; gap: 10px; }
        
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: .85rem; cursor: pointer; transition: .2s; border: none; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: var(--light-gray); color: var(--dark); }
        .btn-secondary:hover { background: #cbd5e0; }
        .btn-danger { background: rgba(229,62,62,0.1); color: var(--danger); }
        .btn-danger:hover { background: rgba(229,62,62,0.2); }
        
        .back-link {
            display: inline-flex; align-items: center; gap: 8px; background: white; padding: 8px 16px;
            border-radius: 6px; color: var(--gray); font-weight: 600; margin-bottom: 20px;
            transition: var(--transition); box-shadow: var(--shadow);
        }
        .back-link:hover { color: var(--primary); transform: translateX(-5px); background: var(--light); }
        
        /* PROFILE HEADER */
        .profile-header {
            padding: 30px; display: flex; align-items: center; gap: 30px; flex-wrap: wrap;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }
        .profile-header.ustadz { background: linear-gradient(135deg, var(--secondary) 0%, #1e8555 100%); }
        .profile-header.admin { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); }
        .profile-header.ortu { background: linear-gradient(135deg, var(--accent) 0%, #c68b08 100%); }
        
        .profile-avatar {
            width: 100px; height: 100px; border-radius: 50%; background: white; color: var(--primary-dark);
            display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 700;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2); border: 4px solid rgba(255,255,255,0.3);
        }
        
        .profile-name-role h1 { font-size: 1.5rem; margin-bottom: 5px; font-weight: 700; color: white; }
        .profile-name-role p { opacity: 0.9; display: flex; align-items: center; gap: 8px; font-weight: 500; color: white; }
        
        /* PROFILE CONTENT */
        .profile-content { padding: 24px; }
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0; }
        
        .info-item { display: flex; align-items: center; padding: 14px 0; border-bottom: 1px solid var(--light-gray); gap: 10px; }
        .info-item:nth-child(odd) { border-right: 1px solid var(--light-gray); padding-right: 20px; }
        .info-item:nth-child(even) { padding-left: 20px; }
        .info-item:last-child, .info-item:nth-last-child(2) { border-bottom: none; }
        
        .info-label { width: 140px; display: flex; align-items: center; gap: 12px; color: var(--gray); font-weight: 600; font-size: 0.85rem; flex-shrink: 0; }
        .info-label i { width: 20px; text-align: center; color: var(--primary); }
        .info-value { flex: 1; font-weight: 500; color: var(--dark); font-size: 0.9rem; word-break: break-word; }
        
        .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; }
        .badge-success { background: rgba(56, 161, 105, 0.1); color: var(--success); }
        .badge-danger { background: rgba(229, 62, 62, 0.1); color: var(--danger); }
        
        .action-section { margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--light-gray); display: flex; gap: 12px; flex-wrap: wrap; }
        
        /* LIST CARD FOR EXTRA DATA */
        .list-card {
            display: flex; align-items: center; gap: 15px; padding: 15px; border-radius: 8px;
            background: #f8fafc; margin-bottom: 12px; border: 1px solid var(--light-gray);
            transition: var(--transition);
        }
        .list-card:hover { background: var(--light); border-color: var(--primary); }
        .list-card:last-child { margin-bottom: 0; }
        .list-icon {
            width: 45px; height: 45px; border-radius: 10px; background: rgba(26, 95, 180, 0.1);
            color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;
        }
        .list-info h4 { font-size: 0.95rem; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
        .list-info p { font-size: 0.8rem; color: var(--gray); }
        
        .empty-state { text-align: center; padding: 40px 20px; color: var(--gray); }
        .empty-state i { font-size: 2.5rem; color: var(--light-gray); margin-bottom: 10px; }
        
        /* Alert */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); border-left: 4px solid var(--success); }
        .alert-danger  { background: rgba(229,62,62,.1);  color: #c53030; border: 1px solid rgba(229,62,62,.2); border-left: 4px solid var(--danger); }
        
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
            .page-title { font-size: 1.5rem; }
            .dashboard-content { padding: 20px 15px; }
            .profile-header { flex-direction: column; text-align: center; padding: 30px 20px; gap: 20px; }
            .info-grid { grid-template-columns: 1fr; }
            .info-item:nth-child(odd) { border-right: none; padding-right: 0; }
            .info-item:nth-child(even) { padding-left: 0; }
            .info-item { flex-direction: column; align-items: flex-start; gap: 6px; }
            .info-label { width: 100%; }
            .action-section { flex-direction: column; }
            .action-section .btn { justify-content: center; }
            .card-header { flex-direction: column; align-items: flex-start; }
        }
        
        @media (max-width: 576px) {
            .back-link { width: 100%; justify-content: center; }
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
                <div class="menu-item"><a href="<?= base_url('admin/users') ?>"><i class="fas fa-users-cog"></i><span>Manajemen Akun</span></a></div>
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
            
            <!-- BACK LINK -->
            <a href="<?= base_url('admin/users') ?>" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pengguna
            </a>

            <!-- ALERTS -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- MAIN PROFILE CARD -->
            <div class="section-card">
                <div class="profile-header <?= $user['role'] ?? 'admin' ?>">
                    <div class="profile-avatar">
                        <?php
                            $i = ''; $p = explode(' ', $user['nama_lengkap'] ?? $user['username']);
                            foreach($p as $w) { $i .= strtoupper(substr($w,0,1)); if(strlen($i)>=2) break; }
                            echo $i ?: 'U';
                        ?>
                    </div>
                    <div class="profile-name-role">
                        <h1><?= htmlspecialchars($user['nama_lengkap'] ?? '-') ?></h1>
                        <p>
                            <i class="fas fa-user-<?= $user['role'] === 'ustadz' ? 'tie' : ($user['role'] === 'ortu' ? 'friends' : 'cog') ?>"></i>
                            <?php 
                                if($user['role'] == 'admin') echo 'Administrator';
                                elseif($user['role'] == 'ustadz') echo 'Ustadz / Pengajar';
                                elseif($user['role'] == 'ortu') echo 'Orang Tua / Wali Murid';
                                else echo ucfirst($user['role']);
                            ?>
                        </p>
                    </div>
                </div>

                <div class="profile-content">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-id-card"></i> Username</div>
                            <div class="info-value"><?= htmlspecialchars($user['username']) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-user"></i> Nama Lengkap</div>
                            <div class="info-value"><?= htmlspecialchars($user['nama_lengkap'] ?? '-') ?></div>
                        </div>
                        
                        <?php if ($user['role'] === 'ustadz' && isset($profile)): ?>
                            <div class="info-item">
                                <div class="info-label"><i class="fas fa-phone-alt"></i> Nomor Telepon</div>
                                <div class="info-value"><?= htmlspecialchars($profile['no_telepon'] ?? '-') ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label"><i class="fas fa-envelope"></i> Email</div>
                                <div class="info-value"><?= htmlspecialchars($user['email'] ?? '-') ?></div>
                            </div>
                        <?php elseif ($user['role'] === 'ortu' && isset($profile)): ?>
                            <div class="info-item">
                                <div class="info-label"><i class="fas fa-phone-alt"></i> No. HP (Ayah)</div>
                                <div class="info-value"><?= htmlspecialchars($profile['no_telepon_ayah'] ?? '-') ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label"><i class="fas fa-phone-alt"></i> No. HP (Ibu)</div>
                                <div class="info-value"><?= htmlspecialchars($profile['no_telepon_ibu'] ?? '-') ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label"><i class="fas fa-home"></i> Alamat</div>
                                <div class="info-value"><?= htmlspecialchars($profile['alamat'] ?? '-') ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label"><i class="fas fa-envelope"></i> Email</div>
                                <div class="info-value"><?= htmlspecialchars($user['email'] ?? '-') ?></div>
                            </div>
                        <?php else: ?>
                            <div class="info-item">
                                <div class="info-label"><i class="fas fa-envelope"></i> Email</div>
                                <div class="info-value"><?= htmlspecialchars($user['email'] ?? '-') ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label"><i class="fas fa-calendar-alt"></i> Tanggal Terdaftar</div>
                                <div class="info-value"><?= isset($user['created_at']) ? date('d F Y', strtotime($user['created_at'])) : '-' ?></div>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (($user['role'] === 'ustadz' || $user['role'] === 'admin') && isset($user['created_at'])): ?>
                            <div class="info-item">
                                <div class="info-label"><i class="fas fa-calendar-alt"></i> Tanggal Terdaftar</div>
                                <div class="info-value"><?= date('d F Y', strtotime($user['created_at'])) ?></div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-shield-alt"></i> Status Akun</div>
                            <div class="info-value">
                                <?php if(($user['status'] ?? 'aktif') == 'aktif'): ?>
                                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> Aktif</span>
                                <?php else: ?>
                                    <span class="badge badge-danger"><i class="fas fa-lock"></i> Nonaktif</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="action-section">
                        <a href="<?= base_url('admin/users') ?>?edit=<?= $user['id'] ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Profil
                        </a>
                        <?php if(($user['id'] ?? 0) != session()->get('id')): ?>
                            <?php if(($user['status'] ?? 'aktif') == 'aktif'): ?>
                                <a href="<?= base_url('admin/users/toggle/' . $user['id']) ?>" class="btn btn-secondary" onclick="return confirm('Nonaktifkan akun ini? Pengguna tidak akan bisa login.')">
                                    <i class="fas fa-lock"></i> Nonaktifkan Akun
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/users/toggle/' . $user['id']) ?>" class="btn btn-secondary" onclick="return confirm('Aktifkan akun ini? Pengguna akan bisa login kembali.')">
                                    <i class="fas fa-lock-open"></i> Aktifkan Akun
                                </a>
                            <?php endif; ?>
                            <a href="<?= base_url('admin/users/delete/' . $user['id']) ?>" class="btn btn-danger" onclick="return confirm('Hapus akun ini secara permanen? Data tidak dapat dikembalikan.')">
                                <i class="fas fa-trash"></i> Hapus Akun
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- CONTEXTUAL SECTIONS FOR USTADZ -->
            <?php if ($user['role'] === 'ustadz'): ?>
                <div class="section-card">
                    <div class="card-header">
                        <div class="card-title">
                            <div style="width:36px;height:36px;border-radius:8px;background:rgba(38,162,105,.1);color:var(--secondary);display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-chalkboard"></i>
                            </div>
                            Kelas yang Diasuh
                        </div>
                    </div>
                    <div style="padding: 20px 24px;">
                        <?php if (!empty($extraData['kelas'] ?? [])): ?>
                            <?php foreach ($extraData['kelas'] as $k): ?>
                                <div class="list-card">
                                    <div class="list-icon"><i class="fas fa-school"></i></div>
                                    <div class="list-info">
                                        <h4><?= htmlspecialchars($k['nama_kelas']) ?></h4>
                                        <p><?= htmlspecialchars($k['deskripsi'] ?? 'Tidak ada deskripsi') ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <p>Belum mengasuh kelas manapun.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- CONTEXTUAL SECTIONS FOR ORTU -->
            <?php if ($user['role'] === 'ortu'): ?>
                <div class="section-card">
                    <div class="card-header">
                        <div class="card-title">
                            <div style="width:36px;height:36px;border-radius:8px;background:rgba(229,165,10,.1);color:var(--accent);display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            Daftar Anak (Santri)
                        </div>
                    </div>
                    <div style="padding: 20px 24px;">
                        <?php if (!empty($extraData['santri'] ?? [])): ?>
                            <?php foreach ($extraData['santri'] as $s): ?>
                                <div class="list-card">
                                    <div class="list-icon"><i class="fas fa-child"></i></div>
                                    <div class="list-info">
                                        <h4><?= htmlspecialchars($s['nama_santri']) ?></h4>
                                        <p>NIS: <?= htmlspecialchars($s['nis'] ?? '-') ?> | Status: <?= ucfirst($s['status'] ?? 'Aktif') ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-user-slash"></i>
                                <p>Belum ada data anak yang tertaut.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- INFORMASI TAMBAHAN -->
            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(14,165,233,.1);color:var(--info);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        Informasi Akun
                    </div>
                </div>
                <div style="padding: 20px 24px;">
                    <ul style="margin-left: 20px; font-size: 0.85rem; color: var(--gray);">
                        <li>• Akun ini digunakan untuk mengakses sistem PTQ Pencongan sesuai dengan peran yang ditentukan.</li>
                        <?php if($user['role'] === 'admin'): ?>
                            <li>• Administrator memiliki akses penuh ke seluruh fitur manajemen sistem.</li>
                        <?php elseif($user['role'] === 'ustadz'): ?>
                            <li>• Ustadz dapat mengelola absensi, nilai hafalan, dan melihat jadwal mengajar.</li>
                        <?php elseif($user['role'] === 'ortu'): ?>
                            <li>• Orang Tua dapat memantau progres hafalan, kehadiran, dan tagihan putra-putrinya.</li>
                        <?php endif; ?>
                    </ul>
                    <p style="margin-top: 15px; padding-top: 12px; border-top: 1px solid var(--light-gray); font-size: 0.8rem; color: var(--gray);">
                        <i class="fas fa-shield-alt"></i> Anda tidak dapat menghapus atau menonaktifkan akun Anda sendiri.
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
    </script>
</body>
</html>