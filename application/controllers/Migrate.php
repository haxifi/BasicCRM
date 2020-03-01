<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 16/05/2019
 * Time: 17:55
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class migrate extends  CI_Controller{

    private $Enabled = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
    }


    public function Create()
    {
        if($this->Enabled)
        {
            if ( ! $this->migration->current())
            {
                echo 'Errore: ' . $this->migration->error_string();
            } else {
                echo 'Installazione Riuscita !';
            }
        }
    }

}

