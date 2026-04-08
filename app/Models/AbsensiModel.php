<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table            = 'absensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_santri', 
        'tanggal', 
        'status', 
        'keterangan', 
        'id_ustadz'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Mengambil riwayat absensi santri pada tanggal tertentu
    public function getAbsensiByDateAndUstadz($tanggal, $id_ustadz)
    {
        return $this->where('tanggal', $tanggal)
                    ->where('id_ustadz', $id_ustadz)
                    ->findAll();
    }

    // Mendapatkan riwayat absensi untuk daftar ID santri tertentu (untuk Ortu)
    public function getAbsensiBySantriIds($ids)
    {
        if (empty($ids)) return [];
        return $this->select('absensi.*, santri.nama_santri')
                    ->join('santri', 'santri.id = absensi.id_santri', 'left')
                    ->whereIn('absensi.id_santri', $ids)
                    ->orderBy('absensi.tanggal', 'DESC')
                    ->findAll();
    }
}
