<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 08/07/2019
 * Time: 09:30
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Calendar   extends CI_Migration{

    public function up()
    {
        $this->dbforge->add_field(array
        (
            'ID' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Operatore' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '40'
            ),
            'Descrizione' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '40',
                'default'       => NULL
            ),
            'eventState'     =>  array(
                'type'          => 'INT',
                'constraint'    => 1
            )
        ));

        $this->dbforge->add_field("eventDate  timestamp NULL DEFAULT NULL");
        $this->dbforge->add_field("CreatedAt timestamp NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('ID', TRUE);
        $this->dbforge->create_table('et_calendar');
    }


    public function down(){
        $this->dbforge->drop_table('et_calendar');
    }

}