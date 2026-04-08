<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'     => 'admin',
                'password'     => password_hash('admin123', PASSWORD_BCRYPT),
                'email'        => 'admin@ptqalhikmah.sch.id',
                'nama_lengkap' => 'Administrator PTQ',
                'role'         => 'admin',
                'avatar'       => 'default.png',
                'status'       => 'aktif',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'ustadz.ahmad',
                'password'     => password_hash('ustadz123', PASSWORD_BCRYPT),
                'email'        => 'ahmad@ptqalhikmah.sch.id',
                'nama_lengkap' => 'Ustadz Ahmad Fauzi',
                'role'         => 'ustadz',
                'avatar'       => 'default.png',
                'status'       => 'aktif',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'budi.santoso',
                'password'     => password_hash('ortu123', PASSWORD_BCRYPT),
                'email'        => 'budi@gmail.com',
                'nama_lengkap' => 'Budi Santoso',
                'role'         => 'ortu',
                'avatar'       => 'default.png',
                'status'       => 'aktif',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        // Gunakan insertBatch
        $this->db->table('users')->insertBatch($data);
    }
}
