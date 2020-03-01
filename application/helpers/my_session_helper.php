<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 19/06/2019
 * Time: 09:25
 */



function asLogged(){
    $CI     = get_instance();
    $Data   = $CI->session->logged_in;
    return    $CI->Login_Database->AsLogin($Data["username"],$Data["key"]);
}
