<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Client_Controller extends User_Controller {

    public $user_clients = array();

    public function __construct()
    {
        parent::__construct('user_type', 2);
    }

}

?>
