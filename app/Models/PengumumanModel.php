<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    protected $table            = 'pengumuman';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'judul', 
        'konten', 
        'kategori', 
        'target_role', 
        'status', 
        'id_penulis'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Mendapatkan pengumuman dengan detail penulis
     */
    public function getPengumumanWithAuthor($id = null)
    {
        $builder = $this->select('pengumuman.*, users.nama_lengkap as nama_penulis')
                        ->join('users', 'users.id = pengumuman.id_penulis', 'left');
        
        if ($id) {
            return $builder->find($id);
        }

        return $builder->orderBy('pengumuman.created_at', 'DESC')->findAll();
    }

    /**
     * Mendapatkan pengumuman berdasarkan target role
     */
    public function getPengumumanByRole($role)
    {
        return $this->select('pengumuman.*, users.nama_lengkap as nama_penulis')
                    ->join('users', 'users.id = pengumuman.id_penulis', 'left')
                    ->groupStart()
                        ->where('pengumuman.target_role', $role)
                        ->orWhere('pengumuman.target_role', 'semua')
                    ->groupEnd()
                    ->where('pengumuman.status', 'terbit')
                    ->orderBy('pengumuman.created_at', 'DESC')
                    ->findAll();
    }
}
