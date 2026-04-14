<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Hafalan Santri - PTQ Pencongan</title>
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
        .logo img { height: 36px; border-radius: 6px; }
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
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px; }
        
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: .85rem; cursor: pointer; transition: .2s; border: none; outline: none; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline { background: transparent; border: 1px solid var(--light-gray); color: var(--dark); }
        .btn-outline:hover { background: var(--light); }
        
        .table-responsive { overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { text-align: left; padding: 12px 24px; background: var(--light); font-size: .75rem; text-transform: uppercase; letter-spacing: .5px; color: var(--gray); font-weight: 700; border-bottom: 1px solid var(--light-gray); }
        .table td { padding: 14px 24px; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
        .table tr:hover { background: #f8fafc; }

        .s-name { font-weight: 600; font-size: .95rem; color: var(--dark); }
        .s-info { font-size: .75rem; color: var(--gray); margin-top:2px; display:flex; gap:10px;}
        .surah-text { font-weight: 700; color: var(--primary-dark); font-size: .95rem; }
        .ayat-text { font-size: .8rem; color: var(--gray); }

        .badge { padding: 5px 10px; border-radius: 20px; font-size: .7rem; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; }
        .badge-lancar { background: rgba(38,162,105,.1); color: var(--success); }
        .badge-sedang { background: rgba(221,107,32,.1); color: var(--warning); }
        .badge-mengulang { background: rgba(229,62,62,.1); color: var(--danger); }

        .action-cell { display: flex; gap: 6px; }
        .act-btn { width: 32px; height: 32px; border-radius: 8px; border: none; display: flex; align-items: center; justify-content: center; font-size: .85rem; cursor: pointer; transition: .2s; color: #fff; }
        .act-edit { background: var(--info); }
        .act-edit:hover { background: #0284c7; }
        .act-delete { background: var(--danger); }
        .act-delete:hover { background: #c53030; }

        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); }
        .alert-error { background: rgba(229,62,62,.1); color: #c53030; border: 1px solid rgba(229,62,62,.2); }

        /* MODAL STYLES */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,.5); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 15px; }
        .modal-overlay.active { display: flex; }
        .modal-card { background: #fff; width: 100%; max-width: 500px; border-radius: var(--radius); box-shadow: 0 10px 30px rgba(0,0,0,.2); animation: slideUp .3s ease; overflow: hidden; }
        @keyframes slideUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }
        .modal-head { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); background: var(--light); }
        .modal-head h3 { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); margin: 0; }
        .btn-close { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: var(--gray); padding: 5px; border-radius: 5px; transition: var(--transition); }
        .btn-close:hover { background: var(--light-gray); color: var(--danger); }
        .modal-body { padding: 24px; max-height: 70vh; overflow-y: auto; }
        .form-group { margin-bottom: 18px; }
        .form-row { display: flex; gap: 15px; }
        .form-row .form-group { flex: 1; }
        .form-label { display: block; font-size: .85rem; font-weight: 600; color: var(--dark); margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 14px; border: 1px solid var(--light-gray); border-radius: 6px; font-size: .9rem; outline: none; transition: var(--transition); background: #fff; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,95,180,.15); }
        .modal-foot { padding: 16px 24px; background: var(--light); border-top: 1px solid var(--light-gray); display: flex; justify-content: flex-end; gap: 10px; }
        .modal-foot .btn { min-width: 100px; }

        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; }
        
        /* MODAL RESPONSIVE */
        @media (max-width: 576px) {
            .modal-card { max-width: 95%; margin: 10px; }
            .modal-head { padding: 15px; }
            .modal-body { padding: 15px; }
            .modal-foot { padding: 12px 15px; flex-direction: column; }
            .modal-foot .btn { width: 100%; justify-content: center; }
            .form-row { flex-direction: column; gap: 0; }
        }
        
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-container { position: relative; }
            .sidebar { position: absolute; left: -280px; height: 100%; }
            .sidebar.active { left: 0; box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2); }
            .sidebar-overlay.active { display: block; opacity: 1; }
            .user-name, .user-role { display: none; }
        }
        
        /* CARDS FOR MOBILE */
        @media (max-width: 768px) {
            .page-title { font-size: 1.5rem; }
            .dashboard-content { padding: 20px 15px; }
            .table thead { display: none; }
            .table, .table tbody, .table tr, .table td { display: block; width: 100%; }
            .table tr { margin-bottom: 15px; padding: 15px; border-radius: 12px; border: 1px solid var(--light-gray); background: #fff; box-shadow: 0 2px 6px rgba(0,0,0,.04); }
            .table td { display: flex; justify-content: space-between; align-items: flex-start; padding: 10px 0; border-bottom: 1px dashed var(--light-gray); text-align: right; }
            .table td:last-child { border-bottom: none; }
            .table td::before { content: attr(data-label); font-weight: 600; color: var(--gray); font-size: .75rem; text-transform: uppercase; float: left; text-align: left; margin-top:2px; }
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
        
        <!-- SIDEBAR -->
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
                <div class="menu-item active"><a href="<?= base_url('ustadz/hafalan') ?>"><i class="fas fa-book-open"></i><span>Setoran Hafalan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/murojaah') ?>"><i class="fas fa-sync-alt"></i><span>Muroja'ah</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ustadz/progres-kelas') ?>"><i class="fas fa-chart-line"></i><span>Progres Kelas</span></a></div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <h1 class="page-title"><i class="fas fa-quran"></i> Catat Hafalan Santri</h1>

        <!-- ALERTS -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <div style="display:flex;flex-direction:column;">
                    <?php foreach(session()->getFlashdata('errors') as $err): ?>
                        <span><?= $err ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="section-card" style="margin-bottom:15px; background:transparent; box-shadow:none;">
            <form action="<?= base_url('ustadz/hafalan') ?>" method="get" style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">
                <div style="flex:1; min-width:200px;">
                    <label style="font-size:.7rem; font-weight:700; color:var(--gray); text-transform:uppercase; margin-bottom:5px; display:block;">Cari Santri</label>
                    <input type="text" name="santri" class="form-control" placeholder="Nama santri..." value="<?= htmlspecialchars($filter['santri'] ?? '') ?>">
                </div>
                <div style="flex:1; min-width:150px;">
                    <label style="font-size:.7rem; font-weight:700; color:var(--gray); text-transform:uppercase; margin-bottom:5px; display:block;">Kelas</label>
                    <select name="id_kelas" class="form-control">
                        <option value="">-- Semua Kelas --</option>
                        <?php foreach($kelasList as $k): ?>
                            <option value="<?= $k['id'] ?>" <?= ($filter['id_kelas'] == $k['id']) ? 'selected' : '' ?>><?= htmlspecialchars($k['nama_kelas']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div style="flex:1; min-width:150px;">
                    <label style="font-size:.7rem; font-weight:700; color:var(--gray); text-transform:uppercase; margin-bottom:5px; display:block;">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= htmlspecialchars($filter['tanggal'] ?? '') ?>">
                </div>
                <div style="display:flex; gap:8px;">
                    <button type="submit" class="btn btn-primary" style="height:45px; padding:0 20px;">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <?php if(!empty($filter['santri']) || !empty($filter['id_kelas']) || !empty($filter['tanggal'])): ?>
                        <a href="<?= base_url('ustadz/hafalan') ?>" class="btn btn-outline" style="height:45px; display:flex; align-items:center; justify-content:center; background:#fff;">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <div class="section-card">
            <div class="card-header">
                <div class="card-title">
                    <div style="width:36px;height:36px;border-radius:8px;background:rgba(26,95,180,.1);color:var(--primary);display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-list"></i>
                    </div>
                    Riwayat Hafalan Santri
                </div>
                <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('active')">
                    <i class="fas fa-plus"></i> Tambah Setoran
                </button>
            </div>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal & Santri</th>
                            <th>Materi / Surah</th>
                            <th>Kinerja (Nilai)</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($riwayat)): ?>
                            <?php foreach($riwayat as $r): ?>
                                <tr>
                                    <td data-label="Santri">
                                        <div class="s-name"><?= htmlspecialchars($r['nama_santri']) ?></div>
                                        <div class="s-info">
                                            <span><i class="fas fa-calendar-day"></i> <?= date('d M Y', strtotime($r['tanggal'])) ?></span>
                                            <span><i class="fas fa-hashtag"></i> <?= htmlspecialchars($r['nis'] ?? '-') ?></span>
                                        </div>
                                    </td>
                                    <td data-label="Surah & Ayat">
                                        <div class="surah-text"><?= htmlspecialchars($r['surah']) ?></div>
                                        <div class="ayat-text">Ayat: <?= htmlspecialchars($r['ayat_awal']) ?> s/d <?= htmlspecialchars($r['ayat_akhir']) ?></div>
                                    </td>
                                    <td data-label="Nilai">
                                        <?php
                                            $bClass = 'badge-lancar';
                                            $bIcon = 'fa-star';
                                            if($r['nilai'] < 8) { $bClass = 'badge-mengulang'; $bIcon = 'fa-redo'; }
                                        ?>
                                        <span class="badge <?= $bClass ?>" style="font-size: 1rem; padding: 8px 15px;">
                                            <i class="fas <?= $bIcon ?>"></i> <?= htmlspecialchars($r['nilai'] ?? '0') ?>
                                        </span>
                                    </td>
                                    <td data-label="Keterangan">
                                        <span style="font-size: .85rem; color:var(--gray);"><?= htmlspecialchars($r['keterangan'] ?? '-') ?></span>
                                    </td>
                                    <td data-label="Aksi">
                                        <div class="action-cell">
                                            <button class="act-btn act-edit" onclick="openEditModal(<?= htmlspecialchars(json_encode($r)) ?>)" title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <a href="<?= base_url('ustadz/hafalan/delete/' . $r['id']) ?>" class="act-btn act-delete" onclick="return confirm('Hapus riwayat setoran ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align:center;padding:40px;color:var(--gray);">
                                    <i class="fas fa-book-open" style="font-size:3rem;margin-bottom:15px;color:var(--light-gray);"></i>
                                    <p>Belum ada catatan setoran baru dari Santri.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- /CONTENT -->
    </div>

    <!-- MODAL TAMBAH HAFALAN -->
    <div class="modal-overlay" id="addModal">
        <form action="<?= base_url('ustadz/hafalan/store') ?>" method="post" class="modal-card">
            <?= csrf_field() ?>
            <div class="modal-head">
                <h3><i class="fas fa-plus-circle"></i> Tambah Hafalan</h3>
                <button type="button" class="btn-close" onclick="document.getElementById('addModal').classList.remove('active')"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Santri *</label>
                    <select name="id_santri" class="form-control" required>
                        <option value="">-- Pilih Santri --</option>
                        <?php foreach($santriList as $s): ?>
                            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['nama_santri']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Surah *</label>
                    <input type="text" name="surah" class="form-control" required placeholder="Contoh: Al-Baqarah">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Ayat Awal *</label>
                        <input type="number" name="ayat_awal" class="form-control" required min="1" placeholder="1">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ayat Akhir *</label>
                        <input type="number" name="ayat_akhir" class="form-control" required min="1" placeholder="10">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nilai / Kinerja *</label>
                    <select name="nilai" class="form-control" required>
                        <option value="9">Istimewa (9)</option>
                        <option value="8">Lancar (8)</option>
                        <option value="7">Cukup / Muroja'ah (7)</option>
                        <option value="6">Kurang / Muroja'ah (6)</option>
                        <option value="5">Sangat Kurang / Muroja'ah (5)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="2" placeholder="Catatan..."></textarea>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn btn-outline" onclick="document.getElementById('addModal').classList.remove('active')">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>

    <!-- MODAL EDIT HAFALAN -->
    <div class="modal-overlay" id="editModal">
        <form id="editForm" method="post" class="modal-card">
            <?= csrf_field() ?>
            <div class="modal-head">
                <h3><i class="fas fa-edit"></i> Edit Hafalan</h3>
                <button type="button" class="btn-close" onclick="document.getElementById('editModal').classList.remove('active')"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group" style="padding:12px; background:var(--light); border-radius:6px; margin-bottom:18px;">
                    <div style="font-size:.8rem; color:var(--gray);">Santri</div>
                    <div id="edit_nama_santri" style="font-weight:bold; color:var(--primary-dark);"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="edit_tanggal" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Surah *</label>
                    <input type="text" name="surah" id="edit_surah" class="form-control" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Ayat Awal *</label>
                        <input type="number" name="ayat_awal" id="edit_awal" class="form-control" required min="1">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ayat Akhir *</label>
                        <input type="number" name="ayat_akhir" id="edit_akhir" class="form-control" required min="1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nilai / Kinerja *</label>
                    <select name="nilai" id="edit_nilai" class="form-control" required>
                        <option value="9">Istimewa (9)</option>
                        <option value="8">Lancar (8)</option>
                        <option value="7">Cukup / Muroja'ah (7)</option>
                        <option value="6">Kurang / Muroja'ah (6)</option>
                        <option value="5">Sangat Kurang / Muroja'ah (5)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="edit_ket" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn btn-outline" onclick="document.getElementById('editModal').classList.remove('active')">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
            </div>
        </form>
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

    function openEditModal(d) {
        document.getElementById('edit_tanggal').value = d.tanggal || '';
        document.getElementById('edit_nama_santri').innerText = d.nama_santri || '';
        document.getElementById('edit_surah').value = d.surah || '';
        document.getElementById('edit_awal').value = d.ayat_awal || '';
        document.getElementById('edit_akhir').value = d.ayat_akhir || '';
        document.getElementById('edit_nilai').value = d.nilai || '8';
        document.getElementById('edit_ket').value = d.keterangan || '';
        document.getElementById('editForm').action = '<?= base_url("ustadz/hafalan/update/") ?>' + d.id;
        document.getElementById('editModal').classList.add('active');
    }
</script>
</body>
</html>
