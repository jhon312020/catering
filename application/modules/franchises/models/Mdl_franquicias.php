<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_aboutus extends Response_Model {

    public $table               = 'aboutus';
    public $primary_key         = 'aboutus.id';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    

    public function default_order_by()
    {
        $this->db->order_by('aboutus.id');
    }

    public function validation_rules()
    {
        return array(
            'title_en' => array(
                'field' => 'title_en',
                'label' => 'Title (EN)',
                'rules' => 'required'
            ),
            'title_es' => array(
                'field' => 'title_es',
                'label' => 'Title (ES)',
                'rules' => 'required'
            ),
            'content_en' => array(
                'field' => 'content_en',
                'label' => 'Content (EN)',
                'rules' => 'required'
            ),
            'content_es' => array(
                'field' => 'content_es',
                'label' => 'Content (ES)',
                'rules' => 'required'
            ),
            
        );
    }

}

?>
