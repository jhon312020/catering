<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_shuttles extends Response_Model {

    public $table               = 'booking';
    public $primary_key         = 'booking.id';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    public function default_order_by(){
        $this->db->order_by('booking.id');
    }

    public function validation_rules()
    {
        return array(
            'hour' => array(
                'field' => 'hour',
                'label' => 'Hour',
                'rules' => 'required'
            ),
            'start_from' => array(
                'field' => 'start_from',
                'label' => 'From',
                'rules' => 'required'
            ),
            'end_at' => array(
                'field' => 'end_at',
                'label' => 'To',
                'rules' => 'required'
            ),
            /*'arrival_time' => array(
                'field' => 'arrival_time',
                'label' => 'Arrival Time',
                'rules' => 'required'
            ),*/
            'price' => array(
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required'
            ),
            'start_journey' => array(
                'field' => 'start_journey',
                'label' => 'Go Date',
                'rules' => 'required'
            ),
            /*'return_journey' => array(
                'field' => 'return_journey',
                'label' => 'Return Date',
                'rules' => 'required'
            ),*/
            'country' => array(
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required'
            ),
            'flight_no' => array(
                'field' => 'flight_no',
                'label' => 'Flight No',
                'rules' => 'required'
            ),
            'adults' => array(
                'field' => 'adults',
                'label' => 'Adults',
                'rules' => 'required'
            ),
            'zone' => array(
                'field' => 'zone',
                'label' => 'Zone',
                'rules' => 'required'
            )
        );
    } 

}

?>
