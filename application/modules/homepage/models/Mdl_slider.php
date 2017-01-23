<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_slider extends Response_Model {

    public $table               = 'sliders';
    public $primary_key         = 'sliders.id';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    

    public function default_order_by()
    {
        $this->db->order_by('sliders.id');
    }

    public function validation_rules()
    {
        return array(
            'slogan_en' => array(
                'field' => 'slogan_en',
                'label' => 'Slogan',
                'rules' => 'required'
            ),
            'slogan_es' => array(
                'field' => 'slogan_es',
                'label' => 'Eslogan',
                'rules' => 'required'
            ),
            /*'image' => array(
                'field' => 'image',
                'label' => 'Image',
                'rules' => 'required'
            )*/
        );
    }

}

?>
