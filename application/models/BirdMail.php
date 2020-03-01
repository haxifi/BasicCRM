<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 24/06/2019
 * Time: 16:00
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class BirdMail extends CI_Model{

    private function getTemplate($replacers)
    {
        $page = file_get_contents($this->config->base_url().$this->config->item('mail_template'));
        $_rep = json_decode(json_encode($replacers), true);
        $page = preg_replace_callback(
            '/{{(\w*)}}/',
            function ($m) use ($_rep) {
                $key = trim($m[1]);
                return array_key_exists($key, $_rep) ? $_rep[$key] : '';
            },
            $page
        );
        return $page;
    }


    public function sendMail($Data)
    {
        $this->load->library('email');
        $config = $this->config->item('smtp_mail');
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $htmlContent =  $this->getTemplate($Data['mail']);

        $this->email->to($Data['body']['to']);
        $this->email->from('noreplay@e-type.it','E-Type');
        $this->email->subject($Data['body']['subject']);
        $this->email->message($htmlContent);

        return $this->email->send();
    }

}