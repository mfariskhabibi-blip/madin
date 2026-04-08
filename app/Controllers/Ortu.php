<?php

namespace App\Controllers;

use App\Models\SantriModel;
use App\Models\HafalanModel;
use App\Models\AbsensiModel;
use App\Models\PembayaranModel;
use App\Models\PengumumanModel;

class Ortu extends BaseController
{
    protected $santriModel;
    protected $hafalanModel;
    protected $absensiModel;
    protected $pembayaranModel;
    protected $pengumumanModel;
    protected $jadwalModel;

    public function __construct()
    {
        $this->santriModel = new SantriModel();
        $this->hafalanModel = new HafalanModel();
        $this->absensiModel = new AbsensiModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->pengumumanModel = new PengumumanModel();
        $this->jadwalModel = new \App\Models\JadwalModel();
    }

    public function dashboard()
    {
        $id_ortu = session()->get('id');
        $anak = $this->santriModel->getChildrenByParent($id_ortu);
        $anak_ids = array_column($anak, 'id');

        $tagihan_pending = 0;
        if (!empty($anak_ids)) {
            $tagihan_pending = $this->pembayaranModel->whereIn('id_santri', $anak_ids)
                                                     ->where('status', 'Pending')
                                                     ->countAllResults();
        }

        $pengumuman = $this->pengumumanModel->getPengumumanByRole('ortu');

        $data = [
            'judul' => 'Dashboard Orang Tua',
            'nama_ortu' => session()->get('nama_lengkap') ?? 'Orang Tua Santri',
            'anak' => $anak,
            'tagihan_aktif' => $tagihan_pending,
            'pengumuman' => $pengumuman,
            'riwayat_pembayaran' => !empty($anak_ids) ? $this->pembayaranModel->getPembayaranBySantriIds($anak_ids) : []
        ];
        return view('ortu/dashboard', $data);
    }

    public function hafalan()
    {
        $id_ortu = session()->get('id');
        $anak = $this->santriModel->getChildrenByParent($id_ortu);
        $anak_ids = array_column($anak, 'id');

        $riwayat = !empty($anak_ids) ? $this->hafalanModel->getHafalanBySantriIds($anak_ids) : [];

        $data = [
            'judul' => 'Progres Hafalan Anak',
            'riwayat' => $riwayat,
            'anak' => $anak
        ];
        return view('ortu/hafalan', $data);
    }

    public function kehadiran()
    {
        $id_ortu = session()->get('id');
        $anak = $this->santriModel->getChildrenByParent($id_ortu);
        $anak_ids = array_column($anak, 'id');

        $riwayat = !empty($anak_ids) ? $this->absensiModel->getAbsensiBySantriIds($anak_ids) : [];

        $data = [
            'judul' => 'Kehadiran Santri',
            'riwayat' => $riwayat,
            'anak' => $anak
        ];
        return view('ortu/kehadiran', $data);
    }

    public function pembayaran()
    {
        $id_ortu = session()->get('id');
        $anak = $this->santriModel->getChildrenByParent($id_ortu);
        $anak_ids = array_column($anak, 'id');

        $riwayat = !empty($anak_ids) ? $this->pembayaranModel->getPembayaranBySantriIds($anak_ids) : [];

        $data = [
            'judul' => 'Status Pembayaran',
            'riwayat' => $riwayat,
            'anak' => $anak
        ];
        return view('ortu/pembayaran', $data);
    }

    public function saveBukti($id_pembayaran)
    {
        $id_ortu = session()->get('id');
        
        // Verifikasi kepemilikan tagihan
        $pembayaran = $this->pembayaranModel->find($id_pembayaran);
        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        $santri = $this->santriModel->find($pembayaran['id_santri']);
        if ($santri['id_ortu'] != $id_ortu) {
             return redirect()->back()->with('error', 'Anda tidak memiliki akses ke data ini.');
        }

        $img = $this->request->getFile('bukti_bayar');

        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            // Pindahkan ke folder public/uploads/bukti_bayar
            $img->move(FCPATH . 'uploads/bukti_bayar', $newName);

            $this->pembayaranModel->update($id_pembayaran, [
                'bukti_bayar' => $newName,
                'tanggal_bayar' => date('Y-m-d'), // Set tanggal bayar ke hari ini saat upload
                // Status tetap Pending sampai diverifikasi admin, atau bisa kita ganti logikenya
            ]);

            return redirect()->to('/ortu/pembayaran')->with('success', 'Bukti pembayaran berhasil diunggah. Tunggu verifikasi admin.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah file.');
    }

    public function jadwal()
    {
        $id_ortu = session()->get('id');
        $anak = $this->santriModel->getChildrenByParent($id_ortu);
        
        $kelas_ids = array_filter(array_column($anak, 'id_kelas'));
        $jadwal = !empty($kelas_ids) ? $this->jadwalModel->getJadwalByKelasIds($kelas_ids) : [];
        
        $data = [
            'judul' => 'Jadwal Pelajaran Anak',
            'anak'  => $anak,
            'jadwal' => $jadwal
        ];
        return view('ortu/jadwal', $data);
    }
}
