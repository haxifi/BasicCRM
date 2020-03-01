<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 30/05/2019
 * Time: 11:46
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

    private $Esiti_history_log;


    public function __construct()
    {
        parent::__construct();
        $this->Esiti_history_log    =  array(
            0   =>  'fas fa-times',          //Success
            1   =>  'fas fa-check-circle',  //Fail
            2   =>  'far fa-eye',           //Visto
            3   =>  'fas fa-user-alt',      //User
        );
    }

    public function Home(){
        $data["view"]           =   "dashboard/home/index";
        $this->load->view('dashboard/template',$data);
    }

    public function AnalisiPreventivi(){
        $data["view"]           =   "dashboard/preventivi/analytics/index";
        $this->load->view('dashboard/template',$data);
    }


    public function Logs(){

        $Data           =   array(
          'today'       =>  date('Y-m-d'),
          'esiti'       =>  $this->Esiti_history_log,
          'history'     =>  $this->db->query('select * from et_history_log order by CreatedAt desc limit 100;')->result_array(),
          'view'        =>  'dashboard/account/logs'
        );
        $this->load->view('dashboard/template',$Data);
    }



    public function Settings(){
        $user           =   $this->session->userdata('logged_in');
        $data           =   array(
            'view'      =>  'dashboard/youraccount/setting',
            'loggedUser'=>  $user['username']
        );

        $this->load->view('dashboard/template',$data);
    }


    public function Calendar(){
        $Data           =   array(
            'view'      =>  'dashboard/calendar/meeting',
            'eventsPath'=>  $this->config->base_url().'api/calendar/'
        );
        $this->load->view('dashboard/template',$Data);
    }

    public function RequestPayment(){
        $data           =   array(
            'view'      =>  'dashboard/wallet/request',
            'richieste' =>  $this->db->query('select *, case  when Stato = "paid" then "disabled" end as ButtonMail from et_payment_request order by CreatedAt desc;')->result_array()
        );

        $this->load->view('dashboard/template',$data);
    }

    public function ManageAccount(){
        $data           =   array(
            'view'      =>  'dashboard/account/manager',
            'users'     =>  $this->db->query('select * from et_panel_users;')->result_array()
        );

        $this->load->view('dashboard/template',$data);
    }


}