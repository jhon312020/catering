<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conditions extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('conditions/mdl_conditions');
        $this->load->helper('text');
    }
    public function index() {
        $this->layout->set();
        $this->layout->buffer('content', 'conditions/index');
        $this->layout->render();
    }
   public function form() {
			if ($this->input->post('btn_cancel')) {
					redirect('admin/conditions/form');
			}
			$id = null;
			$result = $this->mdl_conditions->get()->row();
			if($result) {
				$id = $result->id;
			} else {
				$id = $this->mdl_conditions->save(null, array('conditions' => ''));
			}
			if($this->input->post()) {
				unset($_POST['btn_submit']);
				$id = $this->mdl_conditions->save($id, $this->input->post());
				redirect('admin/conditions/form');
			}
			
			$this->mdl_conditions->prep_form($id);
			$this->layout->buffer('content', 'conditions/form');
			$this->layout->render();
    }
    public function delete($id) {
        $this->mdl_conditions->delete($id);
        redirect('admin/franchises');
    }
}