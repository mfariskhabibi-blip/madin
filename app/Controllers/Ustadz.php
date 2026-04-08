<?php

namespace App\Controllers;

class Ustadz extends BaseController
{
    protected $absensiModel;
    protected $santriModel;
    protected $hafalanModel;
    protected $pengumumanModel;
    protected $jadwalModel;

    public function __construct()
    {
        $this->absensiModel = new \App\Models\AbsensiModel();
        $this->santriModel = new \App\Models\SantriModel();
        $this->hafalanModel = new \App\Models\HafalanModel();
        $this->pengumumanModel = new \App\Models\PengumumanModel();
        $this->jadwalModel = new \App\Models\JadwalModel();
    }

    public function dashboard()
    {
        $pengumuman = $this->pengumumanModel->getPengumumanByRole('ustadz');
        
        $db = \Config\Database::connect();
        $id_ustadz = session()->get('id');
        
        $total_kelas = $db->table('kelas')->where('id_ustadz', $id_ustadz)->countAllResults();
        
        $santri_diampu = $db->table('santri')
            ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
            ->groupStart()
                ->where('santri.id_ustadz', $id_ustadz)
                ->orWhere('kelas.id_ustadz', $id_ustadz)
            ->groupEnd()
            ->countAllResults();
        
        $data = [
            'judul' => 'Dashboard Ustadz',
            'nama_ustadz' => session()->get('nama_lengkap') ?? 'Ustadz PTQ',
            'pengumuman' => $pengumuman,
            'total_kelas' => $total_kelas,
            'total_santri_diampu' => $santri_diampu,
            'jadwal_mengajar' => []
        ];
        return view('ustadz/dashboard', $data);
    }

    // =========================================================
    // NEW USTADZ PAGES (MOCKUP)
    // =========================================================
    public function kelas()
    {
        $id_ustadz = session()->get('id');
        
        $db = \Config\Database::connect();
        $kelas = $db->table('kelas')
            ->select('kelas.*')
            ->where('kelas.id_ustadz', $id_ustadz)
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
        return view('ustadz/jadwal', $data);
    }
}
