<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasUstadzModel extends Model
{
    protected $table            = 'kelas_ustadz';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kelas', 'id_ustadz'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get all ustadz (users) for a specific class
     */
    public function getUstadzByKelas($id_kelas)
    {
        return $this->select('users.id, users.nama_lengkap, users.username')
                    ->join('users', 'users.id = kelas_ustadz.id_ustadz')
                    ->where('kelas_ustadz.id_kelas', $id_kelas)
                    ->findAll();
    }

    /**
     * Get all classes for a specific ustadz
     */
    public function getKelasByUstadz($id_ustadz)
    {
        return $this->select('kelas.*')
                    ->join('kelas', 'kelas.id = kelas_ustadz.id_kelas')
                    ->where('kelas_ustadz.id_ustadz', $id_ustadz)
                    ->findAll();
    }
}
