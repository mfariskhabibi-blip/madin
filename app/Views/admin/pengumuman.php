<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman - PTQ Al-Hikmah</title>
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
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-title h1 { font-size: 1.8rem; color: var(--primary-dark); }
        .page-title p { color: var(--gray); font-size: 0.9rem; }

        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: var(--transition); border: none; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); box-shadow: 0 5px 15px rgba(26, 95, 180, 0.2); }
        
        /* ANNOUNCEMENT CARDS */
        .announcement-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 20px; }
        .announcement-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow); transition: var(--transition); border: 1px solid transparent; display: flex; flex-direction: column; }
        .announcement-card:hover { transform: translateY(-5px); border-color: var(--primary); }
        .card-header { padding: 16px 20px; border-bottom: 1px solid #f0f2f5; display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; }
        .card-category { font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--primary); background: rgba(26,95,180,0.08); padding: 4px 10px; border-radius: 6px; }
        .card-category.penting { color: var(--danger); background: rgba(229,62,62,0.08); }
        .card-category.keuangan { color: var(--accent); background: rgba(229,165,10,0.08); }
        .card-category.akademik { color: var(--secondary); background: rgba(38,162,105,0.08); }

        .card-actions { display: flex; gap: 6px; }
        .btn-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: var(--light); color: var(--gray); transition: var(--transition); cursor: pointer; border: none; }
        .btn-icon:hover { background: var(--primary); color: white; }
        .btn-icon.delete:hover { background: var(--danger); color: white; }

        .card-body { padding: 20px; flex-grow: 1; }
        .card-title { font-size: 1.15rem; font-weight: 700; color: var(--dark); margin-bottom: 10px; line-height: 1.4; }
        .card-excerpt { font-size: 0.9rem; color: var(--gray); display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 15px; }

        .card-footer { padding: 12px 20px; background: rgba(244, 247, 254, 0.5); border-top: 1px solid #f0f2f5; display: flex; justify-content: space-between; align-items: center; }
        .meta-item { display: flex; align-items: center; gap: 6px; font-size: 0.75rem; color: var(--gray); font-weight: 500; }
        .meta-item i { font-size: 0.9rem; opacity: 0.7; }

        .badge { padding: 4px 10px; border-radius: 20px; font-size: 0.7rem; font-weight: 700; }
        .badge-everyone { background: rgba(139, 92, 246, 0.1); color: var(--purple); }
        .badge-ustadz { background: rgba(14, 165, 233, 0.1); color: var(--info); }
        .badge-ortu { background: rgba(229, 165, 10, 0.1); color: var(--accent); }
        .badge-draft { background: #eee; color: #666; }

        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 18px; display: flex; align-items: center; gap: 10px; font-size: .875rem; animation: fadeInDown .4s; }
        @keyframes fadeInDown { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }
        .alert-success { background: rgba(38,162,105,.1); color: #1e8555; border: 1px solid rgba(38,162,105,.2); }
        .alert-error { background: rgba(229,62,62,.1); color: #c53030; border: 1px solid rgba(229,62,62,.2); }

        /* MODAL */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2000; display: none; align-items: center; justify-content: center; padding: 20px; }
        .modal-overlay.active { display: flex; }
        .modal-card { background: white; width: 100%; max-width: 650px; border-radius: 12px; overflow: hidden; box-shadow: 0 15px 40px rgba(0,0,0,0.2); animation: slideUp 0.3s ease; }
        @keyframes slideUp { from{opacity:0; transform:translateY(20px);} to{opacity:1; transform:translateY(0);} }
        .modal-header { padding: 20px 25px; border-bottom: 1px solid var(--light-gray); display: flex; justify-content: space-between; align-items: center; }
        .modal-body { padding: 25px; max-height: 80vh; overflow-y: auto; }
        .modal-footer { padding: 15px 25px; background: #f9fafb; border-top: 1px solid var(--light-gray); display: flex; justify-content: flex-end; gap: 10px; }

        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 8px; color: var(--dark); }
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid var(--light-gray); border-radius: 8px; outline: none; transition: var(--transition); font-size: 0.9rem; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,95,180,0.1); }
        textarea.form-control { resize: vertical; min-height: 120px; }

        .sidebar-overlay { display: none; position: fixed; top: 68px; left: 0; width: 100%; height: calc(100vh - 68px); background: rgba(0, 0, 0, 0.5); z-index: 98; opacity: 0; }
        
        @media (max-width: 992px) {
            .mobile-menu-toggle { display: flex; }
            .dashboard-container { position: relative; }
            .sidebar { position: absolute; left: -280px; height: 100%; }
            .sidebar.active { left: 0; box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2); }
            .sidebar-overlay.active { display: block; opacity: 1; }
            .user-name, .user-role { display: none; }
            .announcement-grid { grid-template-columns: 1fr; }
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
                <div class="menu-item"><a href="<?= base_url('admin/pembayaran') ?>"><i class="fas fa-money-bill-wave"></i><span>Keuangan</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('admin/pengumuman') ?>"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></div>
            </div>
        </div>

        <!-- CONTENT -->
        <main class="dashboard-content" id="mainContent">
            <!-- ALERTS -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="page-header">
                <div class="page-title">
                    <h1><i class="fas fa-bullhorn"></i> Pengumuman & Informasi</h1>
                    <p>Kelola pesan dan informasi untuk civitas PTQ Al-Hikmah.</p>
                </div>
                <button class="btn btn-primary" onclick="openAddModal()">
                    <i class="fas fa-plus"></i> Buat Pengumuman
                </button>
            </div>

            <div class="announcement-grid">
                <?php if (!empty($riwayat)): ?>
                    <?php foreach ($riwayat as $p): ?>
                        <div class="announcement-card">
                            <div class="card-header">
                                <span class="card-category <?= strtolower($p['kategori']) ?>"><?= $p['kategori'] ?></span>
                                <div class="card-actions">
                                    <button class="btn-icon" onclick='openEditModal(<?= json_encode($p) ?>)' title="Ubah">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <a href="<?= base_url('admin/pengumuman/delete/' . $p['id']) ?>" class="btn-icon delete" onclick="return confirm('Hapus pengumuman ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><?= $p['judul'] ?></h3>
                                <div class="card-excerpt"><?= strip_tags($p['konten']) ?></div>
                                <div style="display:flex; gap:10px;">
                                    <?php 
                                        $rClass = 'badge-everyone'; $rIcon = 'fa-users'; $rLabel = 'Semua';
                                        if($p['target_role'] == 'ustadz') { $rClass = 'badge-ustadz'; $rIcon = 'fa-chalkboard-teacher'; $rLabel = 'Ustadz'; }
                                        if($p['target_role'] == 'ortu') { $rClass = 'badge-ortu'; $rIcon = 'fa-user-friends'; $rLabel = 'Orang Tua'; }
                                    ?>
                                    <span class="badge <?= $rClass ?>"><i class="fas <?= $rIcon ?>"></i> <?= $rLabel ?></span>
                                    <?php if($p['status'] == 'draft'): ?>
                                        <span class="badge badge-draft">Draft</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="meta-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <?= date('d M Y', strtotime($p['created_at'])) ?>
                                </div>
                                <div class="meta-item">
                                    <i class="far fa-user"></i>
                                    <?= $p['nama_penulis'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="grid-column: 1/-1; text-align:center; padding:100px 20px; background:white; border-radius:12px; box-shadow: var(--shadow);">
                        <i class="fas fa-bullhorn" style="font-size:4rem; color:var(--light-gray); margin-bottom:20px; opacity:0.3;"></i>
                        <h3 style="color:var(--gray);">Belum Ada Pengumuman</h3>
                        <p style="color:var(--gray); opacity:0.7;">Klik tombol "Buat Pengumuman" untuk memulai.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- MODAL FORM -->
    <div class="modal-overlay" id="announcementModal">
        <form id="announcementForm" action="<?= base_url('admin/pengumuman/store') ?>" method="post" class="modal-card">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h3 id="modalTitle">Buat Pengumuman Baru</h3>
                <button type="button" style="background:none; border:none; color:var(--gray); cursor:pointer; font-size:1.2rem;" onclick="closeModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Judul Pengumuman *</label>
                    <input type="text" name="judul" id="f_judul" class="form-control" required placeholder="Masukkan judul yang informatif...">
                </div>
                
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px;">
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

                <div class="form-group">
                    <label class="form-label">Status *</label>
                    <select name="status" id="f_status" class="form-control" required>
                        <option value="terbit">Terbit (Langsung Publikasikan)</option>
                        <option value="draft">Draft (Simpan Sementara)</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background:var(--light); color:var(--gray);" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Pengumuman</button>
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

        const modal = document.getElementById('announcementModal');
        const form = document.getElementById('announcementForm');
        const title = document.getElementById('modalTitle');

        function openAddModal() {
            title.innerText = 'Buat Pengumuman Baru';
            form.action = '<?= base_url('admin/pengumuman/store') ?>';
            form.reset();
            modal.classList.add('active');
        }

        function openEditModal(data) {
            title.innerText = 'Ubah Pengumuman';
            form.action = '<?= base_url('admin/pengumuman/update/') ?>' + data.id;
            
            document.getElementById('f_judul').value = data.judul;
            document.getElementById('f_kategori').value = data.kategori;
            document.getElementById('f_target').value = data.target_role;
            document.getElementById('f_konten').value = data.konten;
            document.getElementById('f_status').value = data.status;

            modal.classList.add('active');
        }

        function closeModal() {
            modal.classList.remove('active');
        }

        // Close alert auto
        document.querySelectorAll('.alert').forEach(a => setTimeout(() => { a.style.opacity=0; setTimeout(()=>a.remove(),400); }, 5000));
    </script>
</body>
</html>
