<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 24/06/2019
 * Time: 10:11
 */


/**
 * @param $Richiesta
 * @param $Request  Array
 * @param $Response Array
 * @param $Esito    Int 0/1
 */

function WriteNotes($Richiesta, $Request, $Response,$Esito)
{
    $CI                   =   get_instance();
    $Form                 =   new stdClass();
    $Form->Operatore      =   ($CI->session->userdata('logged_in'))  ?   $CI->session->logged_in["username"] :   'Guest';
    $Form->URL            =   str_replace(base_url(),'',current_url());

    $data = array
    (
        'Operatore'     => $Form->Operatore,
        'Richiesta'     => $Richiesta,
        'URL'           => $Form->URL,
        'Esito'         => $Esito,
        'Request'       => json_encode($Request),
        'Response'      => json_encode($Response)
    );

    $CI->db->insert('et_history_log',$data);
}
