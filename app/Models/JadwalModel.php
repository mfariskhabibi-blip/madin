<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kelas',
        'nama_kegiatans',
        'deskripsi',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'id_ustadz'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get all schedules with related class and ustadz data
     */
    public function getJadwalWithDetails()
    {
        return $this->select('jadwal.*, kelas.nama_kelas, ustadz.nama_lengkap as nama_ustadz')
            ->join('kelas', 'kelas.id = jadwal.id_kelas', 'left')
            ->join('ustadz', 'ustadz.id_user = jadwal.id_ustadz', 'left')
            ->orderBy('FIELD(jadwal.hari, "Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu")', 'ASC')
            ->orderBy('jadwal.jam_mulai', 'ASC')
            ->findAll();
    }

    /**
     * Get schedule for a specific ustadz
     */
    public function getJadwalByUstadz($id_ustadz)
    {
        return $this->select('jadwal.*, kelas.nama_kelas')
            ->join('kelas', 'kelas.id = jadwal.id_kelas', 'left')
            ->where('jadwal.id_ustadz', $id_ustadz)
            ->orderBy('FIELD(jadwal.hari, "Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu")', 'ASC')
            ->orderBy('jadwal.jam_mulai', 'ASC')
            ->findAll();
    }

    /**
     * Get schedules for multiple classes (for Ortu view)
     */
    public function getJadwalByKelasIds($kelas_ids)
    {
        if (empty($kelas_ids)) return [];
        return $this->select('jadwal.*, kelas.nama_kelas, ustadz.nama_lengkap as nama_ustadz')
            ->join('kelas', 'kelas.id = jadwal.id_kelas', 'left')
            ->join('ustadz', 'ustadz.id_user = jadwal.id_ustadz', 'left')
            ->whereIn('jadwal.id_kelas', $kelas_ids)
            ->orderBy('FIELD(jadwal.hari, "Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu")', 'ASC')
            ->orderBy('jadwal.jam_mulai', 'ASC')
            ->findAll();
    }
}
