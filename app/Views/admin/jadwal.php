<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Jadwal - PTQ Pencongan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a5fb4; --primary-dark: #1c3d78; --secondary: #26a269;
            --accent: #e5a50a; --light: #f8f9fa; --dark: #2d3748;
            --gray: #718096; --light-gray: #e2e8f0; --danger: #e53e3e;
            --success: #38a169; --warning: #dd6b20; --info: #0ea5e9;
            --purple: #8b5cf6; --shadow: 0 4px 6px rgba(0,0,0,0.1);
            --radius: 8px; --transition: all 0.3s ease;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #f5f7fa; color: var(--dark); overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        
        .dashboard-header { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); padding: 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .header-content { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; }
        .logo-section { display: flex; align-items: center; gap: 15px; }
        .logo { display:flex; align-items:center; gap:12px; padding:8px 12px; border-radius:var(--radius); background:rgba(255,255,255,0.1); }
        .logo img { height: 36px; border-radius: 6px; }
        .logo-text { font-size: 1.4rem; font-weight: 700; color: white; }
        .logo-text span { color: var(--accent); }
        
        .dashboard-container { display: flex; min-height: calc(100vh - 68px); }
        .sidebar { width: 280px; background: linear-gradient(180deg, var(--primary-dark) 0%, #152a57 100%); color: white; padding: 20px 0; }
        .sidebar-header { padding: 0 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px; }
        .admin-name { font-weight: 700; color: var(--accent); }
        .sidebar-menu { padding: 0 15px; }
        .menu-item a { display: flex; align-items: center; padding: 14px 15px; border-radius: var(--radius); transition: var(--transition); margin-bottom: 5px; }
        .menu-item a:hover, .menu-item.active a { background: rgba(255,255,255,0.1); transform: translateX(5px); }
        .menu-item i { margin-right: 12px; width: 20px; text-align: center; }
        
        .dashboard-content { flex: 1; padding: 30px; }
        .page-title { font-size: 1.8rem; color: var(--primary-dark); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        
        .section-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; margin-bottom: 22px; }
        .card-header { display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; border-bottom: 1px solid var(--light-gray); }
        .card-title { font-size: 1.1rem; font-weight: 700; color: var(--primary-dark); display: flex; align-items: center; gap: 10px; }
        
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 6px; font-weight: 600; cursor: pointer; transition: .2s; border: none; font-size: 0.9rem; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-secondary { background: var(--light-gray); color: var(--dark); }
        
        .table-responsive { overflow-x: auto; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { text-align: left; padding: 15px 24px; background: var(--light); color: var(--gray); font-size: 0.8rem; text-transform: uppercase; border-bottom: 1px solid var(--light-gray); }
        .table td { padding: 15px 24px; border-bottom: 1px solid #f0f2f5; }
        
        .day-badge { padding: 4px 10px; border-radius: 4px; font-size: 0.75rem; font-weight: 700; background: var(--info); color: white; }
        .time-badge { font-family: monospace; font-weight: 600; color: var(--primary); }
        
        .action-btns { display: flex; gap: 5px; }
        .act-btn { width: 32px; height: 32px; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; border: none; transition: .2s; }
        .btn-edit { background: var(--primary); }
        .btn-delete { background: var(--danger); }
        
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,.5); z-index: 2000; display: none; align-items: center; justify-content: center; }
        .modal-overlay.active { display: flex; }
        .modal-card { background: #fff; width: 100%; max-width: 500px; border-radius: var(--radius); overflow: hidden; animation: slideUp 0.3s; }
        @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .modal-head { padding: 20px 24px; border-bottom: 1px solid var(--light-gray); display: flex; justify-content: space-between; align-items: center; }
        .modal-body { padding: 24px; }
        .modal-foot { padding: 16px 24px; background: var(--light); display: flex; justify-content: flex-end; gap: 10px; }
        
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; margin-bottom: 6px; font-weight: 600; font-size: 0.9rem; }
        .form-control { width: 100%; padding: 10px; border: 1px solid var(--light-gray); border-radius: 6px; outline: none; }
        
        .alert { padding: 15px; border-radius: var(--radius); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-weight: 500; }
        .alert-success { background: rgba(56,161,105,0.1); color: var(--success); border: 1px solid var(--success); }
    </style>
</head>
<body>
    <header class="dashboard-header">
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <a href="<?= base_url('admin/dashboard') ?>" class="logo">
                        <img src="<?= base_url('assets/img/logo-ptq.jpg') ?>" alt="Logo">
                        <div class="logo-text">PTQ <span>Pencongan</span></div>
                    </a>
                </div>
                <div style="color:white; font-weight:600;"><?= $nama_admin ?></div>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="admin-name">Administrator</div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/users') ?>"><i class="fas fa-users-cog"></i><span>Manajemen Akun</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/santri') ?>"><i class="fas fa-user-graduate"></i><span>Data Santri</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/ustadz') ?>"><i class="fas fa-chalkboard-teacher"></i><span>Data Ustadz</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/kelas') ?>"><i class="fas fa-school"></i><span>Data Kelas</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('admin/jadwal') ?>"><i class="fas fa-calendar-alt"></i><span>Jadwal Pelajaran</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pembayaran') ?>"><i class="fas fa-money-bill-wave"></i><span>Keuangan</span></a></div>
                <div class="menu-item"><a href="<?= base_url('admin/pengumuman') ?>"><i class="fas fa-bullhorn"></i><span>Pengumuman</span></a></div>
            </div>
        </div>

        <div class="dashboard-content">
            <h1 class="page-title"><i class="fas fa-calendar-alt"></i> Kelola Jadwal Pelajaran</h1>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <div class="section-card">
                <div class="card-header">
                    <div class="card-title"><i class="fas fa-list"></i> Daftar Jadwal</div>
                    <button class="btn btn-primary" onclick="openAddModal()"><i class="fas fa-plus"></i> Tambah Jadwal</button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Waktu</th>
                                <th>Kegiatan / Kelas</th>
                                <th>Pengajar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($jadwal)): ?>
                                <?php foreach($jadwal as $j): ?>
                                    <tr>
                                        <td><span class="day-badge"><?= $j['hari'] ?></span></td>
                                        <td><span class="time-badge"><?= substr($j['jam_mulai'],0,5) ?> - <?= substr($j['jam_selesai'],0,5) ?></span></td>
                                        <td>
                                            <div style="font-weight:600; color:var(--dark);"><?= htmlspecialchars($j['nama_kegiatans']) ?></div>
                                            <div style="font-size:0.8rem; color:var(--gray);"><?= htmlspecialchars($j['nama_kelas'] ?? 'Umum') ?></div>
                                        </td>
                                        <td><?= htmlspecialchars($j['nama_ustadz'] ?? 'Belum Ditentukan') ?></td>
                                        <td>
                                            <div class="action-btns">
                                                <button class="act-btn btn-edit" onclick="openEditModal(<?= htmlspecialchars(json_encode($j)) ?>)"><i class="fas fa-edit"></i></button>
                                                <a href="<?= base_url('admin/jadwal/delete/'.$j['id']) ?>" class="act-btn btn-delete" onclick="return confirm('Hapus jadwal ini?')"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" style="text-align:center; padding:40px; color:var(--gray);">Belum ada data jadwal.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal-overlay" id="jadwalModal">
        <div class="modal-card">
            <div class="modal-head">
                <h3 id="modalTitle">Tambah Jadwal</h3>
                <button style="background:none; border:none; font-size:1.2rem; cursor:pointer;" onclick="closeModal()">&times;</button>
            </div>
            <form id="jadwalForm" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Kegiatan *</label>
                        <input type="text" name="nama_kegiatans" id="f_kegiatan" class="form-control" placeholder="Contoh: Tahsin Pagi" required>
                    </div>
                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px;">
                        <div class="form-group">
                            <label class="form-label">Hari *</label>
                            <select name="hari" id="f_hari" class="form-control" required>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kelas</label>
                            <select name="id_kelas" id="f_kelas" class="form-control">
                                <option value="">-- Pilih Kelas (Opsional) --</option>
                                <?php foreach($kelasList as $k): ?>
                                    <option value="<?= $k['id'] ?>"><?= $k['nama_kelas'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px;">
                        <div class="form-group">
                            <label class="form-label">Jam Mulai *</label>
                            <input type="time" name="jam_mulai" id="f_mulai" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jam Selesai *</label>
                            <input type="time" name="jam_selesai" id="f_selesai" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ustadz Pengampu</label>
                        <select name="id_ustadz" id="f_ustadz" class="form-control">
                            <option value="">-- Pilih Ustadz --</option>
                            <?php foreach($ustadzList as $u): ?>
                                <option value="<?= $u['id'] ?>"><?= $u['nama_lengkap'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="f_deskripsi" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-foot">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('jadwalModal');
        const form = document.getElementById('jadwalForm');
        
        function openAddModal() {
            document.getElementById('modalTitle').innerText = 'Tambah Jadwal';
            form.action = '<?= base_url('admin/jadwal/store') ?>';
            form.reset();
            modal.classList.add('active');
        }

        function openEditModal(data) {
            document.getElementById('modalTitle').innerText = 'Edit Jadwal';
            form.action = '<?= base_url('admin/jadwal/update') ?>/' + data.id;
            
            document.getElementById('f_kegiatan').value = data.nama_kegiatans;
            document.getElementById('f_hari').value = data.hari;
            document.getElementById('f_kelas').value = data.id_kelas || '';
            document.getElementById('f_mulai').value = data.jam_mulai;
            document.getElementById('f_selesai').value = data.jam_selesai;
            document.getElementById('f_ustadz').value = data.id_ustadz || '';
            document.getElementById('f_deskripsi').value = data.deskripsi || '';
            
            modal.classList.add('active');
        }

        function closeModal() {
            modal.classList.remove('active');
        }
    </div>
</body>
</html>
