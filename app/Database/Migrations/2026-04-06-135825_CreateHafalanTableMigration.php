<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHafalanTableMigration extends Migration
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
            'id_santri' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'surah' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ayat_awal' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'ayat_akhir' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Lancar', 'Sedang', 'Mengulang'],
                'default'    => 'Lancar',
            ],
            'id_ustadz' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->createTable('hafalan');
    }

    public function down()
    {
        $this->forge->dropTable('hafalan');
    }
}
