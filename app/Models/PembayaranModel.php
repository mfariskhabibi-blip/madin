<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_santri', 
        'jenis_pembayaran', 
        'tanggal_bayar', 
        'jumlah', 
        'bukti_bayar', 
        'status', 
        'keterangan'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Memanggil semua data pembayaran beserta profil santri terkait
    public function getSemuaPembayaran()
    {
        return $this->select('pembayaran.*, santri.nama_santri, santri.nis')
                    ->join('santri', 'santri.id = pembayaran.id_santri', 'left')
                    ->orderBy('pembayaran.tanggal_bayar', 'DESC')
                    ->orderBy('pembayaran.created_at', 'DESC')
                    ->findAll();
    }

    // Mendapatkan data pembayaran untuk daftar ID santri tertentu (untuk Ortu)
    public function getPembayaranBySantriIds($ids)
    {
        if (empty($ids)) return [];
        return $this->select('pembayaran.*, santri.nama_santri')
                    ->join('santri', 'santri.id = pembayaran.id_santri', 'left')
                    ->whereIn('pembayaran.id_santri', $ids)
                    ->orderBy('pembayaran.status', 'ASC') // Pending first
                    ->orderBy('pembayaran.created_at', 'DESC')
                    ->findAll();
    }
}
