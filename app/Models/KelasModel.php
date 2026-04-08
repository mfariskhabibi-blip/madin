<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table            = 'kelas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_kelas', 
        'deskripsi', 
        'id_ustadz'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Mengambil kelas beserta nama ustadz pengampunya jika diset
    public function getKelasWithUstadz()
    {
        return $this->select('kelas.*, ustadz.nama_lengkap as nama_wali_kelas')
                    ->join('users as ustadz', 'ustadz.id = kelas.id_ustadz', 'left')
                    ->findAll();
    }
}
