<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 22/06/2019
 * Time: 10:08
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Payment_Request extends CI_Migration {

    public function up(){

        $this->dbforge->add_field(array
        (
            'ID' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Servizio' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ),
            'Importo' => array(
                'type'          => 'VARCHAR',
                'constraint'    => '40',
                'default'       => NULL
            ),
            'Email'     =>  array(
                'type'          => 'VARCHAR',
                'constraint'    => '100'
            ),
            'Stato'     =>  array(
                'type'          =>  'VARCHAR',
                'constraint'    =>  '100',
                'default'       =>  'pending'
            ),
            'Token_Pagina' =>  array(
                'type'          =>  'VARCHAR',
                'constraint'    =>  '200',
                'unique'        => TRUE
            ),
            'Token_Success' => array(
                'type'          =>  'VARCHAR',
                'constraint'    =>  '200',
                'unique'        =>  TRUE,
                'default'       =>  NULL
            )
        ));

        $this->dbforge->add_field("CreatedAt timestamp NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("PaidAt  timestamp NULL DEFAULT NULL");
        $this->dbforge->add_key('ID', TRUE);
        $this->dbforge->create_table('et_payment_request');

    }

    public function down(){
        $this->dbforge->drop_table('et_payment_request');
    }

}