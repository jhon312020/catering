<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_order_reports extends Response_Model {
		
    public $table               = 'order_reports';
    public $primary_key         = 'order_reports.id';
}
?>