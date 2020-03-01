<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Authentication extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Login_Database');
    }


    public function login(){
        $data["view"]  =   'account/login';
        $this->load->view('template',$data);
    }


    public function user_login_process()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );

        $result = $this->Login_Database->login($data,true);
        $username = $this->input->post('username');


        if ($result == TRUE) {

            $result = $this->Login_Database->read_user_information($username);

            if ($result != false) {

                $session_data = array(
                    'username' => $result[0]->username,
                    'key' => $result[0]->password,
                );


                $data['password']   =   '*****';
                $this->session->set_userdata('logged_in', $session_data);
                WriteNotes('Ha effettuato il login',$data,array('Browser' => $this->agent->browser(), 'OS' => $this->agent->platform()),3);
                header("location: ../dashboard/");
            }

        } else {
            $data = array(
                'view'          => 'account/login'
            );

            if(!empty($username)) $data['error_message'] = 'Username o password non validi';
            $this->load->view('template', $data);
        }



    }


    public function logout() {
        $sess_array = array(
            'username' => '',
            'key'      => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        header("location: ../account/login");
    }
}

?>