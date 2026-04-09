<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title><?= $judul ?> - PTQ Al-Hikmah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a5fb4; --primary-dark: #1c3d78; --secondary: #26a269;
            --accent: #e5a50a; --light: #f8f9fa; --dark: #2d3748;
            --gray: #718096; --light-gray: #e2e8f0; --danger: #e53e3e;
            --success: #38a169; --warning: #dd6b20; --info: #0ea5e9;
            --purple: #8b5cf6; --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --radius: 12px; --transition: all 0.3s ease;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f5f7fa; color: var(--dark); line-height: 1.6; }
        a { text-decoration: none; color: inherit; }
        
        /* HEADER/NAVBAR */
        .dashboard-header { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); padding: 0; position: sticky; top: 0; z-index: 1000; }
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 15px; }
        .header-content { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; }
        .logo-section { display: flex; align-items: center; gap: 15px; }
        .logo { display: flex; align-items: center; gap: 12px; padding: 8px 12px; border-radius: 8px; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); }
        .logo img { height: 36px; filter: brightness(0) invert(1); }
        .logo-text { font-size: 1.4rem; font-weight: 700; color: white; letter-spacing: 0.5px; }
        .logo-text span { color: var(--accent); }
        
        .mobile-menu-toggle { display: none; background: rgba(255, 255, 255, 0.15); border: none; color: white; font-size: 1.4rem; width: 44px; height: 44px; border-radius: 8px; cursor: pointer; transition: var(--transition); align-items: center; justify-content: center; }
        .mobile-menu-toggle:hover { background: rgba(255, 255, 255, 0.25); }
        
        .user-section { display: flex; align-items: center; gap: 15px; }
        .user-info { display: flex; align-items: center; gap: 12px; padding: 8px 16px; border-radius: 8px; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); color: white; cursor: pointer; }
        .user-avatar { width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, var(--purple) 0%, var(--info) 100%); display: flex; align-items: center; justify-content: center; font-weight: bold; }
        
        .user-dropdown { position: relative; }
        .dropdown-menu { position: absolute; top: 100%; right: 0; width: 200px; background: white; border-radius: 8px; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); margin-top: 10px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: var(--transition); z-index: 100; }
        .dropdown-menu.active { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; color: var(--dark); transition: var(--transition); border-bottom: 1px solid var(--light-gray); }
        .dropdown-item:last-child { border-bottom: none; }
        .dropdown-item:hover { background: var(--light); color: var(--primary); }
        .dropdown-item i { width: 20px; text-align: center; color: var(--gray); }
        .logout-btn { color: var(--danger); }
        .logout-btn:hover { background: rgba(229, 62, 62, 0.1); }

        /* LAYOUT */
        .dashboard-container { display: flex; min-height: calc(100vh - 68px); }
        .sidebar { width: 280px; background: linear-gradient(180deg, var(--primary-dark) 0%, #152a57 100%); color: white; padding: 20px 0; box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1); transition: var(--transition); position: relative; z-index: 99; }
        .sidebar-header { padding: 0 20px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 20px; }
        .sidebar-header .welcome-text { font-size: 0.9rem; opacity: 0.8; }
        .sidebar-header .admin-name { font-weight: 700; color: var(--accent); font-size: 1.1rem; }
        .sidebar-menu { padding: 0 15px; }
        .menu-item { margin-bottom: 5px; }
        .menu-item a { display: flex; align-items: center; padding: 14px 15px; border-radius: 8px; transition: var(--transition); opacity: 0.8; }
        .menu-item a:hover, .menu-item.active a { background: rgba(255, 255, 255, 0.1); opacity: 1; transform: translateX(5px); }
        .menu-item i { margin-right: 12px; width: 20px; text-align: center; }

        .dashboard-content { flex: 1; padding: 30px; background-color: #f5f7fa; overflow-y: auto; transition: var(--transition); }

        /* PAGE CONTENT STYLES */
        .page-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; flex-wrap: wrap; gap: 15px; }
        .header-title h1 { font-size: 1.8rem; color: var(--primary-dark); font-weight: 800; display: flex; align-items: center; gap: 12px; }
        .header-title p { color: var(--gray); font-size: 0.95rem; margin-top: 5px; }
        
        .btn-back { display: inline-flex; align-items: center; gap: 8px; background: white; padding: 10px 18px; border-radius: 8px; font-weight: 700; color: var(--gray); font-size: 0.85rem; box-shadow: var(--shadow); transition: var(--transition); border: none; cursor: pointer; }
        .btn-back:hover { color: var(--primary); transform: translateX(-5px); }

        .premium-card { background: white; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 30px; border: 1px solid var(--light-gray); }
        .premium-card-header { padding: 24px 30px; border-bottom: 1px solid var(--light-gray); background: white; display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .premium-card-header h3 { font-size: 1.2rem; font-weight: 800; color: var(--primary-dark); }
        .premium-card-header i { color: var(--primary); font-size: 1.3rem; }

        .detail-grid { display: grid; grid-template-columns: 1fr 350px; gap: 40px; padding: 30px; }
        .info-group { display: grid; grid-template-columns: 180px 1fr; gap: 20px; margin-bottom: 15px; }
        .info-label { color: var(--gray); font-weight: 600; font-size: 0.9rem; }
        .info-value { color: var(--dark); font-weight: 700; font-size: 0.95rem; }

        .arrears-summary { background: rgba(229, 62, 62, 0.05); border: 2px dashed rgba(229, 62, 62, 0.2); border-radius: 16px; padding: 30px; text-align: center; position: relative; }
        .arrears-label { font-size: 0.85rem; font-weight: 800; color: var(--danger); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .arrears-value { font-size: 2.2rem; font-weight: 900; color: var(--danger); margin-bottom: 15px; }
        .arrears-count { font-size: 0.85rem; color: var(--gray); font-weight: 600; }

        /* TABLE STYLES */
        .table-responsive { width: 100%; overflow-x: auto; padding: 0 30px 30px; }
        .history-table { width: 100%; border-collapse: collapse; }
        .history-table th { background: #f8fafc; padding: 18px 20px; text-align: left; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; color: var(--gray); border-bottom: 2px solid var(--light-gray); }
        .history-table td { padding: 20px; border-bottom: 1px solid var(--light-gray); }
        .history-table tr:hover { background: #f1f5f9; }

        /* MOBILE CARD STYLES FOR HISTORY */
        .history-cards-container {
            display: none;
            gap: 16px;
            flex-direction: column;
            padding: 20px;
        }
        
        .history-card {
            background: white;
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid var(--light-gray);
            overflow: hidden;
            transition: var(--transition);
        }
        
        .history-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }
        
        .history-card-header {
            padding: 16px;
            background: linear-gradient(135deg, var(--primary-light, #e8f0fe) 0%, #f8fafc 100%);
            border-bottom: 1px solid var(--light-gray);
        }
        
        .history-card-period {
            font-weight: 800;
            font-size: 1rem;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .history-card-body {
            padding: 16px;
        }
        
        .history-card-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .history-card-row:last-child {
            border-bottom: none;
        }
        
        .history-card-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .history-card-value {
            font-weight: 700;
            font-size: 0.95rem;
            text-align: right;
        }
        
        .history-card-amount {
            font-size: 1.1rem;
            color: var(--primary);
        }
        
        .history-card-footer {
            padding: 16px;
            background: var(--light);
            border-top: 1px solid var(--light-gray);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .nominal { font-weight: 800; color: var(--dark); font-size: 0.95rem; }
        .badge { padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 800; display: inline-flex; align-items: center; gap: 6px; }
        .badge-lunas { background: rgba(38, 162, 105, 0.1); color: var(--success); }
        .badge-pending { background: rgba(221, 107, 32, 0.1); color: var(--warning); }
        .conf-date { display: block; font-size: 0.7rem; opacity: 0.7; margin-top: 4px; font-weight: 600; }

        .action-cell { display: flex; gap: 8px; }
        .btn-action { width: 38px; height: 38px; border-radius: 10px; border: none; display: flex; align-items: center; justify-content: center; font-size: 1rem; cursor: pointer; transition: var(--transition); color: white; }
        .btn-lunas { background: var(--primary); }
        .btn-lunas:hover { background: var(--primary-dark); transform: scale(1.1); }
        .btn-hapus { background: var(--danger); }
        .btn-hapus:hover { background: #c53030; transform: scale(1.1); }
        .btn-bukti { background: #f1f5f9; color: var(--primary); border: 1px solid var(--primary); display: inline-flex; align-items: center; gap: 8px; padding: 0 15px; font-weight: 700; font-size: 0.8rem; width: auto; height: 38px; border-radius: 10px; cursor: pointer; transition: var(--transition); }
        .btn-bukti:hover { background: var(--primary); color: white; }
        .btn-card-action { background: var(--primary); color: white; border: none; border-radius: 8px; padding: 10px 16px; font-weight: 700; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; transition: var(--transition); }
        .btn-card-action:hover { background: var(--primary-dark); transform: translateY(-2px); }
        .btn-card-danger { background: var(--danger); }
        .btn-card-danger:hover { background: #c53030; }

        .alert { padding: 15px 20px; border-radius: var(--radius); margin-bottom: 25px; display: flex; align-items: center; gap: 12px; font-weight: 600; }
        .alert-success { background: rgba(38, 162, 105, 0.1); color: #1e8555; border: 1px solid rgba(38, 162, 105, 0.2); border-left: 5px solid var(--success); }
        .alert-error { background: rgba(229, 62, 62, 0.1); color: #c53030; border: 1px solid rgba(229, 62, 62, 0.2); border-left: 5px solid var(--danger); }

        /* MODAL */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 2000; display: none; align-items: center; justify-content: center; padding: 20px; }
        .modal-overlay.active { display: flex; }
        .modal-close { position: absolute; top: 20px; right: 20px; color: white; font-size: 2rem; cursor: pointer; transition: var(--transition); }
        .modal-close:hover { transform: scale(1.1); }
        .modal-image { max-width: 100%; max-height: 90vh; border-radius: 12px; box-shadow: 0 0 50px rgba(0,0,0,0.5); }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .detail-grid { grid-template-columns: 1fr; gap: 20px; padding: 20px; }
            .mobile-menu-toggle { display: flex; }
            .dashboard-container { position: relative; }
            .sidebar { position: absolute; left: -280px; height: 100%; z-index: 1000; }
            .sidebar.active { left: 0; }
            .user-info span { display: none; }
        }

        @media (max-width: 768px) {
            .dashboard-content { padding: 15px; }
            .page-header { flex-direction: column; align-items: flex-start; }
            .header-title h1 { font-size: 1.4rem; }
            .premium-card-header { padding: 16px 20px; }
            .premium-card-header h3 { font-size: 1rem; }
            
            /* Hide table on mobile */
            .table-responsive {
                display: none;
            }
            
            /* Show cards on mobile */
            .history-cards-container {
                display: flex;
            }
            
            .arrears-value { font-size: 1.5rem; }
            .arrears-summary { padding: 20px; }
        }

        @media (max-width: 480px) {
            .history-card-footer { flex-direction: column; }
            .history-card-footer .btn-card-action { width: 100%; justify-content: center; }
            .info-group { grid-template-columns: 1fr; gap: 5px; }
            .info-label { font-size: 0.75rem; }
        }
    </style>
</head>
<body>

    <header class="dashboard-header">
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <button class="mobile-menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <a href="<?= base_url('admin/dashboard') ?>" class="logo">
                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PHBhdGggZD0iTTEyIDJMMiA3bDEwIDUgMTAtNS0xMC01eiI+PC9wYXRoPjxwYXRoIGQ9Ik0yIDE3bDEwIDUgMTAtNSI+PC9wYXRoPjxwYXRoIGQ9Ik0yIDEybDEwIDUgMTAtNSI+PC9wYXRoPjwvc3ZnPg==" alt="Logo">
                        <div class="logo-text">PTQ <span>Al-Hikmah</span></div>
                    </a>
                </div>
                <div class="user-section">
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
                            <span><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Administrator') ?></span>
                            <i class="fas fa-chevron-down" style="font-size: 0.7rem;"></i>
                        </div>
                        <div class="dropdown-menu" id="userDropdown">
                            <a href="<?= base_url('auth/logout') ?>" class="dropdown-item logout-btn"><i class="fas fa-sign-out-alt"></i><span>Keluar</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="welcome-text">Selamat Datang,</div>
                <div class="admin-name"><?= htmlspecialchars($nama_admin ?? session()->get('nama_lengkap') ?? 'Administrator') ?></div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/santri') ?>"><i class="fas fa-user-graduate"></i><span>Data Santri</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('admin/pembayaran') ?>"><i class="fas fa-wallet"></i><span>Keuangan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pengumuman') ?>"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></div>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="page-header">
                <div class="header-title">
                    <h1><i class="fas fa-file-invoice-dollar"></i> Detail Kelola Pembayaran</h1>
                    <p>Rincian SPP untuk Santri: <strong><?= htmlspecialchars($santri['nama_santri']) ?></strong></p>
                </div>
                <a href="<?= base_url('admin/pembayaran') ?>" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>

            <!-- ALERTS -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="premium-card">
                <div class="premium-card-header">
                    <i class="fas fa-user-check"></i>
                    <h3>Data Santri & Wali</h3>
                </div>
                <div class="detail-grid">
                    <div class="profile-info">
                        <div class="info-group">
                            <span class="info-label">Nama Santri</span>
                            <span class="info-value">: <?= htmlspecialchars($santri['nama_santri']) ?></span>
                        </div>
                        <div class="info-group">
                            <span class="info-label">NIS</span>
                            <span class="info-value">: <?= htmlspecialchars($santri['nis'] ?? '-') ?></span>
                        </div>
                        <div class="info-group">
                            <span class="info-label">Kelas</span>
                            <span class="info-value">: <?= htmlspecialchars($santri['nama_kelas'] ?? '-') ?></span>
                        </div>
                        <div class="info-group">
                            <span class="info-label">Nama Orang Tua</span>
                            <span class="info-value">: <?= htmlspecialchars($santri['nama_ayah'] ?? $santri['nama_ibu'] ?? '-') ?></span>
                        </div>
                        <div class="info-group">
                            <span class="info-label">No. WA/HP</span>
                            <span class="info-value" style="color:var(--success);">: <i class="fab fa-whatsapp"></i> <?= htmlspecialchars($santri['no_telepon_ayah'] ?? $santri['no_telepon_ibu'] ?? '-') ?></span>
                        </div>
                    </div>

                    <div class="arrears-summary">
                        <div class="arrears-label"><i class="fas fa-info-circle"></i> Ringkasan Tunggakan</div>
                        <div class="arrears-value">Rp <?= number_format($unpaid_sum ?? 0, 0, ',', '.') ?></div>
                        <div class="arrears-count">Total tertunggak sebanyak <?= $unpaid_count ?? 0 ?> Minggu</div>
                    </div>
                </div>
            </div>

            <div class="premium-card">
                <div class="premium-card-header">
                    <i class="fas fa-history"></i>
                    <h3>Riwayat Tagihan Mingguan</h3>
                </div>
                
                <!-- TABLE VIEW (Desktop) -->
                <div class="table-responsive">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Periode (Minggu)</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Bukti Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($history)): ?>
                                <?php foreach($history as $h): ?>
                                    <tr>
                                        <td><strong><?= htmlspecialchars($h['jenis_pembayaran']) ?></strong></td>
                                        <td><span class="nominal">Rp <?= number_format($h['jumlah'], 0, ',', '.') ?></span></td>
                                        <td>
                                            <?php if($h['status'] == 'Lunas'): ?>
                                                <span class="badge badge-lunas">
                                                    <i class="fas fa-check-circle"></i> Lunas
                                                </span>
                                                <span class="conf-date">Dikonfirmasi: <?= date('d/m/Y H:i', strtotime($h['tanggal_bayar'] ?? $h['updated_at'])) ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-pending">
                                                    <i class="fas fa-clock"></i> Belum Bayar
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($h['bukti_bayar']): ?>
                                                <button class="btn-bukti" onclick="viewProof('<?= $h['bukti_bayar'] ?>')">
                                                    <i class="fas fa-image"></i> Lihat Bukti
                                                </button>
                                            <?php else: ?>
                                                <span style="color:var(--gray); font-style:italic; font-size:0.8rem;">Belum ada file</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="action-cell">
                                                <?php if($h['status'] != 'Lunas'): ?>
                                                    <a href="<?= base_url('admin/pembayaran/verifikasi/' . $h['id'] . '?return_to=' . urlencode(current_url())) ?>" class="btn-action btn-lunas" title="Tandai Lunas" onclick="return confirm('Tandai tagihan ini sebagai LUNAS?')">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <a href="<?= base_url('admin/pembayaran/delete/' . $h['id'] . '?return_to=' . urlencode(current_url())) ?>" class="btn-action btn-hapus" onclick="return confirm('Yakin ingin menghapus tagihan ini?')" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align:center; padding:40px; color:var(--gray);">Belum ada riwayat tagihan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- CARD VIEW (Mobile) -->
                <div class="history-cards-container" id="historyCardsContainer">
                    <?php if(!empty($history)): ?>
                        <?php foreach($history as $h): ?>
                            <div class="history-card">
                                <div class="history-card-header">
                                    <div class="history-card-period">
                                        <i class="fas fa-calendar-week"></i>
                                        <?= htmlspecialchars($h['jenis_pembayaran']) ?>
                                    </div>
                                </div>
                                <div class="history-card-body">
                                    <div class="history-card-row">
                                        <span class="history-card-label">Nominal</span>
                                        <span class="history-card-value history-card-amount">Rp <?= number_format($h['jumlah'], 0, ',', '.') ?></span>
                                    </div>
                                    <div class="history-card-row">
                                        <span class="history-card-label">Status</span>
                                        <span class="history-card-value">
                                            <?php if($h['status'] == 'Lunas'): ?>
                                                <span class="badge badge-lunas">
                                                    <i class="fas fa-check-circle"></i> Lunas
                                                </span>
                                            <?php else: ?>
                                                <span class="badge badge-pending">
                                                    <i class="fas fa-clock"></i> Belum Bayar
                                                </span>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    <?php if($h['status'] == 'Lunas' && ($h['tanggal_bayar'] ?? $h['updated_at'])): ?>
                                    <div class="history-card-row">
                                        <span class="history-card-label">Dikonfirmasi</span>
                                        <span class="history-card-value"><?= date('d/m/Y H:i', strtotime($h['tanggal_bayar'] ?? $h['updated_at'])) ?></span>
                                    </div>
                                    <?php endif; ?>
                                    <div class="history-card-row">
                                        <span class="history-card-label">Bukti Upload</span>
                                        <span class="history-card-value">
                                            <?php if($h['bukti_bayar']): ?>
                                                <button class="btn-bukti" onclick="viewProof('<?= $h['bukti_bayar'] ?>')" style="padding: 6px 12px; height: auto;">
                                                    <i class="fas fa-image"></i> Lihat Bukti
                                                </button>
                                            <?php else: ?>
                                                <span style="color:var(--gray); font-style:italic;">Tidak ada</span>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="history-card-footer">
                                    <?php if($h['status'] != 'Lunas'): ?>
                                        <a href="<?= base_url('admin/pembayaran/verifikasi/' . $h['id'] . '?return_to=' . urlencode(current_url())) ?>" class="btn-card-action" onclick="return confirm('Tandai tagihan ini sebagai LUNAS?')">
                                            <i class="fas fa-check"></i> Tandai Lunas
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('admin/pembayaran/delete/' . $h['id'] . '?return_to=' . urlencode(current_url())) ?>" class="btn-card-action btn-card-danger" onclick="return confirm('Yakin ingin menghapus tagihan ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="text-align:center; padding:40px; color:var(--gray); background:white; border-radius:12px;">
                            <i class="fas fa-inbox" style="font-size:3rem; margin-bottom:10px; opacity:0.5;"></i>
                            <p>Belum ada riwayat tagihan.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL VIEW BUKTI -->
    <div class="modal-overlay" id="proofModal">
        <i class="fas fa-times modal-close" onclick="document.getElementById('proofModal').classList.remove('active')"></i>
        <img src="" id="proofImage" class="modal-image">
    </div>

    <script>
        // Sidebar & UI Logic
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');

        if(menuToggle) {
            menuToggle.onclick = () => sidebar.classList.toggle('active');
        }
        
        if(userDropdownToggle) {
            userDropdownToggle.onclick = (e) => { 
                e.stopPropagation(); 
                if(userDropdown) userDropdown.classList.toggle('active');
            }
        }
        
        window.onclick = (e) => {
            if(userDropdown && !userDropdown.contains(e.target) && !userDropdownToggle?.contains(e.target)) {
                userDropdown.classList.remove('active');
            }
        }

        function viewProof(filename) {
            const modal = document.getElementById('proofModal');
            const img = document.getElementById('proofImage');
            img.src = '<?= base_url('uploads/bukti_bayar/') ?>' + filename;
            modal.classList.add('active');
        }
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if(e.key === 'Escape') {
                document.getElementById('proofModal').classList.remove('active');
            }
        });
    </script>
</body>
</html>