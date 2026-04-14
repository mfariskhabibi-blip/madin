<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?> - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* VARIABLES & RESET (Premium Design) */
        :root {
            --primary: #1a5fb4; --primary-dark: #1c3d78; --secondary: #26a269;
            --accent: #e5a50a; --light: #f8f9fa; --dark: #2d3748;
            --gray: #718096; --light-gray: #e2e8f0; --danger: #e53e3e;
            --success: #38a169; --warning: #dd6b20; --info: #0ea5e9;
            --purple: #8b5cf6; --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --radius: 12px; --transition: all 0.3s ease;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif; }
        body { background-color: #f0f2f5; color: var(--dark); line-height: 1.6; }

        /* HEADER/NAVBAR Premium */
        .dashboard-header { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); padding: 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); }
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .header-content { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; }
        .logo { display: flex; align-items: center; gap: 12px; color: white; text-decoration: none; font-weight: 700; font-size: 1.25rem; padding: 8px 12px; border-radius: var(--radius); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); }
        .logo span { color: var(--accent); }
        
        .user-section { display: flex; align-items: center; gap: 15px; }
        .user-info { display: flex; align-items: center; gap: 12px; padding: 8px 16px; border-radius: var(--radius); background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); cursor: pointer; transition: var(--transition); }
        .user-info:hover { background: rgba(255, 255, 255, 0.2); }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--purple) 0%, var(--info) 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1rem; }

        /* DASHBOARD LAYOUT */
        .main-wrapper { display: flex; min-height: calc(100vh - 68px); }
        
        .sidebar { width: 280px; background: linear-gradient(180deg, var(--primary-dark) 0%, #152a57 100%); color: white; padding: 20px 0; transition: var(--transition); position: relative; z-index: 99; box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1); }
        .sidebar-header { padding: 0 20px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 20px; }
        .welcome-text { font-size: 1rem; margin-bottom: 5px; opacity: 0.9; }
        .admin-name { font-weight: 700; font-size: 1.2rem; color: var(--accent); }
        .sidebar-menu { padding: 0 15px; }
        .menu-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 8px; color: rgba(255,255,255,0.8); text-decoration: none; font-weight: 500; transition: var(--transition); margin-bottom: 5px; }
        .menu-item:hover { background: rgba(255, 255, 255, 0.1); color: white; transform: translateX(5px); }
        .menu-item.active { background: rgba(255, 255, 255, 0.15); color: white; }
        .menu-item i { width: 20px; text-align: center; }

        .content-area { flex: 1; padding: 40px; background-color: #f5f7fa; }
        .back-link { display: inline-flex; align-items: center; gap: 8px; color: var(--gray); text-decoration: none; font-weight: 500; margin-bottom: 20px; transition: var(--transition); }
        .back-link:hover { color: var(--primary); transform: translateX(-3px); }
        .page-header { margin-bottom: 28px; }
        .page-title { font-size: 1.875rem; font-weight: 800; color: var(--primary-dark); display: flex; align-items: center; gap: 12px; }

        /* FORM STYLES Premium */
        .form-card { background: white; border-radius: var(--radius); box-shadow: var(--shadow); padding: 32px; border: 1px solid var(--light-gray); }
        .form-section { margin-bottom: 32px; }
        .section-title { font-size: 1.1rem; font-weight: 700; color: var(--primary); margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid var(--light-gray); display: flex; align-items: center; gap: 10px; }
        .section-title i { font-size: 1.2rem; }
        
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .full-width { grid-column: span 2; }

        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 0.875rem; font-weight: 600; color: var(--dark); margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px 16px; border: 1.5px solid var(--light-gray); border-radius: 10px; font-size: 1rem; transition: var(--transition); outline: none; font-family: inherit; }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(26, 95, 180, 0.1); }
        textarea.form-control { resize: vertical; min-height: 80px; }
        select.form-control { cursor: pointer; background-color: white; }
        .required { color: var(--danger); margin-left: 4px; }
        .helper-text { font-size: 0.75rem; color: var(--gray); margin-top: 6px; }

        /* Ustadz Grid Selection */
        .ustadz-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 12px; margin-top: 12px; max-height: 400px; overflow-y: auto; padding: 4px; }
        .ustadz-item { display: flex; align-items: center; gap: 12px; padding: 12px 16px; border: 1.5px solid var(--light-gray); border-radius: 10px; cursor: pointer; transition: var(--transition); background: white; }
        .ustadz-item:hover { border-color: var(--primary); background: var(--light); transform: translateY(-1px); }
        .ustadz-item.selected { border-color: var(--primary); background: rgba(26, 95, 180, 0.05); box-shadow: 0 2px 8px rgba(26, 95, 180, 0.1); }
        .ustadz-item input[type="checkbox"] { width: 18px; height: 18px; cursor: pointer; accent-color: var(--primary); }
        .ustadz-info { flex: 1; }
        .ustadz-name { font-size: 0.9rem; font-weight: 600; color: var(--dark); display: block; }
        .ustadz-username { font-size: 0.7rem; color: var(--gray); display: block; margin-top: 2px; }

        /* Form Actions */
        .form-actions { display: flex; justify-content: flex-end; gap: 16px; margin-top: 16px; padding-top: 24px; border-top: 1px solid var(--light-gray); }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 10px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: var(--transition); border: none; font-family: inherit; }
        .btn-light { background: var(--light); color: var(--gray); border: 1px solid var(--light-gray); }
        .btn-light:hover { background: var(--light-gray); color: var(--dark); transform: translateY(-1px); }
        .btn-primary { background: var(--primary); color: white; box-shadow: 0 4px 12px rgba(26, 95, 180, 0.2); }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(26, 95, 180, 0.3); }

        /* Alert Styles */
        .alert { padding: 14px 20px; border-radius: 10px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; animation: slideIn 0.4s ease; }
        .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; border-left: 4px solid var(--success); }
        .alert-danger { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; border-left: 4px solid var(--danger); }
        .alert-warning { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; border-left: 4px solid var(--warning); }
        @keyframes slideIn { from { transform: translateY(-10px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        /* Empty State for Ustadz */
        .empty-ustadz { text-align: center; padding: 40px; color: var(--gray); background: var(--light); border-radius: 10px; }
        .empty-ustadz i { font-size: 2rem; margin-bottom: 12px; opacity: 0.5; }
        .empty-ustadz p { margin-bottom: 8px; }

        /* Validation Error Styles */
        .is-invalid { border-color: var(--danger) !important; }
        .invalid-feedback { color: var(--danger); font-size: 0.75rem; margin-top: 5px; display: block; }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .sidebar { width: 260px; }
        }
        @media (max-width: 768px) {
            .grid { grid-template-columns: 1fr; }
            .full-width { grid-column: span 1; }
            .sidebar { display: none; }
            .content-area { padding: 24px 16px; }
            .form-card { padding: 20px; }
            .ustadz-grid { grid-template-columns: 1fr; max-height: 300px; }
            .form-actions { flex-direction: column-reverse; }
            .btn { justify-content: center; }
        }
    </style>
</head>
<body>

    <!-- HEADER/NAVBAR PREMIUM -->
    <header class="dashboard-header">
        <div class="container">
            <div class="header-content">
                <a href="<?= base_url('admin/dashboard') ?>" class="logo">
                    <img src="<?= base_url('assets/img/logo-ptq.jpg') ?>" alt="Logo PTQ" style="height:36px; border-radius:6px;">
                    PTQ <span>Pencongan</span>
                </a>
                <div class="user-section">
                    <div class="user-info">
                        <div class="user-avatar"><?= strtoupper(substr(session()->get('nama_lengkap') ?? 'A', 0, 2)) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="main-wrapper">
        <!-- SIDEBAR PREMIUM -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="welcome-text">Selamat Datang,</div>
                <div class="admin-name"><?= htmlspecialchars(session()->get('nama_lengkap') ?? 'Administrator') ?></div>
            </div>
            <div class="sidebar-menu">
                <a href="<?= base_url('admin/dashboard') ?>" class="menu-item"><i class="fas fa-chart-line"></i> Dashboard</a>
                <a href="<?= base_url('admin/users') ?>" class="menu-item"><i class="fas fa-users"></i> Manajemen Akun</a>
                <a href="<?= base_url('admin/santri') ?>" class="menu-item"><i class="fas fa-user-graduate"></i> Data Santri</a>
                <a href="<?= base_url('admin/ustadz') ?>" class="menu-item"><i class="fas fa-chalkboard-teacher"></i> Data Ustadz</a>
                <a href="<?= base_url('admin/kelas') ?>" class="menu-item active"><i class="fas fa-school"></i> Data Kelas</a>
                <a href="<?= base_url('admin/hafalan') ?>" class="menu-item"><i class="fas fa-book-open"></i> Hafalan</a>
                <a href="<?= base_url('admin/pembayaran') ?>" class="menu-item"><i class="fas fa-wallet"></i> Keuangan</a>
            </div>
        </aside>

        <main class="content-area">
            <!-- BACK LINK -->
            <a href="<?= base_url('admin/kelas') ?>" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Kelas
            </a>

            <!-- PAGE HEADER -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="fas fa-plus-circle" style="color: var(--primary);"></i> 
                    Tambah Kelas Baru
                </h1>
            </div>

            <!-- ALERTS -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> 
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> 
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('warning')): ?>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i> 
                    <?= session()->getFlashdata('warning') ?>
                </div>
            <?php endif; ?>

            <!-- FORM TAMBAH KELAS -->
            <form action="<?= base_url('admin/kelas/store') ?>" method="POST" class="form-card" id="formKelas">
                <?= csrf_field() ?>
                
                <!-- SECTION 1: Informasi Dasar -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-info-circle"></i> 
                        Informasi Dasar Kelas
                    </h2>
                    <div class="grid">
                        <div class="form-group full-width">
                            <label class="form-label">
                                Nama Kelas / Rombongan Belajar 
                                <span class="required">*</span>
                            </label>
                            <input type="text" name="nama_kelas" class="form-control" 
                                   id="nama_kelas"
                                   value="<?= old('nama_kelas') ?>"
                                   placeholder="Contoh: Kelas Tahfidz 1A, Kelas Tilawah 2B, Kelas Abu Bakar, dll."
                                   required>
                            <div class="helper-text">Nama kelas yang akan ditampilkan di sistem.</div>
                            <?php if (isset($validation) && $validation->hasError('nama_kelas')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('nama_kelas') ?></div>
                            <?php endif; ?>
                        </div>
                        

                        
                        <div class="form-group full-width">
                            <label class="form-label">
                                <i class="fas fa-align-left"></i> 
                                Deskripsi Kelas
                            </label>
                            <textarea name="deskripsi" class="form-control" rows="3" 
                                      id="deskripsi"
                                      placeholder="Deskripsikan kelas ini, misal: fokus program, target hafalan, karakteristik santri, dll."><?= old('deskripsi') ?></textarea>
                            <div class="helper-text">Deskripsi singkat tentang kelas (opsional). Maksimal 255 karakter.</div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: Tim Pengajar -->
                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-users-cog"></i> 
                        Tim Pengajar (Ustadz/ah)
                    </h2>
                    <p style="font-size: 0.85rem; color: var(--gray); margin-bottom: 16px; background: var(--light); padding: 10px 14px; border-radius: 8px;">
                        <i class="fas fa-info-circle"></i> Pilih satu atau lebih pengajar yang akan mengampu kelas ini. 
                        Semua pengajar terpilih akan memiliki akses ke data santri di kelas ini.
                    </p>
                    
                    <?php if(!empty($ustadzList)): ?>
                        <div class="ustadz-grid" id="ustadzGrid">
                            <?php 
                            $oldUstadzIds = old('ustadz_ids', []);
                            foreach($ustadzList as $u): 
                                $isSelected = in_array($u['id'], $oldUstadzIds);
                            ?>
                                <label class="ustadz-item <?= $isSelected ? 'selected' : '' ?>">
                                    <input type="checkbox" name="ustadz_ids[]" value="<?= $u['id'] ?>" <?= $isSelected ? 'checked' : '' ?>>
                                    <div class="ustadz-info">
                                        <span class="ustadz-name"><?= htmlspecialchars($u['nama_lengkap']) ?></span>
                                        <span class="ustadz-username">@<?= htmlspecialchars($u['username']) ?></span>
                                    </div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <div class="helper-text" style="margin-top: 12px;">
                            <i class="fas fa-check-circle"></i> Centang ustadz yang akan menjadi pengajar di kelas ini.
                        </div>
                    <?php else: ?>
                        <div class="empty-ustadz">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p><strong>Belum ada data ustadz yang tersedia</strong></p>
                            <small>Silakan tambah data ustadz terlebih dahulu di menu 
                                <a href="<?= base_url('admin/ustadz') ?>" style="color: var(--primary);">Data Ustadz</a>
                            </small>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- FORM ACTIONS -->
                <div class="form-actions">
                    <a href="<?= base_url('admin/kelas') ?>" class="btn btn-light">
                        <i class="fas fa-times"></i> Batalkan
                    </a>
                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                        <i class="fas fa-save"></i> Simpan Kelas Baru
                    </button>
                </div>
            </form>
        </main>
    </div>

    <script>
        // Visual feedback for checkbox selection
        document.querySelectorAll('.ustadz-item').forEach(item => {
            const checkbox = item.querySelector('input[type="checkbox"]');
            if (!checkbox) return;
            
            // Update visual state on change
            checkbox.addEventListener('change', () => {
                if(checkbox.checked) {
                    item.classList.add('selected');
                } else {
                    item.classList.remove('selected');
                }
            });
            
            // Click on the whole item toggles checkbox
            item.addEventListener('click', (e) => {
                // Prevent if clicking directly on checkbox (to avoid double toggle)
                if(e.target !== checkbox && !checkbox.contains(e.target)) {
                    checkbox.checked = !checkbox.checked;
                    if(checkbox.checked) {
                        item.classList.add('selected');
                    } else {
                        item.classList.remove('selected');
                    }
                    // Trigger change event
                    checkbox.dispatchEvent(new Event('change'));
                }
            });
        });

        // Form validation before submit
        document.getElementById('formKelas')?.addEventListener('submit', function(e) {
            const namaKelas = document.getElementById('nama_kelas');
            if (namaKelas && !namaKelas.value.trim()) {
                e.preventDefault();
                namaKelas.classList.add('is-invalid');
                let feedback = namaKelas.nextElementSibling;
                if (!feedback || !feedback.classList.contains('invalid-feedback')) {
                    feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback';
                    namaKelas.parentNode.insertBefore(feedback, namaKelas.nextSibling);
                }
                feedback.innerHTML = 'Nama kelas tidak boleh kosong.';
                namaKelas.focus();
                return false;
            }
            return true;
        });

        // Remove invalid class on input
        const namaKelasInput = document.getElementById('nama_kelas');
        if (namaKelasInput) {
            namaKelasInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                    const feedback = this.nextElementSibling;
                    if (feedback && feedback.classList.contains('invalid-feedback')) {
                        feedback.remove();
                    }
                }
            });
        }

        // Auto hide alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => { 
                alert.style.transition = 'opacity 0.4s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 400); 
            }, 5000);
        });

        // Prevent double submit
        const submitBtn = document.getElementById('btnSubmit');
        if (submitBtn) {
            document.getElementById('formKelas')?.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            });
        }
    </script>
</body>
</html>