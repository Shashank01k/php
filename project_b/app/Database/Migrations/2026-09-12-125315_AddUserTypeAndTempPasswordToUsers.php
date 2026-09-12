<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserTypeAndTempPasswordToUsers extends Migration
{
     public function up()
    {
        $fields = [
            'user_type' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => true,
                'default'    => null,
                'comment'    => '1 Super Admin, 2 Admin, 3 Sub Admin, 4 User',
                'after'     => 'email',
            ],

            'temp_password' => [
                'type'    => 'VARCHAR',
                'constraint' => 255,
                'null'    => true,
                'default' => null,
                'comment' => 'Token for password reset or authentication',
                'after'  => 'password',
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', [
            'user_type',
            'temp_password'
        ]);
    }
}
