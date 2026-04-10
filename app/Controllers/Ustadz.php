<?php

namespace App\Controllers;

class Ustadz extends BaseController
{
    protected $absensiModel;
    protected $santriModel;
    protected $hafalanModel;
    protected $pengumumanModel;
    protected $jadwalModel;
    protected $orangTuaModel;

    public function __construct()
    {
        $this->absensiModel = new \App\Models\AbsensiModel();
        $this->santriModel = new \App\Models\SantriModel();
        $this->hafalanModel = new \App\Models\HafalanModel();
        $this->pengumumanModel = new \App\Models\PengumumanModel();
        $this->jadwalModel = new \App\Models\JadwalModel();
        $this->orangTuaModel = new \App\Models\OrangTuaModel();
    }

    public function dashboard()
    {
        $id_ustadz = session()->get('id');
        $db = \Config\Database::connect();
        
        // Ensure 'nilai' column exists for statistics
        if (!$db->fieldExists('nilai', 'hafalan')) {
            $db->query("ALTER TABLE hafalan ADD COLUMN nilai FLOAT DEFAULT 0 AFTER status;");
        }
        if (!$db->fieldExists('kategori', 'hafalan')) {
            $db->query("ALTER TABLE hafalan ADD COLUMN kategori VARCHAR(50) DEFAULT 'Hafalan Baru' AFTER nilai;");
        }
        
        // 1. Ambil Stats Global
        // Total Kelas Diajar (berdasarkan jadwal) - Fix for only_full_group_by
        $total_kelas_row = $db->table('jadwal')
            ->where('id_ustadz', $id_ustadz)
            ->select('COUNT(DISTINCT id_kelas) AS total', false)
            ->get()->getRow();
        $total_kelas = $total_kelas_row->total ?? 0;
        
        // Total Santri Binaan (langsung atau via kelas)
        $santri_binaan = $db->table('santri')
            ->select('santri.id')
            ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
            ->groupStart()
                ->where('santri.id_ustadz', $id_ustadz)
                ->orWhere('kelas.id_ustadz', $id_ustadz)
                ->orWhere("kelas.id IN (SELECT id_kelas FROM kelas_ustadz WHERE id_ustadz = $id_ustadz)")
            ->groupEnd()
            ->get()->getResultArray();
        
        $santri_ids = array_column($santri_binaan, 'id');
        $total_santri = count($santri_ids);
        
        // % Kehadiran Hari Ini
        $kehadiran = 0;
        if ($total_santri > 0) {
            $present_count = $db->table('absensi')
                ->whereIn('id_santri', $santri_ids)
                ->where('tanggal', date('Y-m-d'))
                ->whereIn('status', ['Hadir', 'Izin', 'Sakit']) // Anggap yang tidak Alpa itu 'hadir' dalam konteks partisipasi
                ->countAllResults();
            $kehadiran = round(($present_count / $total_santri) * 100);
        }
        
        // Rata-rata Nilai Hafalan
        $avg_nilai = 0;
        if ($total_santri > 0) {
            $avg_result = $db->table('hafalan')
                ->whereIn('id_santri', $santri_ids)
                ->selectAvg('nilai', 'rata_rata')
                ->get()->getRow();
            $avg_nilai = $avg_result->rata_rata ?? 0;
        }
        
        // 2. Setoran Hafalan Terkini (5 Terakhir)
        $recent_hafalan = [];
        if ($total_santri > 0) {
            $recent_hafalan = $db->table('hafalan')
                ->select('hafalan.*, santri.nama_santri, santri.nis')
                ->join('santri', 'santri.id = hafalan.id_santri')
                ->whereIn('hafalan.id_santri', $santri_ids)
                ->orderBy('hafalan.tanggal', 'DESC')
                ->orderBy('hafalan.created_at', 'DESC')
                ->limit(5)
                ->get()->getResultArray();
        }
        
        // 3. Pengumuman Terbar (Info Sekolah)
        $pengumuman = $this->pengumumanModel->getPengumumanByRole('ustadz');
        
        $data = [
            'judul'             => 'Dashboard Ustadz',
            'today'             => date('d M Y'),
            'nama_ustadz'       => session()->get('nama_lengkap') ?? 'Ustadz',
            'total_santri'      => $total_santri,
            'total_kelas'       => $total_kelas,
            'kehadiran'         => $kehadiran,
            'avg_nilai'         => number_format($avg_nilai, 1),
            'recent_hafalan'    => $recent_hafalan,
            'pengumuman'        => $pengumuman
        ];
        
        return view('ustadz/dashboard', $data);
    }

    // =========================================================
    // NEW USTADZ PAGES (MOCKUP)
    // =========================================================
    public function santri()
    {
        $id_ustadz = session()->get('id');
        $db = \Config\Database::connect();
        
        $santri = $db->table('santri')
            ->select('santri.*, kelas.nama_kelas')
            ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
            ->groupStart()
                ->where('santri.id_ustadz', $id_ustadz)
                ->orWhere('kelas.id_ustadz', $id_ustadz)
                ->orWhere("kelas.id IN (SELECT id_kelas FROM kelas_ustadz WHERE id_ustadz = $id_ustadz)")
            ->groupEnd()
            ->orderBy('santri.nama_santri', 'ASC')
            ->get()
            ->getResultArray();
            
        $data = [
            'judul' => 'Data Santri Binaan',
            'santri' => $santri,
            'nama_ustadz' => session()->get('nama_lengkap') ?? 'Ustadz'
        ];
        return view('ustadz/santri', $data);
    }

    public function santriDetail($id)
    {
        $id_ustadz = session()->get('id');
        $db = \Config\Database::connect();
        
        // 1. Ambil data santri dasar & pastikan akses (dibimbing ustadz ini)
        $santri = $db->table('santri')
            ->select('santri.*, kelas.nama_kelas, kelas.id_ustadz as id_ustadz_kelas')
            ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
            ->where('santri.id', $id)
            ->get()->getRowArray();
            
        if (!$santri) {
            return redirect()->to('/ustadz/santri')->with('error', 'Santri tidak ditemukan.');
        }
        
        // Validasi akses: harus ustadz pembimbing langsung, wali kelas, atau pengampu
        $db = \Config\Database::connect();
        $isPengampu = $db->table('kelas_ustadz')
            ->where('id_kelas', $santri['id_kelas'])
            ->where('id_ustadz', $id_ustadz)
            ->countAllResults() > 0;

        if ($santri['id_ustadz'] != $id_ustadz && $santri['id_ustadz_kelas'] != $id_ustadz && !$isPengampu) {
            return redirect()->to('/ustadz/santri')->with('error', 'Anda tidak memiliki akses ke data santri ini.');
        }
        
        // 2. Ambil data Orang Tua
        $parent = null;
        if ($santri['id_ortu']) {
            $parent = $this->orangTuaModel->where('id_user', $santri['id_ortu'])->first();
        }
        
        // 3. Ambil Riwayat Hafalan (10 Terakhir)
        $riwayat_hafalan = $this->hafalanModel
            ->where('id_santri', $id)
            ->orderBy('tanggal', 'DESC')
            ->limit(10)
            ->findAll();
            
        // 4. Statistik Absensi (Rekap)
        $rekap_absensi = $db->table('absensi')
            ->select('status, COUNT(*) as jumlah')
            ->where('id_santri', $id)
            ->groupBy('status')
            ->get()->getResultArray();
            
        $stats_absensi = [
            'Hadir' => 0, 'Izin' => 0, 'Sakit' => 0, 'Alpa' => 0, 'Total' => 0
        ];
        foreach ($rekap_absensi as $r) {
            if (isset($stats_absensi[$r['status']])) {
                $stats_absensi[$r['status']] = (int)$r['jumlah'];
            }
            $stats_absensi['Total'] += (int)$r['jumlah'];
        }
        
        // 5. Rata-rata Nilai
        $avg_result = $db->table('hafalan')
            ->where('id_santri', $id)
            ->selectAvg('nilai', 'rata_rata')
            ->get()->getRow();
        $avg_nilai = $avg_result->rata_rata ?? 0;
            
        $data = [
            'judul'           => 'Detail Santri: ' . $santri['nama_santri'],
            'santri'          => $santri,
            'parent'          => $parent,
            'riwayat_hafalan' => $riwayat_hafalan,
            'stats_absensi'   => $stats_absensi,
            'avg_nilai'       => number_format($avg_nilai, 1),
            'nama_ustadz'     => session()->get('nama_lengkap') ?? 'Ustadz'
        ];
        
        return view('ustadz/santri_detail', $data);
    }

    public function kelas()
    {
        $id_ustadz = session()->get('id');
        
        $db = \Config\Database::connect();
        $kelas = $db->table('kelas')
            ->select('kelas.*')
            ->groupStart()
                ->where('kelas.id_ustadz', $id_ustadz)
                ->orWhere("kelas.id IN (SELECT id_kelas FROM kelas_ustadz WHERE id_ustadz = $id_ustadz)")
            ->groupEnd()
            ->orderBy('kelas.nama_kelas', 'ASC')
            ->get()
            ->getResultArray();
        
        // Ambil jumlah Santi per kelas
        foreach ($kelas as &$k) {
            $k['santri_list'] = $db->table('santri')
                ->where('id_kelas', $k['id'])
                ->orderBy('nama_santri', 'ASC')
                ->get()
                ->getResultArray();
            $k['jumlah_santri'] = count($k['santri_list']);
        }
        
        $data = [
            'judul' => 'Kelas Saya',
            'kelas' => $kelas
        ];
        return view('ustadz/kelas', $data);
    }

    public function absensi()
    {
        $id_ustadz = session()->get('id');
        $tanggal = $this->request->getGet('tanggal') ?? date('Y-m-d');

        // Ambil santri yang dibimbing oleh ustadz tersebut secara langsung, atau lewat rombel kelas
        $db = \Config\Database::connect();
        $santri = $db->table('santri')
            ->select('santri.*, kelas.nama_kelas')
            ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
            ->groupStart()
                ->where('santri.id_ustadz', $id_ustadz)
                ->orWhere('kelas.id_ustadz', $id_ustadz)
                ->orWhere("kelas.id IN (SELECT id_kelas FROM kelas_ustadz WHERE id_ustadz = $id_ustadz)")
            ->groupEnd()
            ->orderBy('santri.nama_santri', 'ASC')
            ->get()
            ->getResultArray();

        $riwayat = $this->absensiModel->getAbsensiByDateAndUstadz($tanggal, $id_ustadz);
        $riwayatMapped = [];
        foreach($riwayat as $r) {
            $riwayatMapped[$r['id_santri']] = $r;
        }

        $data = [
            'judul' => 'Kehadiran Santri',
            'santri' => $santri,
            'tanggal' => $tanggal,
            'riwayat' => $riwayatMapped
        ];

        return view('ustadz/absensi', $data);
    }

    public function storeAbsensi()
    {
        $id_ustadz = session()->get('id');
        $tanggal = $this->request->getPost('tanggal');
        $absensiData = $this->request->getPost('absensi'); // array: id_santri => [status, keterangan]
        
        if(!$absensiData) {
            return redirect()->back()->with('error', 'Tidak ada data absensi yang dikirim.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        foreach($absensiData as $id_santri => $data) {
            $status = $data['status'] ?? 'Hadir';
            $keterangan = $data['keterangan'] ?? null;

            // Cek apakah sudah diabsen pada tanggal yang sama
            $existing = $this->absensiModel->where('tanggal', $tanggal)
                                           ->where('id_santri', $id_santri)
                                           ->where('id_ustadz', $id_ustadz)
                                           ->first();

            if($existing) {
                $this->absensiModel->update($existing['id'], [
                    'status' => $status,
                    'keterangan' => $keterangan
                ]);
            } else {
                $this->absensiModel->insert([
                    'id_santri' => $id_santri,
                    'tanggal' => $tanggal,
                    'status' => $status,
                    'keterangan' => $keterangan,
                    'id_ustadz' => $id_ustadz
                ]);
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menyimpan absensi.');
        }

        return redirect()->to('/ustadz/absensi?tanggal=' . $tanggal)->with('success', 'Data absensi berhasil disimpan.');
    }

    public function hafalan()
    {
        $id_ustadz = session()->get('id');
        $riwayatHafalan = $this->hafalanModel->getHafalanByUstadz($id_ustadz);
        
        // Ambil santri yang dibimbing untuk opsi tambah
        $db = \Config\Database::connect();
        $santri = $db->table('santri')
            ->select('santri.id, santri.nama_santri')
            ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
            ->groupStart()
                ->where('santri.id_ustadz', $id_ustadz)
                ->orWhere('kelas.id_ustadz', $id_ustadz)
                ->orWhere("kelas.id IN (SELECT id_kelas FROM kelas_ustadz WHERE id_ustadz = $id_ustadz)")
            ->groupEnd()
            ->orderBy('santri.nama_santri', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'judul' => 'Catat Hafalan Santri',
            'riwayat' => $riwayatHafalan,
            'santriList' => $santri
        ];

        return view('ustadz/hafalan', $data);
    }

    public function storeHafalan()
    {
        $db = \Config\Database::connect();
        
        if (!$db->fieldExists('nilai', 'hafalan')) {
            $db->query("ALTER TABLE hafalan ADD COLUMN nilai FLOAT DEFAULT 0 AFTER status;");
        }
        if (!$db->fieldExists('kategori', 'hafalan')) {
            $db->query("ALTER TABLE hafalan ADD COLUMN kategori VARCHAR(50) DEFAULT 'Hafalan Baru' AFTER nilai;");
        }
        
        $rules = [
            'id_santri' => 'required|integer',
            'surah' => 'required',
            'ayat_awal' => 'required|integer',
            'ayat_akhir' => 'required|integer',
            'status' => 'required|in_list[Lancar,Sedang,Mengulang]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->hafalanModel->save([
            'id_santri' => $this->request->getPost('id_santri'),
            'tanggal' => $this->request->getPost('tanggal') ?: date('Y-m-d'),
            'surah' => $this->request->getPost('surah'),
            'ayat_awal' => $this->request->getPost('ayat_awal'),
            'ayat_akhir' => $this->request->getPost('ayat_akhir'),
            'status' => $this->request->getPost('status'),
            'nilai' => $this->request->getPost('nilai') ?: 0,
            'kategori' => 'Hafalan Baru',
            'id_ustadz' => session()->get('id'),
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/ustadz/hafalan')->with('success', 'Catatan hafalan berhasil ditambahkan.');
    }

    public function updateHafalan($id)
    {
        $rules = [
            'surah' => 'required',
            'ayat_awal' => 'required|integer',
            'ayat_akhir' => 'required|integer',
            'status' => 'required|in_list[Lancar,Sedang,Mengulang]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->hafalanModel->update($id, [
            'tanggal' => $this->request->getPost('tanggal') ?: date('Y-m-d'),
            'surah' => $this->request->getPost('surah'),
            'ayat_awal' => $this->request->getPost('ayat_awal'),
            'ayat_akhir' => $this->request->getPost('ayat_akhir'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/ustadz/hafalan')->with('success', 'Catatan hafalan berhasil diperbarui.');
    }

    public function deleteHafalan($id)
    {
        // Pastikan hafalan ini milik ustadz yang login, validasi keamanan tambahan
        $hafalan = $this->hafalanModel->find($id);
        if($hafalan && $hafalan['id_ustadz'] == session()->get('id')) {
            $this->hafalanModel->delete($id);
            return redirect()->to('/ustadz/hafalan')->with('success', 'Catatan hafalan berhasil dihapus.');
        }
        return redirect()->to('/ustadz/hafalan')->with('error', 'Gagal menghapus atau Anda tidak memiliki akses.');
    }

    public function jadwal()
    {
        $id_ustadz = session()->get('id');
        
        $db = \Config\Database::connect();
        
        try {
            $jadwal = $db->table('jadwal')
                ->select('jadwal.*, kelas.nama_kelas')
                ->join('kelas', 'kelas.id = jadwal.id_kelas', 'left')
                ->where('jadwal.id_ustadz', $id_ustadz)
                ->get()
                ->getResultArray();
            
            $hariOrder = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7];
            usort($jadwal, function($a, $b) use ($hariOrder) {
                $dayA = $hariOrder[$a['hari']] ?? 8;
                $dayB = $hariOrder[$b['hari']] ?? 8;
                if ($dayA === $dayB) {
                    return strcmp($a['jam_mulai'] ?? '', $b['jam_mulai'] ?? '');
                }
                return $dayA - $dayB;
            });
        } catch (\Exception $e) {
            $jadwal = [];
        }
        
        $data = [
            'judul' => 'Jadwal Mengajar',
            'jadwal' => $jadwal
        ];
    }
    
    public function murojaah()
    {
        $id_ustadz = session()->get('id');
        $db = \Config\Database::connect();
        
        if (!$db->fieldExists('nilai', 'hafalan')) {
            $db->query("ALTER TABLE hafalan ADD COLUMN nilai FLOAT DEFAULT 0 AFTER status;");
        }
        if (!$db->fieldExists('kategori', 'hafalan')) {
            $db->query("ALTER TABLE hafalan ADD COLUMN kategori VARCHAR(50) DEFAULT 'Hafalan Baru' AFTER nilai;");
        }
        
        $riwayatMurojaah = $db->table('hafalan')
            ->select('hafalan.*, santri.nama_santri, santri.nis, kelas.nama_kelas')
            ->join('santri', 'santri.id = hafalan.id_santri', 'left')
            ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
            ->where('hafalan.id_ustadz', $id_ustadz)
            ->where('hafalan.kategori', 'Murojaah')
            ->orderBy('hafalan.tanggal', 'DESC')
            ->get()
            ->getResultArray();
            
        // Ambil santri yang dibimbing untuk opsi tambah
        $santri = $db->table('santri')
            ->select('santri.id, santri.nama_santri')
            ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
            ->groupStart()
                ->where('santri.id_ustadz', $id_ustadz)
                ->orWhere('kelas.id_ustadz', $id_ustadz)
                ->orWhere("kelas.id IN (SELECT id_kelas FROM kelas_ustadz WHERE id_ustadz = $id_ustadz)")
            ->groupEnd()
            ->orderBy('santri.nama_santri', 'ASC')
            ->get()
            ->getResultArray();

        $data = [
            'judul' => 'Muroja\'ah Santri',
            'riwayat' => $riwayatMurojaah,
            'santriList' => $santri
        ];

        return view('ustadz/murojaah', $data);
    }

    public function storeMurojaah()
    {
        $db = \Config\Database::connect();
        
        if (!$db->fieldExists('nilai', 'hafalan')) {
            $db->query("ALTER TABLE hafalan ADD COLUMN nilai FLOAT DEFAULT 0 AFTER status;");
        }
        if (!$db->fieldExists('kategori', 'hafalan')) {
            $db->query("ALTER TABLE hafalan ADD COLUMN kategori VARCHAR(50) DEFAULT 'Hafalan Baru' AFTER nilai;");
        }
        
        $rules = [
            'id_santri' => 'required|integer',
            'surah' => 'required',
            'ayat_awal' => 'required|integer',
            'ayat_akhir' => 'required|integer',
            'status' => 'required|in_list[Lancar,Sedang,Mengulang]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->hafalanModel->save([
            'id_santri' => $this->request->getPost('id_santri'),
            'tanggal' => $this->request->getPost('tanggal') ?: date('Y-m-d'),
            'surah' => $this->request->getPost('surah'),
            'ayat_awal' => $this->request->getPost('ayat_awal'),
            'ayat_akhir' => $this->request->getPost('ayat_akhir'),
            'status' => $this->request->getPost('status'),
            'nilai' => $this->request->getPost('nilai') ?: 0,
            'kategori' => 'Murojaah',
            'id_ustadz' => session()->get('id'),
            'keterangan' => $this->request->getPost('keterangan')
        ]);

        return redirect()->to('/ustadz/murojaah')->with('success', 'Catatan muroja\'ah berhasil ditambahkan.');
    }

    public function progresKelas()
    {
        $id_ustadz = session()->get('id');
        $db = \Config\Database::connect();
        
        // Ambil kelas yang diampu ustadz
        $kelas = $db->table('kelas')
            ->select('kelas.*')
            ->groupStart()
                ->where('id_ustadz', $id_ustadz)
                ->orWhere("kelas.id IN (SELECT id_kelas FROM kelas_ustadz WHERE id_ustadz = $id_ustadz)")
            ->groupEnd()
            ->get()
            ->getResultArray();
            
        $progres = [];
        foreach($kelas as $k) {
            $id_kelas = $k['id'];
            
            // Total Santri di kelas
            $total_santri = $db->table('santri')
                ->where('id_kelas', $id_kelas)
                ->countAllResults();
                
            // Hitung rata-rata progres
            $stats = $db->table('hafalan')
                ->selectAvg('nilai', 'avg_nilai')
                ->selectCount('hafalan.id', 'total_setoran')
                ->join('santri', 'santri.id = hafalan.id_santri')
                ->where('santri.id_kelas', $id_kelas)
                ->get()
                ->getRowArray();
                
            // Top student
            $top_student = $db->table('hafalan')
                ->select('santri.nama_santri, count(hafalan.id) as total')
                ->join('santri', 'santri.id = hafalan.id_santri')
                ->where('santri.id_kelas', $id_kelas)
                ->groupBy('hafalan.id_santri')
                ->orderBy('total', 'DESC')
                ->limit(1)
                ->get()
                ->getRowArray();
                
            $progres[] = [
                'kelas' => $k,
                'total_santri' => $total_santri,
                'avg_nilai' => number_format($stats['avg_nilai'] ?? 0, 1),
                'total_setoran' => $stats['total_setoran'] ?? 0,
                'top_student' => $top_student['nama_santri'] ?? '-'
            ];
        }
        
        $data = [
            'judul' => 'Progres Kelas',
            'progres' => $progres
        ];
        
        return view('ustadz/progres_kelas', $data);
    }
}
