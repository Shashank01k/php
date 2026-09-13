<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAssignmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'technology' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],

            // User who will receive/complete the assignment
            'assigned_to' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
            ],

            // User who assigned the task
            'assigned_by' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
            ],

            // User who created/added this assignment
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
            ],

            // Assignment progress status
            'status' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'pending',
                    'in_progress',
                    'completed',
                    'cancelled',
                ],
                'default' => 'pending',
            ],

            // Active / inactive
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 1,
                'comment'    => '1 = Active, 0 = Inactive',
            ],

            'priority' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'low',
                    'medium',
                    'high',
                ],
                'default' => 'medium',
            ],

            'due_date' => [
                'type' => 'DATE',
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

        $this->forge->addKey('assigned_to');
        $this->forge->addKey('assigned_by');
        $this->forge->addKey('created_by');
        $this->forge->addKey('status');
        $this->forge->addKey('is_active');

        $this->forge->createTable('assignments');
    }

    public function down()
    {
        $this->forge->dropTable('assignments', true);
    }
}