<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 25/06/2019
 * Time: 10:09
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Statistiche_preventivi extends CI_Migration {

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
            'Piattaforma' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '10'
            ),
            'Budget' =>  array(
                'type'          => 'VARCHAR',
                'constraint'    => '300'
            ),
            'Email'       =>  array(
                'type'          =>  'VARCHAR',
                'constraint'    =>  '150'
            ),
            'Location'     =>  array(
                'type'          =>  'VARCHAR',
                'constraint'    =>  '100'
            ),
            'IP'   =>  array(
                'type'          =>  'VARCHAR',
                'constraint'    =>  '100',
                'unique'        => TRUE
            )
        ));

        $this->dbforge->add_field("CreatedAt timestamp NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('ID', TRUE);
        $this->dbforge->create_table('et_statistiche_preventivi');

    }


    public function down(){
        $this->dbforge->drop_table('et_statistiche_preventivi');
    }

}
