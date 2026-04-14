<?php

namespace App\Models;

use CodeIgniter\Model;

class HafalanModel extends Model
{
    protected $table            = 'hafalan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_santri', 
        'tanggal', 
        'surah', 
        'ayat_awal', 
        'ayat_akhir', 
        'status', 
        'nilai',
        'kategori',
        'id_ustadz', 
        'keterangan'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Mendapatkan riwayat hafalan beserta nama santri
    public function getHafalanByUstadz($id_ustadz)
    {
        return $this->select('hafalan.*, santri.nama_santri, santri.nis, kelas.nama_kelas')
                    ->join('santri', 'santri.id = hafalan.id_santri', 'left')
                    ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
                    ->where('hafalan.id_ustadz', $id_ustadz)
                    ->orderBy('hafalan.tanggal', 'DESC')
                    ->findAll();
    }

    // Mendapatkan riwayat hafalan untuk daftar ID santri tertentu (untuk Ortu)
    public function getHafalanBySantriIds($ids)
    {
        if (empty($ids)) return [];
        return $this->select('hafalan.*, santri.nama_santri, users.nama_lengkap as nama_ustadz')
                    ->join('santri', 'santri.id = hafalan.id_santri', 'left')
                    ->join('users', 'users.id = hafalan.id_ustadz', 'left')
                    ->whereIn('hafalan.id_santri', $ids)
                    ->orderBy('hafalan.tanggal', 'DESC')
                    ->findAll();
    }
}
