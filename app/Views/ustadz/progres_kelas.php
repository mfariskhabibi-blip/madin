<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        
        /* CLASS GRID */
        .class-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 24px;
        }
        
        .class-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: var(--transition);
            border: 1px solid var(--light-gray);
        }
        
        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }
        
        .class-card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .class-card-header h3 {
            font-size: 1.1rem;
            font-weight: 700;
        }
        
        .class-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        
        .class-card-body {
            padding: 20px;
        }
        
        .stat-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .stat-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: var(--gray);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .stat-label i {
            width: 20px;
            color: var(--primary);
        }
        
        .stat-value {
            font-weight: 700;
            color: var(--dark);
            font-size: 0.9rem;
        }
        
        /* STUDENT TABLE */
        .student-table-container {
            max-height: 320px;
            overflow-y: auto;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            margin-top: 15px;
        }
        .student-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
        .student-table th { text-align: left; padding: 10px; background: var(--light); color: var(--gray); font-weight: 700; text-transform: uppercase; font-size: 0.65rem; border-bottom: 2px solid var(--light-gray); position: sticky; top: 0; background: #f1f5f9; }
        .student-table td { padding: 12px 10px; border-bottom: 1px solid var(--light-gray); vertical-align: middle; }
        .student-table tr:last-child td { border-bottom: none; }
        
        .s-name-cell { font-weight: 700; color: var(--dark); }
        .s-surah-cell { color: var(--primary-dark); font-weight: 600; }
        .s-ayat-cell { color: var(--gray); font-size: 0.7rem; margin-top: 2px; }

        .badge-mini { padding: 3px 8px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; }
        .badge-lancar { background: #ecfdf5; color: var(--success); border: 1px solid rgba(56,161,105,0.2); }
        .badge-mengulang { background: #fef2f2; color: var(--danger); border: 1px solid rgba(229,62,62,0.2); }
        .badge-none { background: #f1f5f9; color: #94a3b8; }
        
        /* PROGRESS BAR */
        .progress-container {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid var(--light-gray);
        }
        
        .progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--gray);
        }
        
        .progress-bar {
            height: 8px;
            background: var(--light-gray);
            border-radius: 4px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: var(--secondary);
            border-radius: 4px;
            transition: width 1s ease;
        }
        
        .card-footer {
            padding: 15px 20px;
            background: var(--light);
            border-top: 1px solid var(--light-gray);
            text-align: center;
        }
        
        .btn-detail {
            color: var(--primary);
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }
        
        .btn-detail:hover {
            color: var(--primary-dark);
            transform: translateX(5px);
        }
        
        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }
        .empty-state i { font-size: 4rem; color: var(--light-gray); margin-bottom: 20px; }
        .empty-state h3 { font-size: 1.3rem; color: var(--dark); margin-bottom: 10px; font-weight: 600; }
        .empty-state p { font-size: 0.9rem; color: var(--gray); }
        
        /* ALERT */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); border-left: 4px solid var(--success); }
        
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
            .class-grid { grid-template-columns: 1fr; }
        }
        
        @media (max-width: 768px) {
            .page-title { font-size: 1.5rem; }
            .dashboard-content { padding: 20px 15px; }
            .class-card-header h3 { font-size: 1rem; }
            .class-card-body { padding: 15px; }
            .student-table th, .student-table td { padding: 8px; }
            .student-table-container { max-height: 250px; }
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
        
        <!-- SIDEBAR - SAMA PERSIS DENGAN HALAMAN ABSENSI -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="welcome-text">Selamat Mengajar,</div>
                <div class="admin-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Ustadz') ?></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('ustadz/dashboard') ?>"><i class="fas fa-th-large"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/santri') ?>"><i class="fas fa-graduation-cap"></i><span>Santri Binaan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/absensi') ?>"><i class="fas fa-user-check"></i><span>Absensi Santri</span></a></div>
                
                <div style="padding: 15px 15px 5px; color: rgba(255,255,255,0.4); font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Manajemen Hafalan</div>
                <div class="menu-item"><a href="<?= base_url('ustadz/hafalan') ?>"><i class="fas fa-book-open"></i><span>Setoran Hafalan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/murojaah') ?>"><i class="fas fa-sync-alt"></i><span>Muroja'ah</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('ustadz/progres-kelas') ?>"><i class="fas fa-chart-line"></i><span>Progres Kelas</span></a></div>
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
                                <h3><i class="fas fa-chalkboard-user" style="margin-right: 8px;"></i> <?= htmlspecialchars($p['kelas']['nama_kelas']) ?></h3>
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

                                <div style="margin-top: 25px;">
                                    <div style="font-size: 0.7rem; font-weight: 800; color: var(--gray); text-transform: uppercase; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; letter-spacing: 0.5px;">
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
                                                            <div style="font-size:0.6rem; color:var(--gray); margin-top: 2px;">NIS: <?= htmlspecialchars($s['nis'] ?? '-') ?></div>
                                                        </td>
                                                        <td style="width: 42%;">
                                                            <?php if(!empty($s['surah']) && $s['surah'] != '-'): ?>
                                                                <div class="s-surah-cell"><?= htmlspecialchars($s['surah']) ?></div>
                                                                <?php if(isset($s['ayat_awal']) && $s['ayat_awal']): ?>
                                                                    <div class="s-ayat-cell">Ayat <?= $s['ayat_awal'] ?>-<?= $s['ayat_akhir'] ?></div>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <span style="color:var(--gray); font-style:italic; font-size:0.75rem;">Belum ada setoran</span>
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
                    <div style="background: rgba(0,0,0,0.02); border-radius: 50%; width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="fas fa-chart-line" style="font-size: 3rem; color: var(--light-gray);"></i>
                    </div>
                    <h3>Belum Ada Data Kelas</h3>
                    <p>Anda belum terdaftar sebagai pengampu di kelas manapun.<br>Silakan hubungi administrator untuk menambahkan kelas binaan.</p>
                </div>
            <?php endif; ?>

            <!-- INFORMASI DASHBOARD -->
            <div class="section-card" style="margin-top: 28px;">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(14,165,233,.1);color:var(--info);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-circle-info"></i>
                        </div>
                        Informasi Progres Hafalan
                    </div>
                </div>
                <div style="padding: 20px 24px;">
                    <ul style="margin-left: 20px; font-size: 0.85rem; color: var(--gray); display: flex; flex-direction: column; gap: 8px;">
                        <li>• <strong>Persentase Tuntas</strong> - Persentase santri yang mencapai nilai minimal 8 pada setoran terakhir</li>
                        <li>• <strong>Rata-rata Nilai</strong> - Nilai rata-rata dari seluruh santri di kelas (skala 1-9)</li>
                        <li>• <strong>Surah Terakhir</strong> - Materi terbaru yang disetorkan oleh santri</li>
                        <li>• <strong>Status Nilai</strong> - <span style="color:var(--success); font-weight:700;">Nilai ≥ 8: Tuntas (Lancar)</span> | <span style="color:var(--danger); font-weight:700;">Nilai 1-7: Muroja'ah</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle logic - SAMA PERSIS DENGAN HALAMAN ABSENSI
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        if(menuToggle) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            });
        }
        
        if(sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        }
        
        // User dropdown logic
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
        
        // Auto hide alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 400);
            }, 5000);
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992 && sidebar && sidebarOverlay) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
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