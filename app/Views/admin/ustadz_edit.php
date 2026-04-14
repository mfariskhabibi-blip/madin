<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Ustadz - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET */
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
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 0; position: sticky; top: 0; z-index: 1000;
        }
        .header-content { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; }
        .logo-section { display: flex; align-items: center; gap: 15px; }
        .logo { display: flex; align-items: center; gap: 12px; padding: 8px 12px; border-radius: var(--radius); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); }
        .logo img { height: 36px; border-radius: 6px; }
        .logo-text { font-size: 1.4rem; font-weight: 700; color: white; letter-spacing: 0.5px; }
        .logo-text span { color: var(--accent); }
        
        .mobile-menu-toggle {
            display: none; background: rgba(255, 255, 255, 0.15); border: none; color: white; font-size: 1.4rem;
            width: 44px; height: 44px; border-radius: var(--radius); cursor: pointer; transition: var(--transition);
            align-items: center; justify-content: center;
        }
        .mobile-menu-toggle:hover { background: rgba(255, 255, 255, 0.25); }
        
        .user-section { display: flex; align-items: center; gap: 15px; }
        .notification-bell {
            position: relative; background: rgba(255, 255, 255, 0.15); width: 44px; height: 44px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; transition: var(--transition);
        }
        .notification-bell:hover { background: rgba(255, 255, 255, 0.25); }
        .notification-badge {
            position: absolute; top: -2px; right: -2px; background: var(--accent); color: white; font-size: 0.7rem;
            width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;
        }
        
        .user-info {
            display: flex; align-items: center; gap: 12px; padding: 8px 16px; border-radius: var(--radius);
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); transition: var(--transition); cursor: pointer;
        }
        .user-info:hover { background: rgba(255, 255, 255, 0.2); }
        .user-avatar {
            width: 42px; height: 42px; border-radius: 50%; overflow: hidden; background: linear-gradient(135deg, var(--purple) 0%, var(--info) 100%);
            color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.1rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        .user-details { color: white; }
        .user-name { font-weight: 600; font-size: 0.95rem; }
        .user-role { font-size: 0.8rem; opacity: 0.9; }
        
        .user-dropdown { position: relative; }
        .dropdown-menu {
            position: absolute; top: 100%; right: 0; width: 200px; background: white; border-radius: var(--radius);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); margin-top: 10px; opacity: 0; visibility: hidden;
            transform: translateY(-10px); transition: var(--transition); z-index: 100;
        }
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
        .sidebar {
            width: 280px; background: linear-gradient(180deg, var(--primary-dark) 0%, #152a57 100%); color: white;
            padding: 20px 0; transition: var(--transition); position: relative; z-index: 99; box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar-header { padding: 0 20px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 20px; }
        .welcome-text { font-size: 1.1rem; margin-bottom: 5px; opacity: 0.9; }
        .admin-name { font-weight: 700; font-size: 1.2rem; color: var(--accent); }
        .sidebar-menu { padding: 0 15px; }
        .menu-item { margin-bottom: 5px; }
        .menu-item a { display: flex; align-items: center; padding: 14px 15px; border-radius: var(--radius); transition: var(--transition); }
        .menu-item a:hover, .menu-item.active a { background: rgba(255, 255, 255, 0.1); transform: translateX(5px); }
        .menu-item i { margin-right: 12px; width: 20px; text-align: center; font-size: 1.1rem; }
        
        .dashboard-content { flex: 1; padding: 30px; background-color: #f5f7fa; overflow-y: auto; transition: var(--transition); }

        /* TOP NAV & BACK BUTTON */
        .top-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .btn-back { display: inline-flex; align-items: center; gap: 8px; background: white; padding: 10px 20px; border-radius: 8px; color: var(--gray); font-weight: 600; font-size: 0.85rem; box-shadow: var(--shadow); transition: var(--transition); }
        .btn-back:hover { color: var(--primary); transform: translateX(-5px); }

        /* PAGE HEADER CARD */
        .page-header-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 12px; padding: 35px 40px; color: white; margin-bottom: 30px;
            display: flex; align-items: center; gap: 25px;
            box-shadow: 0 10px 25px rgba(26, 95, 180, 0.2);
            position: relative; overflow: hidden;
        }
        .page-header-card::before {
            content: ''; position: absolute; top: -50%; right: -10%; width: 300px; height: 300px;
            background: rgba(255,255,255,0.05); border-radius: 50%;
        }
        .header-icon {
            width: 80px; height: 80px; border-radius: 50%; background: rgba(255,255,255,0.15);
            display: flex; align-items: center; justify-content: center; font-size: 2rem;
            border: 3px solid rgba(255,255,255,0.2); flex-shrink: 0; backdrop-filter: blur(10px);
        }
        .header-text h1 { font-size: 1.8rem; font-weight: 700; margin-bottom: 6px; }
        .header-text p { opacity: 0.85; font-size: 0.95rem; }

        /* FORM CARD */
        .form-card { background: white; border-radius: 12px; box-shadow: var(--shadow); overflow: hidden; margin-bottom: 25px; }
        .form-card-header { 
            padding: 20px 28px; border-bottom: 1px solid var(--light-gray); 
            display: flex; align-items: center; gap: 12px;
        }
        .form-card-header .icon-box {
            width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; flex-shrink: 0;
        }
        .form-card-header h3 { font-size: 1.05rem; font-weight: 700; color: var(--primary-dark); }
        .form-card-header p { font-size: 0.8rem; color: var(--gray); margin-top: 2px; }

        .form-card-body { padding: 28px; }

        /* FORM GRID */
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 22px; }
        .form-grid .form-group.full-width { grid-column: 1 / -1; }

        .form-group { margin-bottom: 0; }
        .form-label { 
            display: flex; align-items: center; gap: 8px;
            font-size: 0.85rem; font-weight: 600; color: var(--dark); margin-bottom: 8px;
        }
        .form-label i { color: var(--primary); font-size: 0.8rem; }
        .form-label .required { color: var(--danger); margin-left: 2px; }

        .form-control {
            width: 100%; padding: 12px 16px; border: 2px solid var(--light-gray); border-radius: 10px;
            font-size: 0.9rem; color: var(--dark); outline: none; transition: var(--transition);
            background: #fafbfc;
        }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(26,95,180,.1); background: white; }
        .form-control::placeholder { color: #a0aec0; }
        .form-control:disabled { background: #edf2f7; color: var(--gray); cursor: not-allowed; }

        select.form-control { 
            appearance: none; 
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23718096' d='M6 8.825L.575 3.4l.85-.85L6 7.125 10.575 2.55l.85.85z'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;
        }

        textarea.form-control { min-height: 100px; resize: vertical; }

        /* FORM ACTIONS */
        .form-actions {
            display: flex; justify-content: flex-end; gap: 12px; padding: 20px 28px;
            background: var(--light); border-top: 1px solid var(--light-gray);
        }
        .btn { 
            display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; 
            border-radius: 10px; font-weight: 600; font-size: 0.9rem; cursor: pointer; 
            transition: var(--transition); border: none; 
        }
        .btn-primary { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); color: #fff; box-shadow: 0 4px 12px rgba(26,95,180,0.3); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(26,95,180,0.4); }
        .btn-secondary { background: white; color: var(--gray); border: 2px solid var(--light-gray); }
        .btn-secondary:hover { background: var(--light); color: var(--dark); border-color: #cbd5e0; }

        /* ALERT */
        .alert { padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 0.875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-danger  { background: rgba(229,62,62,.1);  color: #c53030; border: 1px solid rgba(229,62,62,.2); border-left: 4px solid var(--danger); }

        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; transition: var(--transition); }
        
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-container { position: relative; }
            .sidebar { position: absolute; left: -280px; height: 100%; box-shadow: none; }
            .sidebar.active { left: 0; box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2); }
            .sidebar-overlay.active { display: block; opacity: 1; }
        }
        
        @media (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
            .form-actions { flex-direction: column; }
            .form-actions .btn { width: 100%; justify-content: center; }
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
                            <div class="user-avatar"><?= strtoupper(substr(session()->get('nama_lengkap') ?? 'A', 0, 2)) ?></div>
                            <div class="user-details">
                                <div class="user-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Administrator') ?></div>
                                <div class="user-role">Administrator</div>
                            </div>
                            <i class="fas fa-chevron-down" style="font-size: 0.9rem; color: rgba(255,255,255,0.7);"></i>
                        </div>
                        <div class="dropdown-menu" id="userDropdown">
                            <a href="<?= base_url('auth/logout') ?>" class="dropdown-item logout-btn" id="logoutBtn"><i class="fas fa-sign-out-alt"></i><span>Keluar</span></a>
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
                <div class="welcome-text">Selamat Datang,</div>
                <div class="admin-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Administrator') ?></div>
            </div>
            
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/users') ?>"><i class="fas fa-users-cog"></i><span>Manajemen Akun</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/santri') ?>"><i class="fas fa-user-graduate"></i><span>Data Santri</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('admin/ustadz') ?>"><i class="fas fa-chalkboard-teacher"></i><span>Data Ustadz</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/kelas') ?>"><i class="fas fa-school"></i><span>Data Kelas</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/hafalan') ?>"><i class="fas fa-quran"></i><span>Progres Hafalan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pembayaran') ?>"><i class="fas fa-money-bill-wave"></i><span>Keuangan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pengumuman') ?>"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></div>
            </div>
        </div>

        <div class="dashboard-content">
            <div class="top-nav">
                <a href="<?= base_url('admin/ustadz') ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <?php foreach(session()->getFlashdata('errors') as $err): ?>
                            <p><?= $err ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="page-header-card">
                <div class="header-icon"><i class="fas fa-user-edit"></i></div>
                <div class="header-text">
                    <h1>Perbarui Profil Ustadz</h1>
                    <p>Ubah informasi detail pengajar: <?= htmlspecialchars($ustadz['nama_lengkap']) ?></p>
                </div>
            </div>

            <form action="<?= base_url('admin/ustadz/update/' . $ustadz['id']) ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="icon-box" style="background: rgba(26,95,180,0.1); color: var(--primary);"><i class="fas fa-id-card"></i></div>
                        <div>
                            <h3>Identitas Pengajar</h3>
                            <p>Akun login terhubung: <strong>@<?= htmlspecialchars($user['username']) ?></strong></p>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-user"></i> Nama Lengkap & Gelar <span class="required">*</span></label>
                                <input type="text" name="nama_lengkap" class="form-control" value="<?= old('nama_lengkap', $ustadz['nama_lengkap']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-id-badge"></i> NIP / ID Pegawai</label>
                                <input type="text" name="nip" class="form-control" value="<?= old('nip', $ustadz['nip']) ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin <span class="required">*</span></label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="L" <?= old('jenis_kelamin', $ustadz['jenis_kelamin']) == 'L' ? 'selected' : '' ?>>Laki-laki (Ustadz)</option>
                                    <option value="P" <?= old('jenis_kelamin', $ustadz['jenis_kelamin']) == 'P' ? 'selected' : '' ?>>Perempuan (Ustadzah)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-calendar"></i> Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="<?= old('tanggal_lahir', $ustadz['tanggal_lahir']) ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-card">
                    <div class="form-card-header">
                        <div class="icon-box" style="background: rgba(229,165,10,0.1); color: var(--accent);"><i class="fas fa-graduation-cap"></i></div>
                        <div>
                            <h3>Keahlian & Kontak</h3>
                            <p>Informasi pendukung profil pengajar</p>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-certificate"></i> Bidang Keahlian</label>
                                <input type="text" name="bidang_keahlian" class="form-control" value="<?= old('bidang_keahlian', $ustadz['bidang_keahlian']) ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-phone"></i> Nomor Telepon <span class="required">*</span></label>
                                <input type="text" name="no_telepon" class="form-control" value="<?= old('no_telepon', $ustadz['no_telepon']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-university"></i> Pendidikan Terakhir</label>
                                <input type="text" name="pendidikan" class="form-control" value="<?= old('pendidikan', $ustadz['pendidikan']) ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-toggle-on"></i> Status Kepegawaian <span class="required">*</span></label>
                                <select name="status" class="form-control" required>
                                    <option value="aktif" <?= old('status', $ustadz['status']) == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="nonaktif" <?= old('status', $ustadz['status']) == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                </select>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control"><?= old('alamat', $ustadz['alamat']) ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions" style="background:transparent; padding:0; margin-bottom: 30px;">
                    <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:16px;">
                        <i class="fas fa-save"></i> Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Basic UI scripts
        document.getElementById('menuToggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        });
        document.getElementById('sidebarOverlay').addEventListener('click', () => {
            document.getElementById('sidebar').classList.remove('active');
            document.getElementById('sidebarOverlay').classList.remove('active');
        });
        document.getElementById('userDropdownToggle').addEventListener('click', (e) => {
            e.stopPropagation();
            document.getElementById('userDropdown').classList.toggle('active');
        });
        document.addEventListener('click', () => {
            document.getElementById('userDropdown').classList.remove('active');
        });
        document.querySelectorAll('.alert').forEach(a => setTimeout(() => { 
            a.style.opacity = '0'; 
            a.style.transition = 'opacity 0.4s';
            setTimeout(() => a.remove(), 400); 
        }, 5000));
    </script>
</body>
</html>
