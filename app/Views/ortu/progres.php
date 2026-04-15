<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Progres Santri - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* VARIABLES & RESET - Consistent with All Pages */
        :root {
            --primary: #1a5fb4; --primary-dark: #1c3d78; --secondary: #26a269;
            --accent: #e5a50a; --light: #f8f9fa; --gray: #718096;
            --light-gray: #e2e8f0; --dark: #2d3748; --danger: #e53e3e;
            --success: #38a169; --warning: #dd6b20; --info: #0ea5e9;
            --purple: #8b5cf6; --shadow: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
            --radius: 8px; --transition: all 0.3s ease;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f5f7fa; color: var(--dark); overflow-x: hidden; line-height: 1.6; }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 15px; }
        
        /* HEADER/NAVBAR */
        .dashboard-header { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); padding: 0; position: sticky; top: 0; z-index: 1000; }
        .header-content { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; gap: 12px; flex-wrap: wrap; }
        .logo-section { display: flex; align-items: center; gap: 15px; flex: 1; }
        .logo { display: flex; align-items: center; gap: 12px; padding: 8px 12px; border-radius: var(--radius); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); }
        .logo img { height: 36px; border-radius: 6px; }
        .logo-text { font-size: 1.4rem; font-weight: 700; color: white; letter-spacing: 0.5px; }
        .logo-text span { color: var(--accent); }
        
        .mobile-menu-toggle { display: none; background: rgba(255, 255, 255, 0.15); border: none; color: white; font-size: 1.4rem; width: 44px; height: 44px; border-radius: var(--radius); cursor: pointer; align-items: center; justify-content: center; transition: var(--transition); }
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
        
        /* SELECTOR CHILDREN */
        .child-selector { background: white; padding: 5px; border-radius: 10px; border: 1px solid var(--light-gray); display: flex; gap: 5px; box-shadow: var(--shadow); flex-wrap: wrap; }
        .child-opt { padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 0.8rem; font-weight: 700; color: var(--gray); transition: 0.2s; }
        .child-opt.active { background: var(--primary); color: white; }
        
        /* SUMMARY CARDS */
        .summary-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 24px; }
        .sum-card { background: white; padding: 20px; border-radius: var(--radius); box-shadow: var(--shadow); position: relative; overflow: hidden; border: 1px solid var(--light-gray); transition: var(--transition); }
        .sum-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
        .sum-card::after { content: ''; position: absolute; top:0; right:0; width: 4px; height: 100%; background: var(--primary); }
        .sum-card.success::after { background: var(--success); }
        .sum-card.warning::after { background: var(--accent); }
        
        .sum-label { font-size: 0.75rem; color: var(--gray); font-weight: 600; margin-bottom: 8px; display: block; text-transform: uppercase; letter-spacing: 0.5px; }
        .sum-val { font-size: 1.8rem; font-weight: 800; color: var(--dark); display: block; line-height: 1.2; }
        .sum-val small { font-size: 0.8rem; font-weight: 500; color: var(--gray); }
        .sum-trend { font-size: 0.7rem; margin-top: 8px; display: flex; align-items: center; gap: 5px; flex-wrap: wrap; }
        .up { color: var(--success); }
        
        /* CHARTS SECTION */
        .charts-row { display: grid; grid-template-columns: 2fr 1.2fr; gap: 20px; margin-bottom: 24px; }
        .chart-box { background: white; padding: 20px; border-radius: var(--radius); box-shadow: var(--shadow); border: 1px solid var(--light-gray); }
        .chart-title { font-size: 0.9rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
        .chart-title i { color: var(--primary); }
        
        /* TABLE */
        .table-box { background: white; padding: 20px; border-radius: var(--radius); box-shadow: var(--shadow); border: 1px solid var(--light-gray); }
        .modern-table { width: 100%; border-collapse: collapse; }
        .modern-table th { text-align: left; padding: 12px 12px; background: #f8fafc; font-size: 0.7rem; text-transform: uppercase; color: var(--gray); font-weight: 700; letter-spacing: 0.5px; border-bottom: 1px solid var(--light-gray); }
        .modern-table td { padding: 12px; border-bottom: 1px solid var(--light-gray); vertical-align: middle; }
        .modern-table tr:last-child td { border-bottom: none; }
        .modern-table tr:hover td { background: #fafcff; }
        
        .badge { padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; display: inline-flex; align-items: center; gap: 5px; }
        .bg-lancar { background: #dcfce7; color: var(--success); }
        .bg-murojaah { background: #fee2e2; color: var(--danger); }
        
        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 50px 20px; background: white; border-radius: var(--radius); box-shadow: var(--shadow); }
        .empty-state i { font-size: 3rem; color: var(--light-gray); margin-bottom: 15px; }
        .empty-state h3 { font-size: 1.1rem; color: var(--dark); margin-bottom: 5px; }
        .empty-state p { font-size: 0.85rem; color: var(--gray); }
        
        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; transition: opacity 0.3s; pointer-events: none; }
        .sidebar-overlay.active { display: block; opacity: 1; pointer-events: auto; }
        
        /* PAGE HEADER */
        .page-header { display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 15px; margin-bottom: 24px; }
        
        /* RESPONSIVE - SAME AS EXAMPLE */
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-content { padding: 16px; }
            .user-name, .user-role { display: block; }
            .user-info { padding: 6px 12px; }
            .summary-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
            .charts-row { grid-template-columns: 1fr; }
        }
        
        @media (max-width: 768px) {
            .header-content { padding: 10px 0; }
            .logo-text { font-size: 1.1rem; }
            .logo img { height: 30px; }
            .logo { padding: 6px 10px; gap: 8px; }
            .page-title { font-size: 1.3rem; }
            .page-subtitle { font-size: 0.8rem; }
            .dashboard-content { padding: 12px; }
            .summary-grid { grid-template-columns: 1fr; gap: 12px; }
            .sum-card { padding: 16px; }
            .sum-val { font-size: 1.5rem; }
            .chart-box, .table-box { padding: 16px; }
            .modern-table th, .modern-table td { padding: 10px 8px; }
            .child-selector { width: 100%; justify-content: center; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .user-details { display: none; }
            .user-info { padding: 6px 8px; gap: 6px; }
            .user-avatar { width: 36px; height: 36px; font-size: 0.9rem; }
            .notification-bell { width: 38px; height: 38px; }
        }
        
        @media (max-width: 576px) {
            .dashboard-content { padding: 10px; }
            .page-title { font-size: 1.2rem; }
            .sum-label { font-size: 0.7rem; }
            .sum-val { font-size: 1.3rem; }
            .chart-title { font-size: 0.85rem; }
            .modern-table th, .modern-table td { font-size: 0.75rem; padding: 8px 6px; }
            .badge { padding: 3px 8px; font-size: 0.65rem; }
            .child-opt { padding: 6px 12px; font-size: 0.75rem; }
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
                    <a href="<?= base_url('ortu/dashboard') ?>" class="logo" style="text-decoration:none;">
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
                                    $nama = session()->get('nama_lengkap') ?? 'WM';
                                    $words = explode(' ', $nama);
                                    $initials = '';
                                    foreach($words as $word) {
                                        $initials .= strtoupper(substr($word, 0, 1));
                                        if(strlen($initials) >= 2) break;
                                    }
                                    echo $initials ?: 'WM';
                                ?>
                            </div>
                            <div class="user-details">
                                <div class="user-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Wali Murid') ?></div>
                                <div class="user-role">Wali Santri</div>
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
                <div class="welcome-text">Selamat Datang,</div>
                <div class="admin-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Wali Murid') ?></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('ortu/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('ortu/progres') ?>"><i class="fas fa-chart-line"></i><span>Progres Santri</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/hafalan') ?>"><i class="fas fa-quran"></i><span>Hafalan Anak</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/kehadiran') ?>"><i class="fas fa-calendar-check"></i><span>Kehadiran</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/pembayaran') ?>"><i class="fas fa-wallet"></i><span>Pembayaran</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/jadwal') ?>"><i class="fas fa-calendar-alt"></i><span>Jadwal</span></a></div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <div class="page-header">
                <div>
                    <h1 class="page-title"><i class="fas fa-chart-line"></i> Progres Santri</h1>
                    <p class="page-subtitle">Statistik perkembangan <strong><?= $current_santri['nama_santri'] ?? 'Santri' ?></strong></p>
                </div>
                
                <?php if (isset($anak) && count($anak) > 1): ?>
                <div class="child-selector">
                    <?php foreach ($anak as $a): ?>
                    <a href="<?= base_url('ortu/progres/' . $a['id']) ?>" class="child-opt <?= ($current_santri['id'] == $a['id']) ? 'active' : '' ?>">
                        <?= explode(' ', $a['nama_santri'])[0] ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- SUMMARY CARDS -->
            <div class="summary-grid">
                <div class="sum-card success">
                    <span class="sum-label"><i class="fas fa-calendar-check"></i> Kehadiran Keseluruhan</span>
                    <span class="sum-val"><?= isset($stats_absensi['Total']) && $stats_absensi['Total'] > 0 ? round(($stats_absensi['Hadir'] / $stats_absensi['Total']) * 100) : 0 ?>%</span>
                    <div class="sum-trend up"><i class="fas fa-chart-line"></i> <?= $stats_absensi['Hadir'] ?? 0 ?> / <?= $stats_absensi['Total'] ?? 0 ?> Pertemuan</div>
                </div>
                
                <div class="sum-card">
                    <span class="sum-label"><i class="fas fa-star"></i> Rata-rata Nilai Hafalan</span>
                    <span class="sum-val"><?= $avg_nilai ?? 0 ?> <small>/ 9</small></span>
                    <div class="sum-trend" style="color:var(--primary);"><i class="fas fa-chart-simple"></i> Skala Nasional / Sekolah</div>
                </div>

                <div class="sum-card warning">
                    <span class="sum-label"><i class="fas fa-book"></i> Total Setoran Hafalan</span>
                    <span class="sum-val"><?= $total_hafalan ?? 0 ?></span>
                    <div class="sum-trend" style="color:var(--accent);"><i class="fas fa-quran"></i> Surah Aktif: <?= !empty($riwayat_terakhir) ? $riwayat_terakhir[0]['surah'] : '-' ?></div>
                </div>
            </div>

            <!-- CHARTS -->
            <div class="charts-row">
                <div class="chart-box">
                    <div class="chart-title"><i class="fas fa-chart-line"></i> Tren Nilai 10 Setoran Terakhir</div>
                    <canvas id="hafalanTrend" height="150" style="max-height: 250px;"></canvas>
                </div>
                <div class="chart-box">
                    <div class="chart-title"><i class="fas fa-chart-pie"></i> Komposisi Kehadiran</div>
                    <canvas id="attendancePie" style="max-height: 220px;"></canvas>
                </div>
            </div>

            <!-- RECENT ACTIVITY -->
            <div class="table-box">
                <div class="chart-title"><i class="fas fa-history"></i> Riwayat 5 Setoran Terakhir</div>
                <div style="overflow-x: auto;">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Materi Surah</th>
                                <th>Ayat</th>
                                <th>Skor</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($riwayat_terakhir)): ?>
                                <?php foreach ($riwayat_terakhir as $r): ?>
                                <tr>
                                    <td><?= date('d M Y', strtotime($r['tanggal'])) ?></td>
                                    <td style="font-weight: 700; color: var(--primary-dark);"><?= htmlspecialchars($r['surah']) ?></td>
                                    <td style="font-size: 0.75rem; color: var(--gray);"><?= $r['ayat_awal'] ?> - <?= $r['ayat_akhir'] ?></td>
                                    <td><strong style="font-size: 1rem;"><?= $r['nilai'] ?></strong></td>
                                    <td>
                                        <span class="badge <?= ($r['nilai'] >= 8) ? 'bg-lancar' : 'bg-murojaah' ?>">
                                            <i class="fas <?= ($r['nilai'] >= 8) ? 'fa-check-circle' : 'fa-book-open' ?>"></i>
                                            <?= ($r['nilai'] >= 8) ? 'Lancar' : 'Muroja\'ah' ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px; color: var(--gray);">
                                        <i class="fas fa-book-open" style="font-size: 2rem; margin-bottom: 10px; display: block; color: var(--light-gray);"></i>
                                        Belum ada riwayat setoran hafalan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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

        // Attendance Pie Chart
        const ctxPie = document.getElementById('attendancePie');
        if(ctxPie) {
            new Chart(ctxPie.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Hadir', 'Izin', 'Sakit', 'Alpa'],
                    datasets: [{
                        data: [<?= $stats_absensi['Hadir'] ?? 0 ?>, <?= $stats_absensi['Izin'] ?? 0 ?>, <?= $stats_absensi['Sakit'] ?? 0 ?>, <?= $stats_absensi['Alpa'] ?? 0 ?>],
                        backgroundColor: ['#38a169', '#0ea5e9', '#e5a50a', '#e53e3e'],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true, padding: 15, font: { weight: 'bold', size: 11 } } }
                    },
                    cutout: '65%'
                }
            });
        }

        // Hafalan Trend Line Chart
        const ctxLine = document.getElementById('hafalanTrend');
        if(ctxLine && <?= !empty($trend_hafalan) ? 'true' : 'false' ?>) {
            new Chart(ctxLine.getContext('2d'), {
                type: 'line',
                data: {
                    labels: [<?php if(!empty($trend_hafalan)) foreach($trend_hafalan as $t) echo "'" . date('d/m', strtotime($t['tanggal'])) . "',"; ?>],
                    datasets: [{
                        label: 'Skor Hafalan',
                        data: [<?php if(!empty($trend_hafalan)) foreach($trend_hafalan as $t) echo $t['nilai'] . ","; ?>],
                        borderColor: '#1a5fb4',
                        backgroundColor: 'rgba(26, 95, 180, 0.08)',
                        borderWidth: 3,
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#1a5fb4',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#1a5fb4'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        y: { beginAtZero: true, max: 10, ticks: { stepSize: 1, precision: 0 }, grid: { color: '#e2e8f0' } },
                        x: { grid: { display: false } }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: { callbacks: { label: (ctx) => `Nilai: ${ctx.raw} / 9` } }
                    }
                }
            });
        }
    </script>
</body>
</html>