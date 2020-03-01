<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 20/06/2019
 * Time: 13:11
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class UserManager extends CI_Controller{


    function DeleteUser(){
        if(asLogged())
        {
            $Resp       =   array();
            $UserID     =   $this->input->post('userID');

            if(preg_match('/[0-9]/',$UserID)){
                $Delete     =   $this->db->delete('et_panel_users', array('id' => $UserID));
                if($Delete)
                {
                    $Resp   =   array(
                        'response'  =>  'success',
                        'message'   =>  'Utente Eliminato'
                    );
                }else
                {
                    $Resp   =   array(
                        'response'  =>  'fail',
                        'message'   =>  'Errore Eliminazione utente'
                    );
                }
            }else{
                $Resp   =   array(
                    'response'  =>  'fail',
                    'message'   =>  'Utente non valido'
                );
            }

            WriteNotes('Elimina Utente',$this->input->post(),$Resp,($Resp['response'] == 'success' ? 1 : 0));
            $this->load->view('api/json', array('response' => $Resp));
        }
    }





    function AddUser()
    {
        if(asLogged())
        {
            $Resp       =   array();
            $Request    =   array(
                'username'  =>  $this->input->post('username'),
                'password' =>   sha1($this->input->post('password')),
                'email'  =>     $this->input->post('email')
            );

            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('email', 'Email', 'required');


            if ($this->form_validation->run() == TRUE && (!count($this->db->query("select * from et_panel_users where username = ? or email = ?", array($Request['username'],$Request['email']))->result())))
            {

                $insert =   $this->db->insert('et_panel_users',$Request);

                if($insert)
                {
                    $Resp   =   array(
                        'response'  =>  'success',
                        'message'   =>  'Utente Aggiunto',
                        'rows'      =>   $this->db->query("select id,username,email,createdAt from et_panel_users where username = ?", array($Request['username']))->result()[0]
                    );
                }else
                {
                    $Resp   =   array(
                        'response'  =>  'fail',
                        'message'   =>  'Richiesta non valida'
                    );
                }
            }
            else
            {
                $Resp   =   array(
                    'response'  =>  'fail',
                    'message'   =>  'Assicurati che l utente non sia già presente'
                );
            }

            $Request['password']   =   '******';
            WriteNotes('Aggiunto utente',$Request,$Resp,($Resp['response'] == 'success' ? 1 : 0));
            $this->load->view('api/json', array('response' => $Resp));
        }
    }

}

