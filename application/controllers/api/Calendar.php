<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 08/07/2019
 * Time: 10:10
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller{

    public function sendRequest()
    {
        $Response   =   array();
        if(asLogged())
        {
            $Request    =   array
            (
                'descrizione'   =>  $this->input->post('description'),
                'data'          =>  $this->input->post('data'),
                'time'          =>  $this->input->post('time')
            );

            $this->form_validation->set_rules('description','Descrizione','required|min_length[3]|max_length[40]');
            $this->form_validation->set_rules('time','Time');
            $this->form_validation->set_rules('data','Data');


            if($this->form_validation->run())
            {

                $Add = $this->db->insert('et_calendar',array(
                    'Operatore'     =>  $this->session->logged_in["username"],
                    'eventState'    =>  1,
                    'Descrizione'   =>  $Request['descrizione'],
                    'eventDate'     =>  $Request['data'].' '.$Request['time'].':00'
                ));


                if($Add){
                    $Response['esito']      =   'success';
                    $Response['message']    =   'Evento aggiunto correttamente';
                }else {
                    $Response['esito']      =   'fail';
                    $Response['message']    =   'Errore inserimento evento';
                }
            }else{
                $Response['esito']      =   'fail';
                $Response['message']    =   'formato non valido';
            }
        }else
        {
            $Response['esito']          =   'fail';
            $Response['message']        =   'Permessi non validi';
        }

        $this->load->view('api/json', array('response' => $Response));
    }


    public function readRequest(){
        $Response   =   array();

        if(asLogged())
        {
            $Query  =   $this->db->query('select * from et_calendar where Operatore = ? and eventState = ?',array($this->session->logged_in["username"],1))->result();
            foreach ($Query as $index => $item){
                $eventDate          =   explode(' ',$item->eventDate);
                $Response[$index]   =   array(
                    'title'         =>  $item->Descrizione,
                    'start'         =>  $eventDate[0]."T".$eventDate[1]
                );
            }
        }else{
            $Response['esito']      =   'fail';
            $Response['message']    =   'Non sei loggato';
        }


        $this->load->view('api/json', array('response' => $Response));

    }

}
