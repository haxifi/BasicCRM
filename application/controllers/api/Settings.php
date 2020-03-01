<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 04/06/2019
 * Time: 17:19
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller{


    function UpdatePass(){

        if(asLogged())
        {
            $Resp     = array();
            $Request  = $this->input->post(array('action', 'newPass'));
            $Condizione=    preg_match('/^[a-zA-Z0-9]{5,10}$/',$Request['newPass']);

                if($Condizione)
                {
                    $Param  =   array('password'  => sha1($Request['newPass']));
                    $this->db->where('username',$this->session->logged_in['username']);
                    if($this->db->update('et_panel_users',$Param)) {
                        $Resp = array(
                            'esito'         => 'success',
                            'messaggio'     =>  'Aggiornamento Riuscito'
                        );
                    }else{
                        $Resp = array(
                            'esito'         => 'warn',
                            'messaggio'     => 'Aggiornamento Fallito'
                        );
                    }

                }else{
                    $Resp = array(
                        'esito'         =>  'error',
                        'messaggio'     =>  'Formato password non valido'
                    );
                }


                $Request['newPass'] = '******';
                WriteNotes('Cambiato Password',$Request,$Resp, (($Resp['esito'] == 'success' ? 1 : 0)));
                $this->load->view('api/json', array('response' => $Resp));

        }

    }
}
