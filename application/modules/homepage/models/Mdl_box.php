<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_box extends Response_Model {

    public $table               = 'boxes';
    public $primary_key         = 'boxes.id';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    

    public function default_order_by()
    {
        $this->db->order_by('boxes.id');
    }

    public function validation_rules()
    {
        return array(
            /*'title' => array(
                'field' => 'title',
                'label' => 'Title (EN)',
                'rules' => 'required'
            ),
            'title_es' => array(
                'field' => 'title_es',
                'label' => 'Title (ES)',
                'rules' => 'required'
            ),*/
            'link' => array(
                'field' => 'link',
                'label' => 'URL',
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
