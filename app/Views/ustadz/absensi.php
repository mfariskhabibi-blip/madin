<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Santri - PTQ Al-Hikmah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET (From Uniform Dashboard) */
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
        .page-title { font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        
        /* PAGE SPECIFIC STYLES */
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); gap: 15px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px; }

        .date-filter { background: var(--light); padding: 15px 24px; border-bottom: 1px solid var(--light-gray); display: flex; align-items: center; gap: 15px; }
        .date-filter form { display: flex; align-items: center; gap: 15px; flex-wrap: wrap; }
        .form-control { padding: 10px 14px; border: 1px solid var(--light-gray); border-radius: 6px; font-size: .9rem; color: var(--dark); outline: none; transition: .2s; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,95,180,.15); }
        
        .btn { display: inline-flex; justify-content:center; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 6px; font-weight: 600; font-size: .9rem; cursor: pointer; transition: .2s; border: none; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline { background: transparent; border: 1px solid var(--light-gray); color: var(--dark); }
        .btn-outline:hover { background: var(--light); }

        .table-responsive { overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { text-align: left; padding: 12px 24px; background: var(--light); font-size: .75rem; text-transform: uppercase; letter-spacing: .5px; color: var(--gray); font-weight: 700; border-bottom: 1px solid var(--light-gray); }
        .table td { padding: 14px 24px; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
        .table tr:last-child td { border-bottom: none; }
        .table tr:hover { background: #f8fafc; }

        .santri-name { font-weight: 600; color: var(--dark); font-size: .95rem; }
        .santri-kelas { font-size: .75rem; color: var(--gray); }

        /* ABSENSI RADIOS PUSH-BUTTON STYLE */
        .radio-group { display: flex; gap: 8px; flex-wrap: wrap; }
        .radio-btn { position: relative; }
        .radio-btn input { position: absolute; opacity: 0; cursor: pointer; height: 0; width: 0; }
        .radio-label { display: inline-block; padding: 6px 14px; border-radius: 20px; font-size: .8rem; font-weight: 600; cursor: pointer; border: 1px solid var(--light-gray); background: var(--light); color: var(--gray); transition: .2s; user-select: none; }
        
        .radio-btn input:checked ~ .label-hadir { background: var(--success); border-color: var(--success); color: white; }
        .radio-btn input:checked ~ .label-izin { background: var(--warning); border-color: var(--warning); color: white; }
        .radio-btn input:checked ~ .label-sakit { background: var(--info); border-color: var(--info); color: white; }
        .radio-btn input:checked ~ .label-alpa { background: var(--danger); border-color: var(--danger); color: white; }

        .input-keterangan { width: 100%; min-width: 150px; padding: 8px 12px; border: 1px solid var(--light-gray); border-radius: 6px; font-size: .85rem; }
        .input-keterangan:focus { border-color: var(--primary); outline: none; }

        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); }
        .alert-danger  { background: rgba(229,62,62,.1);  color: #c53030; border: 1px solid rgba(229,62,62,.2); }

        .form-footer { padding: 20px 24px; background: var(--light); border-top: 1px solid var(--light-gray); display: flex; justify-content: flex-end; position: sticky; bottom: 0; z-index: 10; box-shadow: 0 -4px 10px rgba(0,0,0,0.05); }

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
            .table td { display: flex; flex-direction: column; padding: 10px 0; border-bottom: 1px dashed var(--light-gray); }
            .table td:last-child { border-bottom: none; }
            .table td::before { content: attr(data-label); font-weight: 600; color: var(--gray); font-size: .75rem; text-transform: uppercase; margin-bottom: 8px; }
            .form-footer { position: fixed; bottom: 0; left: 0; width: 100%; justify-content: stretch; }
            .form-footer .btn { width: 100%; }
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
        
        <!-- SIDEBAR -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="welcome-text">Selamat Mengajar,</div>
                <div class="admin-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Ustadz') ?></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('ustadz/dashboard') ?>"><i class="fas fa-th-large"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/santri') ?>"><i class="fas fa-graduation-cap"></i><span>Santri Binaan</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('ustadz/absensi') ?>"><i class="fas fa-user-check"></i><span>Absensi Santri</span></a></div>
                
                <div style="padding: 15px 15px 5px; color: rgba(255,255,255,0.4); font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Manajemen Hafalan</div>
                <div class="menu-item"><a href="<?= base_url('ustadz/hafalan') ?>"><i class="fas fa-book-open"></i><span>Setoran Hafalan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/murojaah') ?>"><i class="fas fa-sync-alt"></i><span>Muroja'ah</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/progres-kelas') ?>"><i class="fas fa-chart-line"></i><span>Progres Kelas</span></a></div>
            </div>
        </div>
        
        <!-- CONTENT -->
        <div class="dashboard-content" id="mainContent">
        <h1 class="page-title"><i class="fas fa-calendar-check"></i> Absensi Santri</h1>

        <!-- ALERTS -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="section-card">
            <div class="date-filter">
                <form action="<?= base_url('ustadz/absensi') ?>" method="get">
                    <span style="font-weight:600;color:var(--dark);">Pilih Tanggal:</span>
                    <input type="date" name="tanggal" class="form-control" value="<?= htmlspecialchars($tanggal) ?>" max="<?= date('Y-m-d') ?>" required>
                    <button type="submit" class="btn btn-outline" style="padding: 8px 14px;"><i class="fas fa-search"></i> Tampilkan</button>
                    <?php if($tanggal != date('Y-m-d')): ?>
                        <a href="<?= base_url('ustadz/absensi') ?>" class="btn btn-outline" style="padding: 8px 14px;color:var(--primary);"><i class="fas fa-calendar-day"></i> Hari Ini</a>
                    <?php endif; ?>
                </form>
            </div>

            <form action="<?= base_url('ustadz/absensi/store') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="tanggal" value="<?= htmlspecialchars($tanggal) ?>">
                
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(26,95,180,.1);color:var(--primary);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-users"></i>
                        </div>
                        Daftar Santri Bimbingan Anda
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Santri & Rombel</th>
                                <th>Status Kehadiran</th>
                                <th>Keterangan (Opsional)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($santri)): ?>
                                <?php foreach($santri as $s): ?>
                                    <?php 
                                        $rStatus = $riwayat[$s['id']]['status'] ?? 'Hadir'; // default Hadir
                                        $rKet = $riwayat[$s['id']]['keterangan'] ?? '';
                                    ?>
                                    <tr>
                                        <td data-label="Profil Santri">
                                            <div class="santri-name"><?= htmlspecialchars($s['nama_santri']) ?></div>
                                            <div class="santri-kelas"><i class="fas fa-school"></i> <?= htmlspecialchars($s['nama_kelas'] ?? 'Belum ada kelas') ?></div>
                                        </td>
                                        <td data-label="Status Kehadiran">
                                            <div class="radio-group">
                                                <label class="radio-btn">
                                                    <input type="radio" name="absensi[<?= $s['id'] ?>][status]" value="Hadir" <?= $rStatus == 'Hadir' ? 'checked' : '' ?>>
                                                    <span class="radio-label label-hadir">Hadir</span>
                                                </label>
                                                <label class="radio-btn">
                                                    <input type="radio" name="absensi[<?= $s['id'] ?>][status]" value="Izin" <?= $rStatus == 'Izin' ? 'checked' : '' ?>>
                                                    <span class="radio-label label-izin">Izin</span>
                                                </label>
                                                <label class="radio-btn">
                                                    <input type="radio" name="absensi[<?= $s['id'] ?>][status]" value="Sakit" <?= $rStatus == 'Sakit' ? 'checked' : '' ?>>
                                                    <span class="radio-label label-sakit">Sakit</span>
                                                </label>
                                                <label class="radio-btn">
                                                    <input type="radio" name="absensi[<?= $s['id'] ?>][status]" value="Alpa" <?= $rStatus == 'Alpa' ? 'checked' : '' ?>>
                                                    <span class="radio-label label-alpa">Alpa</span>
                                                </label>
                                            </div>
                                        </td>
                                        <td data-label="Keterangan">
                                            <input type="text" name="absensi[<?= $s['id'] ?>][keterangan]" class="input-keterangan" value="<?= htmlspecialchars($rKet) ?>" placeholder="Catatan...">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" style="text-align:center;padding:40px;color:var(--gray);">
                                        <i class="fas fa-user-slash" style="font-size:3rem;margin-bottom:15px;color:var(--light-gray);"></i>
                                        <p>Anda belum memiliki daftar santri bimbingan.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if(!empty($santri)): ?>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data Kehadiran</button>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </div> <!-- /CONTENT -->
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

    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Apakah Anda yakin ingin keluar?')) {
            window.location.href = this.getAttribute('href');
        }
    });

    document.querySelectorAll('.alert').forEach(a => setTimeout(() => { a.style.opacity=0; setTimeout(()=>a.remove(),400); }, 5000));
</script>
</body>
</html>
