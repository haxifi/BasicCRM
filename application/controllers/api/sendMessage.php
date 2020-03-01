<?php
/**
 * Created by PhpStorm.
 * User: Salvatore
 * Date: 24/06/2019
 * Time: 13:27
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class sendMessage extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

    }


    public function test()
    {
        /*
        $Data   =   array
        (
                'body'          =>  array(

                     'to'        => 'tonyno92@gmail.com',
                     'subject'   => 'Prova Invio'
                ),
                    'mail'      =>  array(

                    'Title_Heading'     =>  'Titolo Email',
                    'Body'              =>  'T piace ?',
                    'Button_Row'        =>  '',             //Nascondi Tasto display:none;
                    'Button_Lable'      =>  'Click Me',
                    'LinkMail'          => 'http://google.it'
                )
        );

        echo $this->birdMail->sendMail($Data);
        */

    }


}