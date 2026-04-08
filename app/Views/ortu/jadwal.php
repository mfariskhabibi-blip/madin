<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Pelajaran - PTQ Al-Hikmah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a5fb4; --primary-dark: #1c3d78; --secondary: #26a269;
            --accent: #e5a50a; --light: #f8f9fa; --gray: #718096;
            --light-gray: #e2e8f0; --dark: #2d3748; --danger: #e53e3e;
            --success: #38a169; --warning: #dd6b20; --info: #0ea5e9;
            --purple: #8b5cf6; --shadow: 0 4px 6px rgba(0,0,0,0.1);
            --radius: 12px; --transition: all 0.3s ease;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', 'Segoe UI', sans-serif; }
        body { background-color: #f0f2f5; color: var(--dark); overflow-x: hidden; }
        a { text-decoration: none; color: inherit; }
        
        .dashboard-header { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); padding: 12px 15px; display: flex; justify-content: space-between; align-items: center; color: white; box-shadow: 0 4px 12px rgba(0,0,0,0.15); position: sticky; top: 0; z-index: 1000; }
        .logo { display:flex; align-items:center; gap:10px; font-size:1.4rem; font-weight:700; }
        .logo span { color:var(--accent); }
        
        .dashboard-container { display: flex; min-height: calc(100vh - 60px); }
        .sidebar { width: 280px; background: linear-gradient(180deg, var(--primary-dark) 0%, #152a57 100%); color: white; padding: 20px 0; transition: var(--transition); }
        .sidebar-menu { padding: 0 15px; margin-top:20px; }
        .menu-item a { display: flex; align-items: center; padding: 14px 15px; border-radius: 8px; margin-bottom: 5px; transition: var(--transition); }
        .menu-item a:hover, .menu-item.active a { background: rgba(255, 255, 255, 0.1); transform: translateX(5px); }
        .menu-item i { margin-right: 12px; width: 20px; text-align: center; }
        
        .dashboard-content { flex: 1; padding: 40px; }
        .page-title { font-size: 2rem; color: var(--primary-dark); margin-bottom: 30px; display: flex; align-items: center; gap: 15px; font-weight: 800; }
        
        .anak-list { display: flex; gap: 10px; margin-bottom: 30px; }
        .anak-tag { background: white; padding: 8px 16px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; color: var(--primary); border: 1px solid var(--primary); }

        .schedules-container { display: flex; flex-direction: column; gap: 30px; }
        .day-section { background: white; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; }
        .day-header { background: var(--light); padding: 15px 25px; border-bottom: 1px solid var(--light-gray); display: flex; align-items: center; gap: 10px; }
        .day-title { font-weight: 700; color: var(--primary); font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px; }
        
        .jadwal-list { display: flex; flex-direction: column; }
        .jadwal-row { display: grid; grid-template-columns: 120px 1fr auto; align-items: center; padding: 20px 25px; border-bottom: 1px solid #f8f9fa; }
        .jadwal-row:last-child { border-bottom: none; }
        
        .time-box { background: rgba(26,95,180,0.1); color: var(--primary); padding: 8px 12px; border-radius: 8px; font-weight: 700; font-family: monospace; font-size: 0.95rem; text-align: center; }
        .activity-info { padding: 0 20px; }
        .activity-name { font-size: 1.1rem; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
        .activity-details { font-size: 0.85rem; color: var(--gray); display: flex; align-items: center; gap: 15px; }
        .activity-details i { color: var(--accent); }
        
        .empty-state { text-align: center; padding: 80px 20px; background: white; border-radius: var(--radius); box-shadow: var(--shadow); }
        .empty-state i { font-size: 4rem; color: var(--light-gray); margin-bottom: 20px; }
        .empty-state h3 { font-size: 1.5rem; color: var(--dark); margin-bottom: 10px; }

        @media (max-width: 768px) {
            .dashboard-content { padding: 20px 15px; }
            .sidebar { display: none; }
            .jadwal-row { grid-template-columns: 1fr; gap: 10px; }
            .time-box { width: fit-content; }
            .activity-info { padding: 10px 0; }
        }
    </style>
</head>
<body>
    <header class="dashboard-header">
        <div class="logo">
            <div style="margin-left:10px;">PTQ <span>Al-Hikmah</span></div>
        </div>
        <div style="font-weight:bold;"><?= session()->get('nama_lengkap') ?> (Orang Tua)</div>
    </header>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="sidebar-menu">
                <div class="menu-item"><a href="<?= base_url('ortu/dashboard') ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/hafalan') ?>"><i class="fas fa-quran"></i><span>Progres Hafalan Anak</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/kehadiran') ?>"><i class="fas fa-calendar-check"></i><span>Kehadiran Santri</span></a></div>
                <div class="menu-item"><a href="<?= base_url('ortu/pembayaran') ?>"><i class="fas fa-money-bill-wave"></i><span>Status Pembayaran</span></a></div>
                <div class="menu-item active"><a href="<?= base_url('ortu/jadwal') ?>"><i class="fas fa-calendar-alt"></i><span>Jadwal Pelajaran</span></a></div>
            </div>
        </div>
        <div class="dashboard-content">
            <h1 class="page-title"><i class="fas fa-calendar-alt"></i> Jadwal Pelajaran Anak</h1>
            
            <div class="anak-list">
                <?php foreach($anak as $a): ?>
                    <div class="anak-tag"><i class="fas fa-child"></i> <?= $a['nama_santri'] ?> (<?= htmlspecialchars($a['nama_kelas'] ?? 'Belum ada kelas') ?>)</div>
                <?php endforeach; ?>
            </div>

            <?php if(!empty($jadwal)): 
                $groupedJadwal = [];
                foreach($jadwal as $j) {
                    $groupedJadwal[$j['hari']][] = $j;
                }
                $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            ?>
            <div class="schedules-container">
                <?php foreach($days as $day): if(!isset($groupedJadwal[$day])) continue; ?>
                <div class="day-section">
                    <div class="day-header">
                        <i class="fas fa-calendar-day"></i>
                        <div class="day-title"><?= $day ?></div>
                    </div>
                    <div class="jadwal-list">
                        <?php foreach($groupedJadwal[$day] as $j): ?>
                        <div class="jadwal-row">
                            <div class="time-box">
                                <?= substr($j['jam_mulai'], 0, 5) ?> - <?= substr($j['jam_selesai'], 0, 5) ?>
                            </div>
                            <div class="activity-info">
                                <div class="activity-name"><?= htmlspecialchars($j['nama_kegiatans']) ?></div>
                                <div class="activity-details">
                                    <span><i class="fas fa-school"></i> <?= htmlspecialchars($j['nama_kelas']) ?></span>
                                    <span><i class="fas fa-chalkboard-teacher"></i> <?= htmlspecialchars($j['nama_ustadz'] ?? 'Ustadz') ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-calendar-times"></i>
                <h3>Belum Ada Jadwal</h3>
                <p>Data jadwal belum tersedia atau anak Anda belum ditempatkan di kelas manapun.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
