<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $data = array('homepage'  => $this->config->base_url());

    $this->load->view('include/header',$data);
    $this->load->view($view);
    $this->load->view('include/footer',$data);

    $this->output->set_header('X-Frame-Options: deny');
    $this->output->set_header('X-Content-Type-Options: nosniff');
    $this->output->set_header('X-XSS-Protection: 1; mode=block');

?>