<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_faq extends Response_Model {

    public $table               = 'faqs';
    public $primary_key         = 'faqs.id';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    

    public function default_order_by()
    {
        $this->db->order_by('faqs.id');
    }

    public function validation_rules()
    {
        return array(
            'question' => array(
                'field' => 'question',
                'label' => 'Question (EN)',
                'rules' => 'required'
            ),
            'question_es' => array(
                'field' => 'question_es',
                'label' => 'Question (ES)',
                'rules' => 'required'
            ),
            'answer' => array(
                'field' => 'answer',
                'label' => 'Answer (EN)',
                'rules' => 'required'
            ),
            'answer_es' => array(
                'field' => 'answer_es',
                'label' => 'Answer (ES)',
                'rules' => 'required'
            ),
            'category' => array(
                'field' => 'category',
                'label' => 'Category',
                'rules' => 'required'
            )
        );
    }

}

?>
