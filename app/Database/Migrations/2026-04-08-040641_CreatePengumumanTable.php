<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengumumanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'konten' => [
                'type' => 'TEXT',
            ],
            'kategori' => [
                'type'       => 'ENUM',
                'constraint' => ['Umum', 'Akademik', 'Keuangan', 'Penting'],
                'default'    => 'Umum',
            ],
            'target_role' => [
                'type'       => 'ENUM',
                'constraint' => ['ustadz', 'ortu', 'semua'],
                'default'    => 'semua',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['draft', 'terbit'],
                'default'    => 'terbit',
            ],
            'id_penulis' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_penulis', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pengumuman');
    }

    public function down()
    {
        $this->forge->dropTable('pengumuman');
    }
}
