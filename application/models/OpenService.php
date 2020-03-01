<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 27/06/2019
 * Time: 16:31
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class OpenService extends CI_Model{

    public function GeoLocation($ip){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://ipinfo.io/$ip/geo");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }


}