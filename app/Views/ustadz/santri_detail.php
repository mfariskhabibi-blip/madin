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
        
        .mobile-menu-toggle { display: none; background: rgba(255, 255, 255, 0.15); border: none; color: white; font-size: 1.4rem; width: 44px; height: 44px; border-radius: var(--radius); cursor: pointer; align-items: center; justify-content: center; transition: var(--transition); }
        
        .user-section { display: flex; align-items: center; gap: 15px; }
        .user-info { display: flex; align-items: center; gap: 12px; padding: 8px 16px; border-radius: var(--radius); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); transition: var(--transition); cursor: pointer; }
        .user-avatar { width: 42px; height: 42px; border-radius: 50%; overflow: hidden; background: linear-gradient(135deg, var(--purple) 0%, var(--info) 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.1rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); }
        .user-details { color: white; }
        .user-name { font-weight: 600; font-size: 0.95rem; }
        .user-role { font-size: 0.8rem; opacity: 0.9; }
        
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

        /* DETAIL PAGE STYLES */
        .top-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn-back { display: inline-flex; align-items: center; gap: 8px; background: white; padding: 8px 16px; border-radius: 6px; color: var(--gray); font-weight: 600; font-size: 0.85rem; box-shadow: var(--shadow); transition: var(--transition); }
        .btn-back:hover { color: var(--primary); transform: translateX(-5px); }
        
        .profile-card { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); border-radius: 12px; padding: 40px; color: white; margin-bottom: 30px; display: flex; align-items: center; gap: 30px; box-shadow: 0 10px 20px rgba(26, 95, 180, 0.2); }
        .profile-img { width: 100px; height: 100px; border-radius: 50%; background: white; color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 700; border: 4px solid rgba(255, 255, 255, 0.3); }
        .profile-info h1 { font-size: 2rem; margin-bottom: 8px; }
        .profile-meta { display: flex; gap: 15px; align-items: center; flex-wrap: wrap; }
        .badge-info { background: rgba(255, 255, 255, 0.2); padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 6px; }

        /* Stats overview */
        .stats-overview { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 15px; box-shadow: var(--shadow); transition: var(--transition); }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
        .stat-content { display: flex; flex-direction: column; }
        .stat-label { font-size: 0.75rem; color: var(--gray); font-weight: 600; text-transform: uppercase; }
        .stat-val { font-size: 1.25rem; font-weight: 700; color: var(--dark); }

        .detail-row { display: grid; grid-template-columns: 350px 1fr; gap: 30px; }
        .col-left, .col-right { display: flex; flex-direction: column; gap: 20px; }

        .premium-card { background: white; border-radius: 12px; box-shadow: var(--shadow); overflow: hidden; height: fit-content; }
        .premium-card-header { padding: 18px 24px; border-bottom: 1px solid var(--light-gray); display: flex; justify-content: space-between; align-items: center; }
        .premium-card-header h3 { font-size: 1rem; font-weight: 700; color: var(--primary-dark); display: flex; align-items: center; gap: 10px; }
        .premium-card-header h3 i { color: var(--primary); }

        .biodata-list { padding: 24px; }
        .biodata-item { margin-bottom: 20px; }
        .biodata-item:last-child { margin-bottom: 0; }
        .biodata-label { font-size: 0.75rem; color: var(--gray); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; margin-bottom: 4px; }
        .biodata-value { font-weight: 600; color: var(--dark); font-size: 0.95rem; }

        .history-list { padding: 24px; display: flex; flex-direction: column; gap: 15px; }
        .history-item { border: 1px solid var(--light-gray); border-radius: 10px; padding: 20px; display: flex; gap: 15px; transition: var(--transition); position: relative; }
        .history-item:hover { border-color: var(--primary); background: #f8fafc; }
        
        .history-icon { width: 40px; height: 40px; border-radius: 8px; background: rgba(26, 95, 180, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
        .history-content { flex: 1; }
        .history-date { font-size: 0.8rem; color: var(--gray); margin-bottom: 5px; }
        .history-title { font-size: 1.1rem; font-weight: 700; color: var(--dark); margin-bottom: 8px; }
        .history-meta { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 8px; }
        .status-badge { padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; }
        .status-badge.lancar { background: rgba(56, 161, 105, 0.1); color: var(--success); }
        .status-badge.sedang { background: rgba(221, 107, 32, 0.1); color: var(--warning); }
        .status-badge.mengulang { background: rgba(229, 62, 62, 0.1); color: var(--danger); }
        
        .history-note { font-size: 0.85rem; color: var(--gray); font-style: italic; border-left: 3px solid var(--light-gray); padding-left: 10px; margin-top: 10px; }

        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; }

        @media (max-width: 992px) {
            .detail-row { grid-template-columns: 1fr; }
            .profile-card { padding: 25px; flex-direction: column; text-align: center; gap: 20px; }
            .stats-overview { grid-template-columns: 1fr 1fr; }
            .mobile-menu-toggle { display: flex; }
            .sidebar { position: absolute; left: -280px; height: 100%; }
            .sidebar.active { left: 0; box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2); }
            .sidebar-overlay.active { display: block; opacity: 1; }
        }
        
        @media (max-width: 576px) {
            .stats-overview { grid-template-columns: 1fr; }
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
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PHBhdGggZD0iTTEyIDJMMiA3bDEwIDUgMTAtNS0xMC01eiI+PC9wYXRoPjxwYXRoIGQ9Ik0yIDE3bDEwIDUgMTAtNSI+PC9wYXRoPjxwYXRoIGQ9Ik0yIDEybDEwIDUgMTAtNSI+PC9wYXRoPjwvc3ZnPg==" alt="Logo PTQ">
                        <div class="logo-text">PTQ <span>Al-Hikmah</span></div>
                    </a>
                </div>
                
                <div class="user-section">
                    <div class="user-info">
                        <div class="user-avatar"><?= substr($nama_ustadz, 0, 2) ?></div>
                        <div class="user-details">
                            <div class="user-name"><?= htmlspecialchars($nama_ustadz) ?></div>
                            <div class="user-role">Ustadz/Pengajar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- SIDEBAR -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="welcome-text">Selamat Mengajar,</div>
                <div class="admin-name"><?= htmlspecialchars($nama_ustadz) ?></div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('ustadz/dashboard') ?>"><i class="fas fa-th-large"></i><span>Dashboard</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('ustadz/santri') ?>"><i class="fas fa-graduation-cap"></i><span>Santri Binaan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/absensi') ?>"><i class="fas fa-user-check"></i><span>Absensi Santri</span></a></div>
                
                <div style="padding: 15px 15px 5px; color: rgba(255,255,255,0.4); font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Manajemen Hafalan</div>
                <div class="menu-item"><a href="<?= base_url('ustadz/hafalan') ?>"><i class="fas fa-book-open"></i><span>Setoran Hafalan</span></a></div>
                <div class="menu-item"><a href="#"><i class="fas fa-sync-alt"></i><span>Muroja'ah</span></a></div>
                <div class="menu-item"><a href="#"><i class="fas fa-chart-line"></i><span>Progres Kelas</span></a></div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <div class="top-nav">
                <a href="<?= base_url('ustadz/santri') ?>" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>

            <div class="profile-card">
                <div class="profile-img">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="profile-info">
                    <h1><?= htmlspecialchars($santri['nama_santri']) ?></h1>
                    <div class="profile-meta">
                        <span class="badge-info">NIS: <?= htmlspecialchars($santri['nis']) ?></span>
                        <span class="badge-info"><i class="fas fa-circle" style="font-size: 0.5rem; color: #4ade80;"></i> <?= ucfirst($santri['status']) ?></span>
                        <span class="badge-info"><i class="fas fa-school"></i> <?= htmlspecialchars($santri['nama_kelas'] ?? 'Belum Ada Kelas') ?></span>
                        <span class="badge-info"><i class="fas fa-star"></i> Avg: <?= $avg_nilai ?></span>
                    </div>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="stats-overview">
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(56, 161, 105, 0.1); color: var(--success);"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Hadir</span>
                        <span class="stat-val"><?= $stats_absensi['Hadir'] ?></span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(14, 165, 233, 0.1); color: var(--info);"><i class="fas fa-info-circle"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Izin/Sakit</span>
                        <span class="stat-val"><?= $stats_absensi['Izin'] + $stats_absensi['Sakit'] ?></span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(229, 62, 62, 0.1); color: var(--danger);"><i class="fas fa-times-circle"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Alpa</span>
                        <span class="stat-val"><?= $stats_absensi['Alpa'] ?></span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(229, 165, 10, 0.1); color: var(--accent);"><i class="fas fa-percentage"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Kehadiran</span>
                        <span class="stat-val"><?= $stats_absensi['Total'] > 0 ? round(($stats_absensi['Hadir'] / $stats_absensi['Total']) * 100) : 0 ?>%</span>
                    </div>
                </div>
            </div>

            <div class="detail-row">
                <div class="col-left">
                    <div class="premium-card">
                        <div class="premium-card-header">
                            <h3><i class="fas fa-id-card"></i> Biodata Santri</h3>
                        </div>
                        <div class="biodata-list">
                            <div class="biodata-item">
                                <p class="biodata-label">Jenis Kelamin</p>
                                <p class="biodata-value"><?= $santri['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
                            </div>
                            <div class="biodata-item">
                                <p class="biodata-label">Tempat, Tanggal Lahir</p>
                                <p class="biodata-value"><?= $santri['tanggal_lahir'] ? date('d F Y', strtotime($santri['tanggal_lahir'])) : '-' ?></p>
                            </div>
                            <div class="biodata-item">
                                <p class="biodata-label">Alamat Lengkap</p>
                                <p class="biodata-value"><?= htmlspecialchars($santri['alamat'] ?? '-') ?></p>
                            </div>
                            <div class="biodata-item">
                                <p class="biodata-label">Tahun Angkatan</p>
                                <p class="biodata-value"><?= date('Y', strtotime($santri['created_at'])) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- DATA ORANG TUA -->
                    <div class="premium-card">
                        <div class="premium-card-header">
                            <h3><i class="fas fa-user-friends"></i> Data Orang Tua</h3>
                        </div>
                        <div class="biodata-list">
                            <?php if ($parent): ?>
                                <div class="biodata-item">
                                    <p class="biodata-label">Nama Ayah</p>
                                    <p class="biodata-value"><?= htmlspecialchars($parent['nama_ayah'] ?? '-') ?></p>
                                </div>
                                <div class="biodata-item">
                                    <p class="biodata-label">No. HP Ayah</p>
                                    <p class="biodata-value"><?= htmlspecialchars($parent['no_telepon_ayah'] ?? '-') ?></p>
                                </div>
                                <div class="biodata-item">
                                    <p class="biodata-label">Nama Ibu</p>
                                    <p class="biodata-value"><?= htmlspecialchars($parent['nama_ibu'] ?? '-') ?></p>
                                </div>
                                <div class="biodata-item">
                                    <p class="biodata-label">No. HP Ibu</p>
                                    <p class="biodata-value"><?= htmlspecialchars($parent['no_telepon_ibu'] ?? '-') ?></p>
                                </div>
                            <?php else: ?>
                                <div style="text-align: center; padding: 20px; color: var(--gray);">
                                    <i class="fas fa-user-slash" style="font-size: 1.5rem; margin-bottom: 10px; opacity: 0.3;"></i>
                                    <p style="font-size: 0.85rem;">Data profil orang tua belum ditautkan.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-right">
                    <div class="premium-card">
                        <div class="premium-card-header">
                            <h3><i class="fas fa-book-quran"></i> 10 Riwayat Setoran Terakhir</h3>
                            <a href="<?= base_url('ustadz/hafalan') ?>" class="badge-info" style="color: var(--primary); font-weight: 700;">Lihat Semua</a>
                        </div>
                        <div class="history-list">
                            <?php if (!empty($riwayat_hafalan)): ?>
                                <?php foreach ($riwayat_hafalan as $r): ?>
                                    <div class="history-item">
                                        <div class="history-icon"><i class="fas fa-book-open"></i></div>
                                        <div class="history-content">
                                            <p class="history-date"><?= date('d F Y', strtotime($r['tanggal'])) ?></p>
                                            <h4 class="history-title"><?= htmlspecialchars($r['surah']) ?> <span style="font-weight: 400; font-size: 0.9rem;">(Ayat <?= $r['ayat_awal'] ?>-<?= $r['ayat_akhir'] ?>)</span></h4>
                                            <div class="history-meta">
                                                <?php 
                                                    $sClass = strtolower($r['status']);
                                                    if($sClass == 'lancar') $sClass = 'lancar';
                                                    elseif($sClass == 'sedang') $sClass = 'sedang';
                                                    else $sClass = 'mengulang';
                                                ?>
                                                <span class="status-badge <?= $sClass ?>"><?= ucfirst($r['status']) ?></span>
                                                <?php if(isset($r['nilai'])): ?>
                                                    <span class="status-badge" style="background: rgba(139, 92, 246, 0.1); color: var(--purple);">Nilai: <?= $r['nilai'] ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ($r['keterangan']): ?>
                                                <p class="history-note">"<?= htmlspecialchars($r['keterangan']) ?>"</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div style="text-align: center; padding: 60px; color: var(--gray);">
                                    <i class="fas fa-book-half" style="font-size: 3rem; margin-bottom: 20px; opacity: 0.1;"></i>
                                    <p>Belum ada riwayat setoran hafalan untuk santri ini.</p>
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
    </script>
</body>
</html>
