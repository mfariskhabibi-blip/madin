<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pembayaran - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET - Consistent with All Pages */
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
        .page-title { font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        
        /* SECTION CARD */
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); flex-wrap: wrap; gap: 10px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 10px; }
        
        /* TABLE STYLES */
        .table-responsive { overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { text-align: left; padding: 12px 24px; background: var(--light); font-size: .75rem; text-transform: uppercase; letter-spacing: .5px; color: var(--gray); font-weight: 700; border-bottom: 1px solid var(--light-gray); }
        .table td { padding: 14px 24px; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
        .table tr:hover { background: #f8fafc; }
        
        /* CHILD STYLES */
        .child-name { font-weight: 700; color: var(--primary-dark); font-size: 0.95rem; margin-bottom: 4px; }
        .invoice-type { font-size: 0.8rem; color: var(--gray); }
        .nominal-text { font-weight: 800; color: var(--secondary); font-size: 1rem; }
        
        /* BADGES */
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; }
        .badge-lunas { background: rgba(56, 161, 105, 0.1); color: var(--success); }
        .badge-pending { background: rgba(221, 107, 32, 0.1); color: var(--warning); }
        .badge-ditolak { background: rgba(229, 62, 62, 0.1); color: var(--danger); }
        .badge-waiting { background: rgba(14, 165, 233, 0.1); color: var(--info); }
        
        /* BUTTONS */
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; cursor: pointer; transition: var(--transition); border: none; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline { background: transparent; border: 1px solid var(--light-gray); color: var(--dark); }
        .btn-outline:hover { background: var(--light); }
        .btn-sm { padding: 6px 12px; font-size: 0.7rem; }
        
        /* ALERT */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border-left: 4px solid var(--success); }
        .alert-error { background: rgba(229,62,62,.1); color: #c53030; border-left: 4px solid var(--danger); }
        
        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 60px 20px; color: var(--gray); }
        .empty-state i { font-size: 4rem; color: var(--light-gray); margin-bottom: 20px; }
        .empty-state h3 { font-size: 1.3rem; color: var(--dark); margin-bottom: 10px; font-weight: 600; }
        .empty-state p { font-size: 0.95rem; }
        
        /* MODAL */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; display: none; align-items: center; justify-content: center; padding: 15px; }
        .modal-overlay.active { display: flex; }
        .modal-card { background: #fff; width: 100%; max-width: 450px; border-radius: var(--radius); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); animation: slideUp .3s ease; overflow: hidden; }
        @keyframes slideUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }
        .modal-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); background: var(--light); }
        .modal-header h3 { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); }
        .btn-close { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: var(--gray); padding: 5px; border-radius: 5px; transition: var(--transition); }
        .btn-close:hover { background: var(--light-gray); color: var(--danger); }
        .modal-body { padding: 24px; max-height: 70vh; overflow-y: auto; }
        .modal-footer { padding: 16px 24px; background: var(--light); border-top: 1px solid var(--light-gray); display: flex; justify-content: flex-end; gap: 10px; }
        .modal-footer .btn { min-width: 100px; }
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: .85rem; font-weight: 600; color: var(--dark); margin-bottom: 8px; }
        .file-input { width: 100%; padding: 12px 14px; border: 2px dashed var(--light-gray); border-radius: 6px; font-size: .9rem; outline: none; background: #fff; cursor: pointer; }
        .file-input:hover { border-color: var(--primary); background: rgba(26, 95, 180, 0.02); }
        .info-box { background: rgba(26, 95, 180, 0.05); padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid var(--primary); }
        .info-box p { font-size: 0.85rem; }
        .info-box p:first-child { font-weight: 600; color: var(--primary-dark); margin-bottom: 8px; }
        
        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; }
        
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
            .table thead { display: none; }
            .table, .table tbody, .table tr, .table td { display: block; width: 100%; }
            .table tr { margin-bottom: 15px; padding: 15px; border-radius: 12px; border: 1px solid var(--light-gray); background: #fff; box-shadow: 0 2px 6px rgba(0,0,0,.04); }
            .table td { display: flex; justify-content: space-between; align-items: flex-start; padding: 10px 0; border-bottom: 1px dashed var(--light-gray); text-align: right; }
            .table td:last-child { border-bottom: none; }
            .table td::before { content: attr(data-label); font-weight: 600; color: var(--gray); font-size: .75rem; text-transform: uppercase; float: left; text-align: left; width: 40%; }
            .card-header { flex-direction: column; align-items: flex-start; }
            .modal-card { max-width: 95%; margin: 10px; }
            .modal-header { padding: 15px; }
            .modal-body { padding: 15px; }
            .modal-footer { padding: 12px 15px; flex-direction: column; }
            .modal-footer .btn { width: 100%; justify-content: center; }
        }
        
        @media (max-width: 576px) {
            .stat-card { padding: 15px; }
            .stat-value { font-size: 1.6rem; }
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
                                    $nama = $nama_ortu ?? 'WM';
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
                                <div class="user-name"><?= htmlspecialchars($nama_ortu ?? 'Wali Murid') ?></div>
                                <div class="user-role">Wali Murid</div>
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
                <div class="menu-item active"><a href="<?= base_url('ortu/pembayaran') ?>"><i class="fas fa-wallet"></i><span>Pembayaran</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/jadwal') ?>"><i class="fas fa-calendar-alt"></i><span>Jadwal</span></a></div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="dashboard-content" id="mainContent">
            <h1 class="page-title"><i class="fas fa-wallet"></i> Sistem Pembayaran / SPP</h1>

            <!-- Alert Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(26,95,180,.1);color:var(--primary);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        Daftar Tagihan & Riwayat Pembayaran
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Anak & Jenis Tagihan</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Bukti / Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($riwayat)): ?>
                                <?php foreach($riwayat as $r): ?>
                                    <tr>
                                        <td data-label="Anak & Tagihan">
                                            <div class="child-name"><?= htmlspecialchars($r['nama_santri']) ?></div>
                                            <div class="invoice-type"><?= htmlspecialchars($r['jenis_pembayaran']) ?></div>
                                        </td>
                                        <td data-label="Nominal">
                                            <div class="nominal-text">Rp <?= number_format($r['jumlah'], 0, ',', '.') ?></div>
                                        </td>
                                        <td data-label="Status">
                                            <?php
                                                $s = strtolower($r['status']);
                                                $bClass = 'badge-pending'; $bIcon = 'fa-clock';
                                                if($s == 'lunas') { $bClass = 'badge-lunas'; $bIcon = 'fa-check-circle'; }
                                                if($s == 'ditolak') { $bClass = 'badge-ditolak'; $bIcon = 'fa-times-circle'; }
                                                if($s == 'pending') { $bClass = 'badge-pending'; $bIcon = 'fa-hourglass-half'; }
                                            ?>
                                            <span class="badge <?= $bClass ?>"><i class="fas <?= $bIcon ?>"></i> <?= ucfirst(htmlspecialchars($r['status'])) ?></span>
                                        </td>
                                        <td data-label="Bukti / Aksi">
                                            <?php if($r['status'] == 'Lunas'): ?>
                                                <span style="color: var(--success); font-size: 0.75rem; font-weight: 600;"><i class="fas fa-check-circle"></i> Terverifikasi</span>
                                            <?php elseif($r['bukti_bayar']): ?>
                                                <span style="color: var(--info); font-size: 0.75rem; font-weight: 600;"><i class="fas fa-hourglass-half"></i> Menunggu Verifikasi</span>
                                            <?php else: ?>
                                                <button class="btn btn-primary btn-sm" onclick="openUploadModal(<?= $r['id'] ?>, '<?= htmlspecialchars($r['jenis_pembayaran']) ?>')">
                                                    <i class="fas fa-upload"></i> Unggah Bukti
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="text-align:center;padding:60px;color:var(--gray);">
                                        <div style="background: rgba(0,0,0,0.02); border-radius: 50%; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                            <i class="fas fa-money-check-dollar" style="font-size: 3rem; color: var(--light-gray);"></i>
                                        </div>
                                        <h3 style="margin-bottom: 8px; color: var(--dark); font-weight: 600;">Belum Ada Data Tagihan</h3>
                                        <p style="max-width: 300px; margin: 0 auto;">Tidak ada data tagihan yang ditemukan untuk putra-putri Anda.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- INFORMASI PEMBAYARAN -->
            <div class="section-card">
                <div class="card-header">
                    <div class="card-title">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(14,165,233,.1);color:var(--info);display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        Informasi Pembayaran
                    </div>
                </div>
                <div style="padding: 20px 24px;">
                    <p style="margin-bottom: 12px;"><strong>Nomor Rekening Pembayaran:</strong></p>
                    <ul style="margin-left: 20px; margin-bottom: 15px;">
                        <li>• <strong>Bank Syariah Indonesia (BSI)</strong> - 1234 5678 9012 a.n. Yayasan PTQ Pencongan</li>
                        <li>• <strong>Bank Mandiri</strong> - 9876 5432 1098 a.n. Yayasan PTQ Pencongan</li>
                    </ul>
                    <p style="margin-top: 15px; padding-top: 12px; border-top: 1px solid var(--light-gray); font-size: 0.85rem; color: var(--gray);">
                        <i class="fas fa-info-circle"></i> Catatan: Setelah melakukan transfer, unggah bukti pembayaran melalui tombol "Unggah Bukti". Pembayaran akan diverifikasi oleh admin dalam 1x24 jam.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL UPLOAD BUKTI -->
    <div class="modal-overlay" id="uploadModal">
        <form id="uploadForm" action="" method="post" enctype="multipart/form-data" class="modal-card">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h3 id="modalTitle"><i class="fas fa-upload"></i> Unggah Bukti Pembayaran</h3>
                <button type="button" class="btn-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="info-box">
                    <p><i class="fas fa-info-circle"></i> Instruksi:</p>
                    <p>Pastikan foto bukti transfer terlihat jelas mencantumkan:</p>
                    <ul style="margin-left: 20px; margin-top: 5px; font-size: 0.8rem;">
                        <li>• Nama pengirim</li>
                        <li>• Nominal transfer</li>
                        <li>• Tanggal transaksi</li>
                    </ul>
                </div>
                <div class="form-group">
                    <label class="form-label">Pilih Foto Bukti (JPG/PNG, Max 2MB)</label>
                    <input type="file" name="bukti_bayar" class="file-input" required accept="image/jpeg,image/png">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Unggah Bukti</button>
            </div>
        </form>
    </div>

    <script>
        // Sidebar toggle logic
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
        
        // User dropdown logic
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
        
        // Close sidebar when clicking on menu item (mobile)
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
        
        // Auto hide alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 400);
            }, 5000);
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
        
        // Modal functions
        const modal = document.getElementById('uploadModal');
        const form = document.getElementById('uploadForm');
        const modalTitle = document.getElementById('modalTitle');

        function openUploadModal(id, jenis) {
            modalTitle.innerHTML = '<i class="fas fa-upload"></i> Upload Bukti - ' + jenis;
            form.action = '<?= base_url('ortu/pembayaran/upload/') ?>' + id;
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