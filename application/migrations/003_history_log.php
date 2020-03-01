<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 22/06/2019
 * Time: 13:00
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_History_log extends CI_Migration {

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
            'Richiesta' =>  array(
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ),
            'URL'       =>  array(
                'type'          =>  'VARCHAR',
                'constraint'    =>  '100'
            ),
            'Esito'     =>  array(
                'type'          =>  'INT',
                'constraint'    =>  1
            ),
            'Request'   =>  array(
                'type'          =>  'JSON'
            ),
            'Response'  =>  array(
                'type'          =>  'JSON'
            )
        ));

        $this->dbforge->add_field("CreatedAt timestamp NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('ID', TRUE);
        $this->dbforge->create_table('et_history_log');

    }


    public function down(){
        $this->dbforge->drop_table('et_history_log');
    }

}
