<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Pelajaran - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET - Consistent with All Pages */
        :root {
            --primary: #1a5fb4; --primary-dark: #1c3d78; --secondary: #26a269;
            --accent: #e5a50a; --light: #f8f9fa; --gray: #718096;
            --light-gray: #e2e8f0; --dark: #2d3748; --danger: #e53e3e;
            --success: #38a169; --warning: #dd6b20; --info: #0ea5e9;
            --purple: #8b5cf6; --shadow: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-md: 0 10px 15px -3px rgba(0,0,0,0.1);
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
        .menu-item a { display: flex; align-items: center; padding: 14px 15px; border-radius: var(--radius); transition: var(--transition); color: white; }
        .menu-item a:hover, .menu-item.active a { background: rgba(255, 255, 255, 0.1); transform: translateX(5px); }
        .menu-item i { margin-right: 12px; width: 20px; text-align: center; font-size: 1.1rem; }
        
        .dashboard-content { flex: 1; padding: 30px; background-color: #f5f7fa; overflow-y: auto; transition: var(--transition); }
        .page-title { font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 8px; display: flex; align-items: center; gap: 10px; font-weight: 700; }
        .page-subtitle { color: var(--gray); font-size: 0.9rem; margin-bottom: 25px; }
        
        /* ANAK LIST */
        .anak-list { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 30px; }
        .anak-tag { background: white; padding: 10px 20px; border-radius: 30px; font-weight: 600; font-size: 0.85rem; color: var(--primary); border: 1px solid var(--primary); box-shadow: var(--shadow); transition: var(--transition); }
        .anak-tag:hover { background: var(--primary); color: white; transform: translateY(-2px); }
        .anak-tag i { margin-right: 8px; }
        
        /* SCHEDULES CONTAINER */
        .schedules-container { display: flex; flex-direction: column; gap: 24px; }
        .day-section { background: white; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; border: 1px solid var(--light-gray); }
        .day-header { background: var(--light); padding: 15px 25px; border-bottom: 1px solid var(--light-gray); display: flex; align-items: center; gap: 12px; }
        .day-title { font-weight: 800; color: var(--primary); font-size: 1rem; text-transform: uppercase; letter-spacing: 1px; }
        
        .jadwal-list { display: flex; flex-direction: column; }
        .jadwal-row { display: grid; grid-template-columns: 120px 1fr auto; align-items: center; padding: 18px 25px; border-bottom: 1px solid var(--light-gray); transition: var(--transition); }
        .jadwal-row:last-child { border-bottom: none; }
        .jadwal-row:hover { background: #fafcff; }
        
        .time-box { background: rgba(26, 95, 180, 0.1); color: var(--primary); padding: 8px 14px; border-radius: 8px; font-weight: 700; font-family: monospace; font-size: 0.9rem; text-align: center; width: fit-content; }
        .activity-info { padding: 0 20px; }
        .activity-name { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 6px; }
        .activity-details { font-size: 0.8rem; color: var(--gray); display: flex; align-items: center; gap: 20px; flex-wrap: wrap; }
        .activity-details i { color: var(--accent); width: 20px; }
        
        .action-btn { color: var(--primary); background: none; border: none; cursor: pointer; padding: 8px; border-radius: 6px; transition: var(--transition); }
        .action-btn:hover { background: rgba(26, 95, 180, 0.1); }
        
        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 80px 20px; background: white; border-radius: var(--radius); box-shadow: var(--shadow); border: 1px solid var(--light-gray); }
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
        }
        
        @media (max-width: 768px) {
            .page-title { font-size: 1.5rem; }
            .dashboard-content { padding: 20px 15px; }
            .jadwal-row { grid-template-columns: 1fr; gap: 12px; padding: 15px 20px; }
            .time-box { width: fit-content; }
            .activity-info { padding: 0; }
            .activity-details { gap: 12px; flex-direction: column; align-items: flex-start; }
            .anak-tag { padding: 6px 14px; font-size: 0.75rem; }
            .day-header { padding: 12px 20px; }
            .day-title { font-size: 0.9rem; }
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
                <div class="admin-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Wali Murid') ?></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('ortu/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/progres') ?>"><i class="fas fa-chart-line"></i><span>Progres Santri</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/hafalan') ?>"><i class="fas fa-quran"></i><span>Hafalan Anak</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/kehadiran') ?>"><i class="fas fa-calendar-check"></i><span>Kehadiran</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/pembayaran') ?>"><i class="fas fa-wallet"></i><span>Pembayaran</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('ortu/jadwal') ?>"><i class="fas fa-calendar-alt"></i><span>Jadwal</span></a></div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <h1 class="page-title"><i class="fas fa-calendar-alt"></i> Jadwal Pelajaran</h1>
            <p class="page-subtitle">Jadwal kegiatan belajar mengajar untuk anak Anda</p>

            <!-- Alert Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <!-- DAFTAR ANAK -->
            <?php if(isset($anak) && !empty($anak)): ?>
            <div class="anak-list">
                <?php foreach($anak as $a): ?>
                    <div class="anak-tag">
                        <i class="fas fa-child"></i> <?= htmlspecialchars($a['nama_santri']) ?> 
                        <span style="font-weight: normal; opacity: 0.7;">(<?= htmlspecialchars($a['nama_kelas'] ?? 'Belum ada kelas') ?>)</span>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- JADWAL -->
            <?php if(!empty($jadwal)): 
                $groupedJadwal = [];
                foreach($jadwal as $j) {
                    $groupedJadwal[$j['hari']][] = $j;
                }
                $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            ?>
            <div class="schedules-container">
                <?php foreach($days as $day): if(!isset($groupedJadwal[$day])) continue; ?>
                <div class="day-section">
                    <div class="day-header">
                        <i class="fas fa-calendar-day" style="color: var(--primary); font-size: 1.2rem;"></i>
                        <div class="day-title"><?= $day ?></div>
                    </div>
                    <div class="jadwal-list">
                        <?php foreach($groupedJadwal[$day] as $j): ?>
                        <div class="jadwal-row">
                            <div class="time-box">
                                <i class="far fa-clock" style="margin-right: 5px;"></i>
                                <?= substr($j['jam_mulai'], 0, 5) ?> - <?= substr($j['jam_selesai'], 0, 5) ?>
                            </div>
                            <div class="activity-info">
                                <div class="activity-name"><?= htmlspecialchars($j['nama_kegiatans']) ?></div>
                                <div class="activity-details">
                                    <span><i class="fas fa-school"></i> <?= htmlspecialchars($j['nama_kelas']) ?></span>
                                    <span><i class="fas fa-chalkboard-user"></i> <?= htmlspecialchars($j['nama_ustadz'] ?? 'Ustadz') ?></span>
                                </div>
                            </div>
                            <div class="action-btn" title="Detail">
                                <i class="fas fa-info-circle"></i>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h3>Belum Ada Jadwal</h3>
                <p>Data jadwal belum tersedia atau anak Anda belum ditempatkan di kelas manapun.<br>Silakan hubungi administrator untuk informasi lebih lanjut.</p>
            </div>
            <?php endif; ?>

            <!-- INFORMASI TAMBAHAN -->
            <div style="margin-top: 30px; background: white; border-radius: var(--radius); padding: 20px; border: 1px solid var(--light-gray); box-shadow: var(--shadow);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                    <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(14, 165, 233, 0.1); display: flex; align-items: center; justify-content: center; color: var(--info);">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3 style="font-size: 1rem; font-weight: 700; color: var(--dark);">Informasi Jadwal</h3>
                </div>
                <ul style="margin-left: 48px; font-size: 0.85rem; color: var(--gray); display: flex; flex-direction: column; gap: 6px;">
                    <li>• <strong>Jadwal dapat berubah</strong> sewaktu-waktu sesuai dengan kebijakan pondok</li>
                    <li>• <strong>Waktu kegiatan</strong> mengacu pada jam pesantren (WIB)</li>
                    <li>• Untuk informasi lebih lanjut, silakan hubungi ustadz pengampu kelas</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle logic
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
    </script>
</body>
</html>