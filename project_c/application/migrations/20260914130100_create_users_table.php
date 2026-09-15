<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users_table extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150
            ],
            'mobile' => [
                'type'       => 'VARCHAR',
                'constraint' => 15
            ],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['Male', 'Female', 'Other']
            ],
            'state_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => TRUE
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->add_key('email', TRUE);

        $this->dbforge->create_table('users', TRUE);

        // Foreign key: users.state_id -> states.id
        $this->db->query('
            ALTER TABLE `users`
            ADD CONSTRAINT `fk_users_state`
            FOREIGN KEY (`state_id`)
            REFERENCES `states` (`id`)
            ON UPDATE CASCADE
            ON DELETE RESTRICT
        ');
    }

    public function down()
    {
        $this->dbforge->drop_table('users', TRUE);
    }
}