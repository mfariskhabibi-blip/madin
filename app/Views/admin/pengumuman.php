<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman - PTQ Pencongan</title>
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
        .menu-item i { margin-right: 12px; width: 20px; text-align: center; font-size: 1.1rem; }
        
        .dashboard-content { flex: 1; padding: 30px; background-color: #f5f7fa; overflow-y: auto; transition: var(--transition); }
        .page-title { font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
        .page-subtitle { color: var(--gray); font-size: 0.9rem; margin-bottom: 20px; }
        
        /* SECTION CARD */
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); flex-wrap: wrap; gap: 10px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px; }
        
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: .85rem; cursor: pointer; transition: .2s; border: none; outline: none; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: var(--light-gray); color: var(--dark); }
        .btn-secondary:hover { background: #d1d9e6; }
        
        /* ANNOUNCEMENT GRID */
        .announcement-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 20px; }
        .announcement-card { background: white; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); transition: var(--transition); border: 1px solid transparent; }
        .announcement-card:hover { transform: translateY(-5px); border-color: var(--primary); }
        .announcement-header { padding: 16px 20px; border-bottom: 1px solid #f0f2f5; display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; }
        .card-category { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--primary); background: rgba(26,95,180,0.08); padding: 4px 10px; border-radius: 6px; }
        .card-category.penting { color: var(--danger); background: rgba(229,62,62,0.08); }
        .card-category.keuangan { color: var(--accent); background: rgba(229,165,10,0.08); }
        .card-category.akademik { color: var(--secondary); background: rgba(38,162,105,0.08); }
        .card-category.umum { color: var(--info); background: rgba(14,165,233,0.08); }

        .card-actions { display: flex; gap: 6px; }
        .btn-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: var(--light); color: var(--gray); transition: var(--transition); cursor: pointer; border: none; }
        .btn-icon:hover { background: var(--primary); color: white; }
        .btn-icon.delete:hover { background: var(--danger); color: white; }

        .announcement-body { padding: 20px; flex-grow: 1; }
        .announcement-title { font-size: 1rem; font-weight: 700; color: var(--primary-dark); margin-bottom: 10px; line-height: 1.4; }
        .announcement-excerpt { font-size: 0.85rem; color: var(--gray); display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 15px; line-height: 1.5; }

        .announcement-footer { padding: 12px 20px; background: var(--light); border-top: 1px solid #f0f2f5; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
        .meta-item { display: flex; align-items: center; gap: 6px; font-size: 0.7rem; color: var(--gray); font-weight: 500; }
        .meta-item i { font-size: 0.8rem; opacity: 0.7; }

        .badge { padding: 4px 10px; border-radius: 20px; font-size: 0.65rem; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; }
        .badge-everyone { background: rgba(139, 92, 246, 0.1); color: var(--purple); }
        .badge-ustadz { background: rgba(14, 165, 233, 0.1); color: var(--info); }
        .badge-ortu { background: rgba(229, 165, 10, 0.1); color: var(--accent); }
        .badge-draft { background: rgba(113, 128, 150, 0.1); color: var(--gray); }
        .badge-terbit { background: rgba(38, 162, 105, 0.1); color: var(--success); }

        /* ALERT */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); border-left: 4px solid var(--success); }
        .alert-error { background: rgba(229,62,62,.1); color: #c53030; border: 1px solid rgba(229,62,62,.2); border-left: 4px solid var(--danger); }

        /* MODAL */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 20px; }
        .modal-overlay.active { display: flex; }
        .modal-card { background: white; width: 100%; max-width: 600px; border-radius: var(--radius); overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2); animation: slideUp 0.3s ease; }
        @keyframes slideUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }
        .modal-head { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); background: var(--light); }
        .modal-head h3 { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); }
        .btn-close { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: var(--gray); padding: 5px; border-radius: 5px; transition: var(--transition); }
        .btn-close:hover { background: var(--light-gray); color: var(--danger); }
        .modal-body { padding: 24px; max-height: 70vh; overflow-y: auto; }
        .form-group { margin-bottom: 18px; }
        .form-row { display: flex; gap: 15px; }
        .form-row .form-group { flex: 1; }
        .form-label { display: block; font-size: .85rem; font-weight: 600; color: var(--dark); margin-bottom: 8px; }
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid var(--light-gray); border-radius: 6px; font-size: .9rem; outline: none; transition: .2s; background: #fff; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,95,180,.15); }
        textarea.form-control { resize: vertical; min-height: 120px; }
        .modal-foot { padding: 16px 24px; background: var(--light); border-top: 1px solid var(--light-gray); display: flex; justify-content: flex-end; gap: 10px; }
        .modal-foot .btn { min-width: 100px; }

        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; }
        
        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 60px 20px; color: var(--gray); background: white; border-radius: var(--radius); box-shadow: var(--shadow); }
        .empty-state i { font-size: 4rem; color: var(--light-gray); margin-bottom: 20px; }
        .empty-state h3 { font-size: 1.3rem; color: var(--dark); margin-bottom: 10px; font-weight: 600; }
        .empty-state p { font-size: 0.95rem; }
        
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-container { position: relative; }
            .sidebar { position: absolute; left: -280px; height: 100%; box-shadow: none; }
            .sidebar.active { left: 0; box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2); }
            .sidebar-overlay.active { display: block; opacity: 1; }
            .user-name, .user-role { display: none; }
            .announcement-grid { grid-template-columns: 1fr; }
        }
        
        @media (max-width: 768px) {
            .page-title { font-size: 1.5rem; }
            .dashboard-content { padding: 20px 15px; }
            .card-header { flex-direction: column; align-items: flex-start; }
            .announcement-header { flex-wrap: wrap; }
            .modal-card { max-width: 95%; margin: 10px; }
            .modal-head { padding: 15px; }
            .modal-body { padding: 15px; }
            .modal-foot { padding: 12px 15px; flex-direction: column; }
            .modal-foot .btn { width: 100%; justify-content: center; }
            .form-row { flex-direction: column; gap: 0; }
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
                <div class="menu-item active"><a href="<?= base_url('admin/pengumuman') ?>"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <h1 class="page-title"><i class="fas fa-bullhorn"></i> Pengumuman & Informasi</h1>
            <p class="page-subtitle">Kelola pesan dan informasi untuk seluruh civitas PTQ Pencongan.</p>

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

            <!-- BUTTON ADD -->
            <div style="margin-bottom: 20px; text-align: right;">
                <button class="btn btn-primary" onclick="openAddModal()">
                    <i class="fas fa-plus"></i> Buat Pengumuman Baru
                </button>
            </div>

            <!-- ANNOUNCEMENT GRID -->
            <?php if(!empty($riwayat)): ?>
                <div class="announcement-grid">
                    <?php foreach($riwayat as $p): ?>
                        <div class="announcement-card">
                            <div class="announcement-header">
                                <span class="card-category <?= strtolower($p['kategori']) ?>"><?= htmlspecialchars($p['kategori']) ?></span>
                                <div class="card-actions">
                                    <button class="btn-icon" onclick='openEditModal(<?= htmlspecialchars(json_encode($p)) ?>)' title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <a href="<?= base_url('admin/pengumuman/delete/' . $p['id']) ?>" class="btn-icon delete" onclick="return confirm('Hapus pengumuman ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="announcement-body">
                                <h3 class="announcement-title"><?= htmlspecialchars($p['judul']) ?></h3>
                                <div class="announcement-excerpt">
                                    <?= htmlspecialchars(substr(strip_tags($p['konten']), 0, 150)) ?>
                                    <?php if(strlen(strip_tags($p['konten'])) > 150): ?>...<?php endif; ?>
                                </div>
                                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                    <?php 
                                        $rClass = 'badge-everyone'; $rIcon = 'fa-users'; $rLabel = 'Semua';
                                        if($p['target_role'] == 'ustadz') { $rClass = 'badge-ustadz'; $rIcon = 'fa-chalkboard-teacher'; $rLabel = 'Ustadz'; }
                                        if($p['target_role'] == 'ortu') { $rClass = 'badge-ortu'; $rIcon = 'fa-user-friends'; $rLabel = 'Orang Tua'; }
                                    ?>
                                    <span class="badge <?= $rClass ?>"><i class="fas <?= $rIcon ?>"></i> <?= $rLabel ?></span>
                                    <?php if($p['status'] == 'draft'): ?>
                                        <span class="badge badge-draft"><i class="fas fa-file-draft"></i> Draft</span>
                                    <?php else: ?>
                                        <span class="badge badge-terbit"><i class="fas fa-globe"></i> Terbit</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="announcement-footer">
                                <div class="meta-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <?= date('d M Y H:i', strtotime($p['created_at'])) ?>
                                </div>
                                <div class="meta-item">
                                    <i class="far fa-user"></i>
                                    <?= htmlspecialchars($p['nama_penulis'] ?? 'Admin') ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div style="background: rgba(0,0,0,0.02); border-radius: 50%; width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="fas fa-bullhorn" style="font-size: 3rem; color: var(--light-gray);"></i>
                    </div>
                    <h3>Belum Ada Pengumuman</h3>
                    <p>Klik tombol "Buat Pengumuman Baru" untuk memulai.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- MODAL TAMBAH/EDIT PENGUMUMAN -->
    <div class="modal-overlay" id="announcementModal">
        <form id="announcementForm" action="<?= base_url('admin/pengumuman/store') ?>" method="post" class="modal-card">
            <?= csrf_field() ?>
            <div class="modal-head">
                <h3 id="modalTitle"><i class="fas fa-plus-circle"></i> Buat Pengumuman Baru</h3>
                <button type="button" class="btn-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Judul Pengumuman *</label>
                    <input type="text" name="judul" id="f_judul" class="form-control" required placeholder="Masukkan judul yang informatif...">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kategori *</label>
                        <select name="kategori" id="f_kategori" class="form-control" required>
                            <option value="Umum">Umum</option>
                            <option value="Akademik">Akademik</option>
                            <option value="Keuangan">Keuangan</option>
                            <option value="Penting">Penting</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Target Publikasi *</label>
                        <select name="target_role" id="f_target" class="form-control" required>
                            <option value="semua">Semua (Publik)</option>
                            <option value="ustadz">Hanya Ustadz</option>
                            <option value="ortu">Hanya Orang Tua</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Konten / Isi Pengumuman *</label>
                    <textarea name="konten" id="f_konten" class="form-control" required placeholder="Tulis rincian pengumuman di sini..."></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" id="f_status" class="form-control" required>
                            <option value="terbit">Terbit (Langsung Publikasikan)</option>
                            <option value="draft">Draft (Simpan Sementara)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Pengumuman</button>
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

        // Auto hide alerts
        document.querySelectorAll('.alert').forEach(a => setTimeout(() => { a.style.opacity=0; setTimeout(()=>a.remove(),400); }, 5000));

        // Modal functions
        const modal = document.getElementById('announcementModal');
        const form = document.getElementById('announcementForm');
        const modalTitle = document.getElementById('modalTitle');

        function openAddModal() {
            modalTitle.innerHTML = '<i class="fas fa-plus-circle"></i> Buat Pengumuman Baru';
            form.action = '<?= base_url('admin/pengumuman/store') ?>';
            form.reset();
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function openEditModal(data) {
            modalTitle.innerHTML = '<i class="fas fa-edit"></i> Edit Pengumuman';
            form.action = '<?= base_url('admin/pengumuman/update/') ?>' + data.id;
            
            document.getElementById('f_judul').value = data.judul || '';
            document.getElementById('f_kategori').value = data.kategori || 'Umum';
            document.getElementById('f_target').value = data.target_role || 'semua';
            document.getElementById('f_konten').value = data.konten || '';
            document.getElementById('f_status').value = data.status || 'terbit';

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>