<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_calendars extends Response_Model {

    public $table               = 'calendars';
    public $primary_key         = 'calendars.id';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    

    public function default_order_by() {
        $this->db->order_by('calendars.id');
    }

    public function validation_rules() {
        return array(
            'reference_id' => array(
                'field' => 'reference_id',
                'label' => 'Reference ID',
                'rules' => 'required'
            ),
            'car' => array(
                'field' => 'car',
                'label' => lang('car'),
                'rules' => 'required'
            ),
            'driver' => array(
                'field' => 'driver',
                'label' => lang('driver'),
                'rules' => 'required'
            ),
            'seats' => array(
                'field' => 'seats',
                'label' => lang('seats'),
                'rules' => 'required'
            ),
            'from_zone' => array(
                'field' => 'from_zone',
                'label' => 'First Step - Zone',
                'rules' => 'required'
            ),
            'from_time' => array(
                'field' => 'from_time',
                'label' => 'First Step - Hour & Minutes',
                'rules' => 'required'
            ),
            'to_zone' => array(
                'field' => 'to_zone',
                'label' => 'Last Step - Zone',
                'rules' => 'required'
            ),
            'to_time' => array(
                'field' => 'to_time',
                'label' => 'Last Step - Hour & Minutes',
                'rules' => 'required'
            )
        );
    }

    public function prep_form($id = NULL)
    {
        if ($id) { // This is for an existing record

            // Have the base model do the initial form preparation
            parent::prep_form($id);
            $days = $this->form_value('days');
            $steps = $this->form_value('steps');
            $steps = json_decode($steps, true);
            if ($steps) {
                $this->set_form_value('steps', $steps);
                if (isset($steps['zone']) && $steps['zone']){
                    $this->set_form_value('zone', $steps['zone']);
                }
                if (isset($steps['hours']) && $steps['hours']){
                    $this->set_form_value('hours', $steps['hours']);
                }
                if (isset($steps['minutes']) && $steps['minutes']){
                    $this->set_form_value('minutes', $steps['minutes']);
                }
            }
            if($days){
                $this->set_form_value('days', json_decode($days, true));
            }
        }
    }

}

?>
