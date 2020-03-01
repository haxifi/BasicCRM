<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 16/05/2019
 * Time: 17:30
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Panel_Users extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '40',
                'unique'        => TRUE
            ),
            'password' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '40',
            ),
            'email'     =>  array(
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'default'       => NULL,
                'unique'        => TRUE
            )
        ));

        $this->dbforge->add_field("createdAt timestamp NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('et_panel_users');
    }

    public function down()
    {
        $this->dbforge->drop_table('et_panel_users');
    }
}