<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 03/06/2019
 * Time: 10:06
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('OpenService');
    }


    public function Send()
    {
        $Response   =   array();
        $IP         =   $this->input->ip_address() == '::1' ? 'localhost' : $this->input->ip_address();
        $City       =   $IP == 'localhost' ? '': (json_decode($this->OpenService->GeoLocation($IP))->city);

        $Data   =   array(
            'Piattaforma'   =>  $this->input->post('platform'),
            'Budget'        =>  $this->input->post('budget'),
            'Email'         =>  $this->input->post('email'),
            'Location'      =>  $City,
            'IP'            =>  $IP
         );

        $this->form_validation->set_rules('platform', 'Piattaforma', 'trim|required|min_length[2]|max_length[10]');
        $this->form_validation->set_rules('budget', 'Budget', 'trim|required|required|regex_match[/^[0-9]{1,10}$/]');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if($this->form_validation->run())
        {
             $Insert = $this->db->query("insert into et_statistiche_preventivi(Piattaforma,Budget,Email,Location,IP) values (?,?,?,?,?) on duplicate key update Piattaforma=VALUES(Piattaforma),Budget=VALUES(Budget),Email=VALUES(Email);",$Data);

             if($Insert){
                 $Response  =   array(
                     'insert_analytics' => "Success Send",
                     'message'          =>  'Record Inserito',
                     'code'             =>   200
                 );
             }else{
                 $Response  =   array(
                     'insert_analytics'    =>  'fail',
                     'message'              =>  'Database error'
                 );
             }

        }else{
            $Response =    array(
                'insert_analytics'     =>  'fail',
                'message'              =>  'Formato non valido'
            );
        }


        $this->load->view('api/json', array('response' => $Response));

    }



    //Per calcolare la percentuale
    public function Record(){
       if(asLogged()) return $this->db->query('select count(*) line from et_statistiche_preventivi;');
    }

    public function Piattaforma(){
        if(asLogged()) return $this->db->query('select count(*) as Richieste,Piattaforma from et_statistiche_preventivi group by piattaforma;');
    }

    public function Location(){
        if(asLogged()) return $this->db->query('select count(*) as Richieste,Location from et_statistiche_preventivi group by Location order by Richieste desc;');
    }

    public function Budget(){
        if(asLogged()) return $this->db->query('select count(*) as Richieste,Budget from et_statistiche_preventivi group by Budget order by Richieste desc;');
    }


    public function getAll(){
        if(asLogged()) {
            $Data   =   array(
                'piattaforma' => $this->Piattaforma()->result(),
                'location'    => $this->Location()->result(),
                'budget'      => $this->Budget()->result(),
                'record'      => $this->Record()->result()
            );

            echo json_encode($Data);
        }
    }

    public function Prints($Tipo)
    {
        if(asLogged()){
            if(method_exists($this,$Tipo) && strtolower($Tipo) != 'getall' ){
                $Result = ($this->{$Tipo}());
                echo json_encode();
            }else{
                self::getAll();
            }
        }
    }


}