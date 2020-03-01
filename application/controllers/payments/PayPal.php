<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 22/06/2019
 * Time: 09:22
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class PayPal extends CI_Controller
{
    function GuestForm()
    {
        $Pratica      =   $this->db->query("select * from et_payment_request where Token_Pagina = ? and PaidAt is null;", array($this->input->get('id')))->result();
        $successToken =   $this->db->query("select * from et_payment_request where Token_Pagina = ? and Token_Success = ? and PaidAt is null;", array($this->input->get('id'), $this->input->get('code')))->result();

        if(count($successToken)){

            $data = array(
                'homepage'  =>  $this->config->base_url(),
                'body'      =>  'Pagamento completato !',
                'icon'      =>  'fas fa-check'
            );

            $this->db->query("update et_payment_request set Stato = 'paid', PaidAt = now() where Token_Success = ?",array($successToken[0]->Token_Success));

            $this->load->view('guest/Thank_you',$data);
        }elseif(count($Pratica)){


            $data = array
            (
                'root'      =>    $this->config->base_url(),
                'mail'      =>    'support@e-type.it',
                'title'     =>    'Richiesta Pagamento - PayPal',

                'Form'      =>      array
                (
                    'Enabled'        =>      count($Pratica),
                    'Items'          =>      $Pratica[0]->Servizio,
                    'Order'          =>      $Pratica[0]->ID,
                    'Import'         =>      $Pratica[0]->Importo,
                    'SuccessPage'    =>      $this->config->base_url()."richieste/pagamento/paypal?id=".$Pratica[0]->Token_Pagina."&code=".$Pratica[0]->Token_Success,
                    'DefaultPage'    =>      $this->config->base_url()."richieste/pagamento/paypal"//.$Pratica[0]->Token_Pagina
                )
            );

            WriteNotes(('Aperta Email Pagamento N '. $Pratica[0]->ID),array('Browser' => $this->agent->browser(), 'OS' => $this->agent->platform()),array('is_mobile' => (!intval($this->agent->is_mobile()) ? 'No' : 'Si') ,'is_robot' => (!intval($this->agent->is_robot()) ? 'No' : 'Si')),2);
            $this->load->view('guest/payments/paypal',$data);

        }else{

            $data = array(
                'homepage'  =>  $this->config->base_url(),
                'body'      =>  'Richiesta scaduta ',
                'icon'      =>  'fas fa-times'
            );

            $this->load->view('guest/Thank_you',$data);
        }
    }

}
