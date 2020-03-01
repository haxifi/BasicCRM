<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 25/06/2019
 * Time: 12:16
 */

class Requests extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('BirdMail');
    }


    function SendMail(){
        if(asLogged()){

            $Response=  array();
            $Cliente =  $this->db->query('select * from et_payment_request where ID = ?;', array($this->input->post('ID')))->result();

            if(count($Cliente))
            {
                $Body  = "In merito al tuo preventivo ti per il servizio: <br>";
                $Body .= "<b>".$Cliente[0]->Servizio."</b><br>";
                $Body .= "Ti chiadiamo di confermare il pagamento per iniziare da subito a offrirti i nostri servizi, grazie.<br>";
                $Body .= "<b>Ricorda</b>: Effettuato il pagamento, clicca su <b>Torna sul sito del venditore</b><br>";

                $Data   =   array
                (
                    'body'          =>  array(

                        'to'        => $Cliente[0]->Email,
                        'subject'   => 'Richiesta Pagamento'
                    ),
                    'mail'      =>  array(

                        'Title_Heading'     =>  'Ciao '.(explode('@',$Cliente[0]->Email)[0])." !",
                        'Body'              =>  $Body,
                        'Button_Row'        =>  '',
                        'Button_Lable'      =>  'Paga Adesso',
                        'LinkMail'          =>   $this->config->base_url()."richieste/pagamento/paypal?id=".$Cliente[0]->Token_Pagina
                    )
                );

                if($this->BirdMail->sendMail($Data)){
                    $Response   =   array(
                        'response' => 'success',
                        'message'  => 'Email Inviata'
                    );
                }else{
                    $Response   =   array(
                        'response' => 'fail',
                        'message'  => 'Errore invio Email'
                    );
                }

            }else{
                $Response   =   array(
                    'response' => 'fail',
                    'message'  => 'Utente non trovato'
                );
            }

            WriteNotes('Inviato una richiesta pagamento',$this->input->post(),$Response,($Response['response'] == 'success' ? 1 : 0));
            $this->load->view('api/json', array('response' => $Response));
        }

    }


    function AddRequest()
    {
        $Response   =   array();

        if(asLogged())
        {
            $Request    =   array(
                'Servizio'          =>  $this->input->post('service'),
                'Importo'           =>  $this->input->post('import'),
                'Email'             =>  $this->input->post('email'),
                'Token_Pagina'      =>  random_string('alnum',60),
                'Token_Success'     =>  random_string('alnum',60)
            );


            $this->form_validation->set_rules('service', 'Servizio', 'required|min_length[5]');
            $this->form_validation->set_rules('import', 'Importo', 'required|regex_match[/^[0-9.]{1,10}$/]');
            $this->form_validation->set_rules('email', 'Email', 'required');


            if($this->form_validation->run())
            {
                $Add    =   $this->db->insert('et_payment_request',$Request);
                if($Add)
                {

                    $Response   =   array(
                        'response' => 'success',
                        'message'  => 'Richiesta aperta con successo',
                    );
                }else{
                    $Response   =   array(
                        'response' => 'fail',
                        'message'  => 'Apertura richiesta fallito'
                    );
                }
            }else{
                $Response       =    array(
                    'response'  =>  'fail',
                    'message'   =>  'Formato non valido'
                );
            }

            WriteNotes('Creazione Richiesta Pagamento',$this->input->post(),$Response,($Response['response'] == 'success' ? 1 : 0));
            if($Response['response'] == 'success') $Response['rows'] = $this->db->get_where('et_payment_request',$Request)->result()[0];
            $this->load->view('api/json', array('response' => $Response));
        }
    }


    function GetOrder()
    {
        $ID     = $this->input->post('ID');
        if(asLogged() && preg_match('/^[0-9]{1,10000}$/',$ID)){
            $Detail = $this->db->query('select Importo,Stato from et_payment_request where ID = ?;', array($this->input->post('ID')))->result();
            $this->load->view('api/json',array('response' => $Detail[0]));
        }
    }


    function DeleteRequest(){
        $Response   =   array();
        if(asLogged())
        {
            $Order      =   $this->input->post('Order');
            $Delete     =   $this->db->delete('et_payment_request', array('ID' => $Order));

            if($Delete){
                $Response   =   array(
                    'response' => 'success',
                    'message'  => 'Richiesta eliminata con successo'
                );
            }else{
                $Response       =    array(
                    'response'  =>  'fail',
                    'message'   =>  'Ordine non trovato'
                );
            }

            WriteNotes('Eliminazione richista pagamento',$this->input->post(),$Response,($Response['response'] == 'success' ? 1 : 0));
            $this->load->view('api/json', array('response' => $Response));
        }
    }


    function EditRequest(){
        if(asLogged())
        {
            $Response   =   array();
            $Request    =   array(
                'Importo'   =>  $this->input->post('import'),
                'Stato'     =>  $this->input->post('status')
            );

            $this->form_validation->set_rules('status', 'Stato', 'required|min_length[3]');
            $this->form_validation->set_rules('import', 'Importo', 'required|regex_match[/^[0-9]{1,10}$/]');

            if($this->form_validation->run()) {
                $this->db->where('ID',$this->input->post('ID'));

                if($this->db->update('et_payment_request',$Request)){
                    $Response       =    array(
                        'response'  =>  'success',
                        'message'   =>  'Aggiornamento riuscito'
                    );
                }else{
                    $Response       =    array(
                        'response'  =>  'fail',
                        'message'   =>  'Aggiornamento fallito'
                    );
                }

            }else{
                $Response       =    array(
                    'response'  =>  'fail',
                    'message'   =>  'Parametri non validi'
                );
            }


            WriteNotes('Aggiornato Richiesta Pagamento',$this->input->post(),$Response,($Response['response'] == 'success' ? 1 : 0));
            $this->load->view('api/json', array('response' => $Response));
        }
    }
}