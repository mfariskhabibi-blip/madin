<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?> - PTQ Pencongan</title>
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
        
        /* SIDEBAR & CONTENT LAYOUT */
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
        
        /* DETAIL PAGE STYLES */
        .top-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px; }
        .btn-back { display: inline-flex; align-items: center; gap: 8px; background: white; padding: 8px 16px; border-radius: 6px; color: var(--gray); font-weight: 600; font-size: 0.85rem; box-shadow: var(--shadow); transition: var(--transition); }
        .btn-back:hover { color: var(--primary); transform: translateX(-5px); background: var(--light); }
        
        .action-buttons { display: flex; gap: 10px; }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: .85rem; cursor: pointer; transition: .2s; border: none; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); }
        .btn-secondary { background: var(--light-gray); color: var(--dark); }
        .btn-secondary:hover { background: #cbd5e0; }
        .btn-danger { background: rgba(229,62,62,0.1); color: var(--danger); }
        .btn-danger:hover { background: rgba(229,62,62,0.2); }
        
        .profile-card { background: linear-gradient(135deg, var(--secondary) 0%, #1e8555 100%); border-radius: 12px; padding: 40px; color: white; margin-bottom: 30px; display: flex; align-items: center; gap: 30px; box-shadow: 0 10px 20px rgba(38, 162, 105, 0.2); flex-wrap: wrap; }
        .profile-img { width: 100px; height: 100px; border-radius: 50%; background: white; color: var(--secondary); display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 700; border: 4px solid rgba(255, 255, 255, 0.3); }
        .profile-info h1 { font-size: 2rem; margin-bottom: 8px; }
        .badge-info { background: rgba(255, 255, 255, 0.2); padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 6px; margin-right: 8px; margin-top: 5px; display: inline-block; }

        .detail-row { display: grid; grid-template-columns: 350px 1fr; gap: 30px; }
        .col-left, .col-right { display: flex; flex-direction: column; gap: 20px; }

        .premium-card { background: white; border-radius: 12px; box-shadow: var(--shadow); overflow: hidden; }
        .premium-card-header { padding: 18px 24px; border-bottom: 1px solid var(--light-gray); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
        .premium-card-header h3 { font-size: 1rem; font-weight: 700; color: var(--primary-dark); display: flex; align-items: center; gap: 10px; }
        .premium-card-header h3 i { color: var(--secondary); }

        .info-list { padding: 24px; }
        .info-item { margin-bottom: 20px; display: flex; flex-direction: column; }
        .info-item:last-child { margin-bottom: 0; }
        .info-label { font-size: 0.7rem; color: var(--gray); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; margin-bottom: 4px; display: flex; align-items: center; gap: 6px; }
        .info-label i { color: var(--secondary); font-size: 0.7rem; }
        .info-value { font-weight: 600; color: var(--dark); font-size: 0.95rem; word-break: break-word; }

        .list-card { display: flex; align-items: center; gap: 15px; padding: 15px; border-radius: 10px; background: #f8fafc; margin-bottom: 12px; border: 1px solid var(--light-gray); transition: var(--transition); }
        .list-card:hover { border-color: var(--secondary); background: #f0fdf4; transform: translateX(3px); }
        .list-icon { width: 45px; height: 45px; border-radius: 10px; background: rgba(38, 162, 105, 0.1); color: var(--secondary); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .list-info h4 { font-size: 1rem; color: var(--dark); font-weight: 700; margin-bottom: 4px; }
        .list-info p { font-size: 0.8rem; color: var(--gray); }

        .schedule-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; padding: 24px; }
        .schedule-card { border: 1px solid var(--light-gray); border-radius: 10px; padding: 15px; transition: var(--transition); display: flex; flex-direction: column; gap: 5px; background: white; }
        .schedule-card:hover { border-color: var(--secondary); transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.08); background: #f0fdf4; }
        .day-label { font-weight: 800; color: var(--secondary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .time-label { font-weight: 700; color: var(--dark); font-size: 0.9rem; }
        .class-label { font-size: 0.8rem; color: var(--gray); }
        
        .empty-state { text-align: center; padding: 40px 20px; color: var(--gray); }
        .empty-state i { font-size: 2.5rem; color: var(--light-gray); margin-bottom: 10px; display: block; }
        
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
            .detail-row { grid-template-columns: 1fr; }
            .profile-card { flex-direction: column; text-align: center; padding: 30px 20px; }
            .profile-info h1 { font-size: 1.5rem; }
        }
        
        @media (max-width: 768px) {
            .dashboard-content { padding: 20px 15px; }
            .top-nav { flex-direction: column; align-items: stretch; }
            .action-buttons { justify-content: flex-start; flex-wrap: wrap; }
            .premium-card-header { flex-direction: column; align-items: flex-start; }
            .schedule-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <header class="dashboard-header">
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <button class="mobile-menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a href="<?= base_url('admin/dashboard') ?>" class="logo" style="text-decoration:none;">
                        <img src="<?= base_url('assets/img/logo-ptq.jpg') ?>" alt="Logo">
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

    <div class="dashboard-container">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="welcome-text">Selamat Datang,</div>
                <div class="admin-name"><?= htmlspecialchars($nama_admin ?? session()->get('nama_lengkap') ?? 'Administrator') ?></div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/users') ?>"><i class="fas fa-users-cog"></i><span>Manajemen Akun</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/santri') ?>"><i class="fas fa-user-graduate"></i><span>Data Santri</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('admin/ustadz') ?>"><i class="fas fa-chalkboard-teacher"></i><span>Data Ustadz</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/kelas') ?>"><i class="fas fa-school"></i><span>Data Kelas</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/hafalan') ?>"><i class="fas fa-quran"></i><span>Progres Hafalan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pembayaran') ?>"><i class="fas fa-money-bill-wave"></i><span>Keuangan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pengumuman') ?>"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></div>
            </div>
        </div>

        <div class="dashboard-content">
            <!-- ALERTS -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="top-nav">
                <a href="<?= base_url('admin/ustadz') ?>" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pengajar
                </a>
                <div class="action-buttons">
                    <a href="<?= base_url('admin/ustadz/edit/' . $ustadz['id']) ?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Data
                    </a>
                    <a href="<?= base_url('admin/ustadz/delete/' . $ustadz['id']) ?>" class="btn btn-danger" onclick="return confirm('Hapus data ustadz ini? Data tidak dapat dikembalikan.')">
                        <i class="fas fa-trash"></i> Hapus
                    </a>
                </div>
            </div>

            <div class="profile-card">
                <div class="profile-img">
                    <?php
                        $initial = strtoupper(substr($ustadz['nama_lengkap'] ?? 'U', 0, 1));
                        echo $initial;
                    ?>
                </div>
                <div class="profile-info">
                    <h1><?= htmlspecialchars($ustadz['nama_lengkap'] ?? '-') ?></h1>
                    <div class="profile-meta">
                        <span class="badge-info"><i class="fas fa-id-card"></i> NIP: <?= htmlspecialchars($ustadz['nip'] ?? '-') ?></span>
                        <span class="badge-info"><i class="fas fa-circle" style="font-size: 0.5rem; color: #4ade80;"></i> <?= ucfirst($ustadz['status'] ?? 'aktif') ?></span>
                        <span class="badge-info"><i class="fas fa-user-tie"></i> Pengajar / Ustadz</span>
                    </div>
                </div>
            </div>

            <div class="detail-row">
                <div class="col-left">
                    <div class="premium-card">
                        <div class="premium-card-header">
                            <h3><i class="fas fa-user-shield"></i> Profil Pengajar</h3>
                        </div>
                        <div class="info-list">
                            <div class="info-item">
                                <p class="info-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin</p>
                                <p class="info-value"><?= ($ustadz['jenis_kelamin'] ?? 'L') == 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
                            </div>
                            <div class="info-item">
                                <p class="info-label"><i class="fas fa-graduation-cap"></i> Bidang Keahlian</p>
                                <p class="info-value"><?= htmlspecialchars($ustadz['bidang_keahlian'] ?? '-') ?></p>
                            </div>
                            <div class="info-item">
                                <p class="info-label"><i class="fas fa-university"></i> Pendidikan Terakhir</p>
                                <p class="info-value"><?= htmlspecialchars($ustadz['pendidikan'] ?? '-') ?></p>
                            </div>
                            <div class="info-item">
                                <p class="info-label"><i class="fas fa-phone-alt"></i> Nomor Telepon</p>
                                <p class="info-value"><?= htmlspecialchars($ustadz['no_telepon'] ?? '-') ?></p>
                            </div>
                            <div class="info-item">
                                <p class="info-label"><i class="fas fa-envelope"></i> Email</p>
                                <p class="info-value"><?= htmlspecialchars($ustadz['email'] ?? '-') ?></p>
                            </div>
                            <div class="info-item">
                                <p class="info-label"><i class="fas fa-map-marker-alt"></i> Alamat Lengkap</p>
                                <p class="info-value"><?= htmlspecialchars($ustadz['alamat'] ?? '-') ?></p>
                            </div>
                            <div class="info-item">
                                <p class="info-label"><i class="fas fa-calendar-alt"></i> Tanggal Bergabung</p>
                                <p class="info-value"><?= isset($ustadz['created_at']) ? date('d F Y', strtotime($ustadz['created_at'])) : '-' ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-right">
                    <div class="premium-card">
                        <div class="premium-card-header">
                            <h3><i class="fas fa-school"></i> Kelas yang Diampu</h3>
                            <a href="<?= base_url('admin/ustadz/assign-kelas/' . $ustadz['id']) ?>" class="btn btn-secondary" style="padding: 6px 12px;">
                                <i class="fas fa-plus"></i> Atur Kelas
                            </a>
                        </div>
                        <div style="padding: 24px;">
                            <?php if (!empty($kelas)): ?>
                                <?php foreach ($kelas as $k): ?>
                                    <div class="list-card">
                                        <div class="list-icon"><i class="fas fa-chalkboard"></i></div>
                                        <div class="list-info">
                                            <h4><?= htmlspecialchars($k['nama_kelas']) ?></h4>
                                            <p><?= htmlspecialchars($k['deskripsi'] ?? 'Tidak ada deskripsi') ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="empty-state">
                                    <i class="fas fa-school"></i>
                                    <p>Belum mengampu kelas manapun.</p>
                                    <a href="<?= base_url('admin/ustadz/assign-kelas/' . $ustadz['id']) ?>" class="btn btn-primary" style="margin-top: 10px;">
                                        <i class="fas fa-plus"></i> Tambah Kelas
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="premium-card">
                        <div class="premium-card-header">
                            <h3><i class="fas fa-calendar-alt"></i> Jadwal Mengajar</h3>
                            <a href="<?= base_url('admin/ustadz/jadwal/' . $ustadz['id']) ?>" class="btn btn-secondary" style="padding: 6px 12px;">
                                <i class="fas fa-edit"></i> Atur Jadwal
                            </a>
                        </div>
                        <div class="schedule-grid">
                            <?php if (!empty($jadwal)): ?>
                                <?php foreach ($jadwal as $j): ?>
                                    <div class="schedule-card">
                                        <p class="day-label"><i class="fas fa-calendar-day"></i> <?= htmlspecialchars($j['hari'] ?? '-') ?></p>
                                        <p class="time-label"><i class="fas fa-clock"></i> <?= date('H:i', strtotime($j['jam_mulai'] ?? '00:00')) ?> - <?= date('H:i', strtotime($j['jam_selesai'] ?? '00:00')) ?></p>
                                        <p class="class-label"><i class="fas fa-school"></i> <?= htmlspecialchars($j['nama_kelas'] ?? '-') ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="empty-state" style="grid-column: 1/-1;">
                                    <i class="fas fa-calendar-times"></i>
                                    <p>Belum ada jadwal mengajar.</p>
                                    <a href="<?= base_url('admin/ustadz/jadwal/' . $ustadz['id']) ?>" class="btn btn-primary" style="margin-top: 10px;">
                                        <i class="fas fa-plus"></i> Tambah Jadwal
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar logic
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            });
        }
        
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        }
        
        // User dropdown
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');
        
        if (userDropdownToggle && userDropdown) {
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
        
        // Logout confirmation
        const logoutBtn = document.getElementById('logoutBtn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin keluar?')) {
                    window.location.href = this.getAttribute('href');
                }
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