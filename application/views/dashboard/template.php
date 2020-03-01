<?php

    $data = array('homepage'  => $this->config->base_url());


    if(asLogged()) {
        $this->load->view('dashboard/include/header',$data);
        $this->load->view($view);
        $this->load->view('dashboard/include/footer',$data);
    }else{
        header("location: ../");
    }

    $this->output->set_header('X-Frame-Options: deny');
    $this->output->set_header('X-Content-Type-Options: nosniff');
    $this->output->set_header('X-XSS-Protection: 1; mode=block');
?>