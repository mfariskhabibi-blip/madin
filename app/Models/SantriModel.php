<?php

namespace App\Models;

use CodeIgniter\Model;

class SantriModel extends Model
{
    protected $table            = 'santri';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nis', 
        'nama_santri', 
        'id_kelas', 
        'id_ortu', 
        'tanggal_lahir', 
        'jenis_kelamin', 
        'alamat', 
        'status', 
        'id_ustadz'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Mendapatkan data santri beserta informasi ortu dan kelas seandainya ada
    public function getSantriWithDetails()
    {
        // Untuk sekarang karena belum ada tabel kelas dll, kita join dengan user saja untuk Ortu & Ustadz
        return $this->select('santri.*, ortu.nama_lengkap as nama_ortu, ustadz.nama_lengkap as nama_ustadz')
                    ->join('users as ortu', 'ortu.id = santri.id_ortu', 'left')
                    ->join('users as ustadz', 'ustadz.id = santri.id_ustadz', 'left')
                    ->findAll();
    }

    // Mendapatkan semua santri yang dimiliki oleh wali murid tertentu
    public function getChildrenByParent($id_ortu)
    {
        return $this->select('santri.*, kelas.nama_kelas, ustadz.nama_lengkap as nama_ustadz')
                    ->join('kelas', 'kelas.id = santri.id_kelas', 'left')
                    ->join('ustadz', 'ustadz.id = santri.id_ustadz', 'left')
                    ->where('santri.id_ortu', $id_ortu)
                    ->findAll();
    }
}
