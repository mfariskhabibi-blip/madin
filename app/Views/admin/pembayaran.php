<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan & SPP - PTQ Al-Hikmah</title>
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
        .card-header { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); gap: 10px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); display: flex; align-items: center; gap: 10px; }
        
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 6px; font-weight: 600; font-size: .85rem; cursor: pointer; transition: .2s; border: none; outline: none; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }
        
        .table-responsive { overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { text-align: left; padding: 12px 24px; background: var(--light); font-size: .75rem; text-transform: uppercase; letter-spacing: .5px; color: var(--gray); font-weight: 700; border-bottom: 1px solid var(--light-gray); }
        .table td { padding: 14px 24px; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
        .table tr:hover { background: #f8fafc; }

        .s-name { font-weight: 600; font-size: .95rem; color: var(--dark); }
        .s-info { font-size: .75rem; color: var(--gray); margin-top:2px; display:flex; gap:10px;}
        .nominal { font-weight: 700; color: var(--success); font-size: 1rem; }
        .jenis-tagihan { font-size: .85rem; color: var(--dark); font-weight: 600; }

        .badge { padding: 6px 12px; border-radius: 20px; font-size: .75rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; }
        .badge-pending { background: rgba(221,107,32,.1); color: var(--warning); }
        .badge-lunas { background: rgba(38,162,105,.1); color: var(--success); }
        .badge-ditolak { background: rgba(229,62,62,.1); color: var(--danger); }

        .action-cell { display: flex; gap: 6px; }
        .act-btn { width: 32px; height: 32px; border-radius: 8px; border: none; display: flex; align-items: center; justify-content: center; font-size: .85rem; cursor: pointer; transition: .2s; color: #fff; }
        .act-edit { background: var(--primary); }
        .act-edit:hover { background: var(--primary-dark); }
        .act-info { background: var(--info); }
        .act-info:hover { background: #0c8ec4; }
        .act-verify { background: var(--success); }
        .act-verify:hover { background: #2f855a; }
        .act-delete { background: var(--danger); }
        .act-delete:hover { background: #c53030; }

        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); }
        .alert-error { background: rgba(229,62,62,.1); color: #c53030; border: 1px solid rgba(229,62,62,.2); }

        /* MODAL STYLES */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,.5); z-index: 1000; display: none; align-items: center; justify-content: center; overflow-y:auto; padding:20px; }
        .modal-overlay.active { display: flex; }
        .modal-card { background: #fff; width: 100%; max-width: 500px; border-radius: var(--radius); box-shadow: 0 10px 30px rgba(0,0,0,.2); animation: slideUp .3s ease; }
        @keyframes slideUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }
        .modal-head { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); }
        .btn-close { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: var(--gray); }
        .modal-body { padding: 24px; }
        .form-group { margin-bottom: 15px; }
        .form-row { display: flex; gap: 15px; }
        .form-row .form-group { flex: 1; }
        .form-label { display: block; font-size: .85rem; font-weight: 600; color: var(--dark); margin-bottom: 8px; }
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid var(--light-gray); border-radius: 6px; font-size: .9rem; outline: none; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,95,180,.15); }
        .modal-foot { padding: 16px 24px; background: var(--light); border-top: 1px solid var(--light-gray); display: flex; justify-content: flex-end; gap: 10px; }

        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; }
        
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
            .table td { display: flex; flex-direction:column; padding: 10px 0; border-bottom: 1px dashed var(--light-gray); text-align: left; }
            .table td:last-child { border-bottom: none; }
            .table td::before { content: attr(data-label); font-weight: 600; color: var(--gray); font-size: .75rem; text-transform: uppercase; margin-bottom:5px; }
            .action-cell { flex-direction: row; margin-top:5px; }
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
                <div class="menu-item active"><a href="<?= base_url('admin/pembayaran') ?>"><i class="fas fa-money-bill-wave"></i><span>Keuangan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pengumuman') ?>"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></div>
            </div>
        </div>

    <!-- CONTENT -->
    <div class="dashboard-content" id="mainContent">
        <h1 class="page-title"><i class="fas fa-money-bill-wave"></i> Manajemen Keuangan & SPP</h1>

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

        <div class="section-card">
            <div class="card-header">
                <div class="card-title">
                    <div style="width:36px;height:36px;border-radius:8px;background:rgba(26,95,180,.1);color:var(--primary);display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-receipt"></i>
                    </div>
                    Rekapitulasi Transaksi
                </div>
                <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('active')">
                    <i class="fas fa-plus"></i> Tambah Tagihan / Bayar
                </button>
            </div>
            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Profil Santri</th>
                            <th>Detail Tagihan</th>
                            <th>Nominal</th>
                            <th>Status & Tgl Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($riwayat)): ?>
                            <?php foreach($riwayat as $r): ?>
                                <tr>
                                    <td data-label="Santri">
                                        <div class="s-name"><?= htmlspecialchars($r['nama_santri']) ?></div>
                                        <div class="s-info">NIS: <?= htmlspecialchars($r['nis'] ?? '-') ?></div>
                                    </td>
                                    <td data-label="Detail Tagihan">
                                        <div class="jenis-tagihan"><?= htmlspecialchars($r['jenis_pembayaran']) ?></div>
                                        <div style="font-size:.8rem; color:var(--gray);"><?= htmlspecialchars($r['keterangan'] ?? '-') ?></div>
                                    </td>
                                    <td data-label="Nominal">
                                        <div class="nominal">Rp <?= number_format($r['jumlah'], 0, ',', '.') ?></div>
                                    </td>
                                    <td data-label="Status & Tgl">
                                        <?php
                                            $bClass = 'badge-pending';
                                            $bIcon = 'fa-clock';
                                            if($r['status'] == 'Lunas') { $bClass = 'badge-lunas'; $bIcon = 'fa-check'; }
                                            if($r['status'] == 'Ditolak') { $bClass = 'badge-ditolak'; $bIcon = 'fa-times'; }
                                        ?>
                                        <div style="margin-bottom:6px;"><span class="badge <?= $bClass ?>"><i class="fas <?= $bIcon ?>"></i> <?= htmlspecialchars($r['status']) ?></span></div>
                                        <?php if($r['tanggal_bayar']): ?>
                                            <span style="font-size: .8rem; color:var(--gray);"><i class="fas fa-calendar-check"></i> <?= date('d M Y', strtotime($r['tanggal_bayar'])) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Aksi">
                                        <div class="action-cell">
                                            <button class="act-btn act-info" onclick="openDetailModal(<?= htmlspecialchars(json_encode($r)) ?>)" title="Lihat Detail Ikhtisar">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <?php if($r['status'] == 'Pending'): ?>
                                                <a href="<?= base_url('admin/pembayaran/verifikasi/' . $r['id']) ?>" class="act-btn act-verify" onclick="return confirm('Tandai tagihan ini sebagai LUNAS?')" title="Verifikasi Cepat">
                                                    <i class="fas fa-check-double"></i>
                                                </a>
                                            <?php endif; ?>
                                            <button class="act-btn act-edit" onclick="openEditModal(<?= htmlspecialchars(json_encode($r)) ?>)" title="Ubah Manual">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <a href="<?= base_url('admin/pembayaran/delete/' . $r['id']) ?>" class="act-btn act-delete" onclick="return confirm('Hapus permanen invoice pembayaran ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align:center;padding:40px;color:var(--gray);">
                                    <i class="fas fa-file-invoice-dollar" style="font-size:3rem;margin-bottom:15px;color:var(--light-gray);"></i>
                                    <p>Belum ada data tagihan atau pembayaran masuk.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- /CONTENT -->
    </div>

    <!-- MODAL TAMBAH PEMBAYARAN -->
    <div class="modal-overlay" id="addModal">
        <form action="<?= base_url('admin/pembayaran/store') ?>" method="post" class="modal-card">
            <?= csrf_field() ?>
            <div class="modal-head">
                <h3>Buat Tagihan / Catat Pembayaran</h3>
                <button type="button" class="btn-close" onclick="document.getElementById('addModal').classList.remove('active')"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Santri Target *</label>
                    <select name="id_santri" class="form-control" required>
                        <option value="">-- Pilih Santri --</option>
                        <?php foreach($santriList as $s): ?>
                            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['nama_santri']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Tagihan/Pembayaran *</label>
                    <input type="text" name="jenis_pembayaran" class="form-control" required placeholder="Contoh: SPP Bulan Juli 2026">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nominal / Jumlah (Rp) *</label>
                        <input type="number" name="jumlah" class="form-control" required min="1000">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="Pending">Pending (Tagihan Baru)</option>
                            <option value="Lunas">Lunas (Sudah Dibayar)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Bayar</label>
                        <input type="date" name="tanggal_bayar" class="form-control">
                        <small style="color:var(--gray); font-size:0.75rem;">(Kosongkan jika Pending)</small>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Keterangan / Pesan Tambahan</label>
                    <textarea name="keterangan" class="form-control" rows="2" placeholder="Via Transfer Bank BSI, Tunai, dsb..."></textarea>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn btn-outline" style="border:none;background:transparent;" onclick="document.getElementById('addModal').classList.remove('active')">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Transaksi</button>
            </div>
        </form>
    </div>

    <!-- MODAL DETAIL PEMBAYARAN -->
    <div class="modal-overlay" id="detailModal">
        <div class="modal-card">
            <div class="modal-head">
                <h3>Detail Transaksi & Bukti</h3>
                <button type="button" class="btn-close" onclick="document.getElementById('detailModal').classList.remove('active')"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body" style="background:#fcfcfc;">
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px; margin-bottom:20px;">
                    <div>
                        <label class="form-label" style="opacity:0.6; margin-bottom:2px;">Santri</label>
                        <p id="det_nama" style="font-weight:700; color:var(--primary-dark);"></p>
                        <p id="det_nis" style="font-size:0.8rem; color:var(--gray);"></p>
                    </div>
                    <div>
                        <label class="form-label" style="opacity:0.6; margin-bottom:2px;">Status</label>
                        <div id="det_status"></div>
                    </div>
                </div>

                <div style="background:white; border:1px solid var(--light-gray); border-radius:10px; padding:15px; margin-bottom:20px;">
                    <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                        <span style="color:var(--gray);">Jenis:</span>
                        <span id="det_jenis" style="font-weight:600;"></span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                        <span style="color:var(--gray);">Nominal:</span>
                        <span id="det_jumlah" style="font-weight:700; color:var(--success); font-size:1.1rem;"></span>
                    </div>
                    <div style="display:flex; justify-content:space-between;">
                        <span style="color:var(--gray);">Tgl Bayar:</span>
                        <span id="det_tgl" style="font-weight:600;"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Bukti Pembayaran (Transfer/Struk):</label>
                    <div id="bukti_container" style="width:100%; border-radius:12px; border:2px dashed var(--light-gray); min-height:150px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                        <!-- Image populated by JS -->
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Keterangan Tambahan:</label>
                    <div id="det_ket" style="padding:12px; background:var(--light); border-radius:8px; font-size:0.9rem; color:var(--dark); min-height:50px;"></div>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn btn-secondary" onclick="document.getElementById('detailModal').classList.remove('active')">Tutup</button>
                <div id="det_verify_action"></div>
            </div>
        </div>
    </div>
    <div class="modal-overlay" id="editModal">
        <form id="editForm" method="post" class="modal-card">
            <?= csrf_field() ?>
            <div class="modal-head">
                <h3>Ubah / Verifikasi Pembayaran</h3>
                <button type="button" class="btn-close" onclick="document.getElementById('editModal').classList.remove('active')"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group" style="padding:10px; background:var(--light); border-radius:6px; margin-bottom:15px;">
                    <div style="font-size:.8rem; color:var(--gray);">Tagihan Milik Santri:</div>
                    <div id="edit_nama_santri" style="font-weight:bold; color:var(--dark);"></div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Jenis Tagihan/Pembayaran *</label>
                    <input type="text" name="jenis_pembayaran" id="edit_jenis" class="form-control" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nominal (Rp) *</label>
                        <input type="number" name="jumlah" id="edit_jumlah" class="form-control" required min="0">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Status Transaksi *</label>
                        <select name="status" id="edit_status" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Lunas">Lunas</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Pembayaran</label>
                        <input type="date" name="tanggal_bayar" id="edit_tanggal" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Keterangan Tambahan</label>
                    <textarea name="keterangan" id="edit_ket" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn btn-outline" style="border:none;background:transparent;" onclick="document.getElementById('editModal').classList.remove('active')">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Perbarui Status</button>
            </div>
        </form>
    </div>

<script>
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
        document.getElementById('edit_nama_santri').innerText = d.nama_santri || '';
        document.getElementById('edit_jenis').value = d.jenis_pembayaran || '';
        document.getElementById('edit_jumlah').value = d.jumlah || 0;
        document.getElementById('edit_status').value = d.status || 'Pending';
        document.getElementById('edit_tanggal').value = d.tanggal_bayar || '';
        document.getElementById('edit_ket').value = d.keterangan || '';
        document.getElementById('editForm').action = '<?= base_url("admin/pembayaran/update/") ?>' + d.id;
        document.getElementById('editModal').classList.add('active');
    }

    function openDetailModal(d) {
        document.getElementById('det_nama').innerText = d.nama_santri;
        document.getElementById('det_nis').innerText = 'NIS: ' + (d.nis || '-');
        document.getElementById('det_jenis').innerText = d.jenis_pembayaran;
        document.getElementById('det_jumlah').innerText = 'Rp ' + new Number(d.jumlah).toLocaleString('id-ID');
        document.getElementById('det_tgl').innerText = d.tanggal_bayar ? d.tanggal_bayar : 'Belum Bayar';
        document.getElementById('det_ket').innerText = d.keterangan || 'Tidak ada catatan tambahan.';
        
        // Status Badge
        const st = d.status || 'Pending';
        let bClass = 'badge-pending';
        if(st === 'Lunas') bClass = 'badge-lunas';
        if(st === 'Ditolak') bClass = 'badge-ditolak';
        document.getElementById('det_status').innerHTML = `<span class="badge ${bClass}">${st}</span>`;

        // Bukti Image
        const container = document.getElementById('bukti_container');
        if(d.bukti_bayar) {
            container.innerHTML = `<img src="<?= base_url('uploads/bukti_bayar/') ?>/${d.bukti_bayar}" style="max-width:100%; height:auto;" alt="Bukti Transfer">`;
        } else {
            container.innerHTML = `<div style="text-align:center; padding:20px; color:var(--gray);"><i class="fas fa-image-slash" style="font-size:2rem; margin-bottom:10px;"></i><br>Belum ada bukti yang diunggah</div>`;
        }

        // Action Verify in Modal
        const actionArea = document.getElementById('det_verify_action');
        if(st === 'Pending') {
            actionArea.innerHTML = `<a href="<?= base_url('admin/pembayaran/verifikasi/') ?>/${d.id}" class="btn btn-primary" onclick="return confirm('Verifikasi pembayaran ini?')"><i class="fas fa-check"></i> Verifikasi Sekarang</a>`;
        } else {
            actionArea.innerHTML = '';
        }

        document.getElementById('detailModal').classList.add('active');
    }
</script>
</body>
</html>
