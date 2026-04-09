<?php

namespace App\Models;

use CodeIgniter\Model;

class OrangTuaModel extends Model
{
    protected $table            = 'orang_tua';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'nama_ayah',
        'nama_ibu',
        'no_telepon_ayah',
        'no_telepon_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'alamat'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get parent data with user login info
     */
    public function getOrangTuaWithUser()
    {
        return $this->select('orang_tua.*, users.username, users.email, users.nama_lengkap as nama_user')
                    ->join('users', 'users.id = orang_tua.id_user', 'left')
                    ->findAll();
    }
}
