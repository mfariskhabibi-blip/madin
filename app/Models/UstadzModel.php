<?php

namespace App\Models;

use CodeIgniter\Model;

class UstadzModel extends Model
{
    protected $table            = 'ustadz';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user', 
        'nip', 
        'nama_lengkap', 
        'jenis_kelamin', 
        'tanggal_lahir', 
        'alamat', 
        'no_telepon', 
        'pendidikan', 
        'bidang_keahlian', 
        'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Mengambil data spesifik ustadz beserta info akunnya
    public function getUstadzWithUser()
    {
        return $this->select('ustadz.*, users.username, users.email')
                    ->join('users', 'users.id = ustadz.id_user', 'left')
                    ->findAll();
    }
}
