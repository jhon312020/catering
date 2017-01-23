<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_booking_extras extends Response_Model {

    public $table               = 'booking_extras';
    public $primary_key         = 'booking_extras.id';

    public function default_order_by() {
        $this->db->order_by('booking_extras.id');
    }

    public function validation_rules() {
        return array(
            'title' => array(
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required'
            ),
            'subtitle' => array(
                'field' => 'subtitle',
                'label' => 'Subtitle',
                'rules' => 'required'
            ),
            'description_en' => array(
                'field' => 'description_en',
                'label' => 'description',
                'rules' => 'required'
            ),
            'title_es' => array(
                'field' => 'title_es',
                'label' => 'Title',
                'rules' => 'required'
            ),
            'subtitle_es' => array(
                'field' => 'subtitle_es',
                'label' => 'Subtitle',
                'rules' => 'required'
            ),
            'description_es' => array(
                'field' => 'description_es',
                'label' => 'description',
                'rules' => 'required'
            ),
            'price' => array(
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required'
            )
        );
    }

}

?>
