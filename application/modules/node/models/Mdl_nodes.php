<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_Nodes extends Response_Model {

    public $table               = 'nodes';
    public $primary_key         = 'nodes.nid';
    public $date_created_field  = 'date_created';
    public $date_modified_field = 'date_modified';

    

    public function default_order_by()
    {
        $this->db->order_by('nodes.nid');
    }
	/**
	 * Function fetchAllSliders()
	 * Used to get all data from table slider.
	 * @param null
	 * @return data [array]
	 * @author Cygnusinfosystems
	 */
	public function fetchAllSliders()
    {
		$qry = $this->db->from('tbl_sliders')->where('is_active',1);
		$data = $this->db->get()->result();
        return $data;
    }
	/**
	 * Function fetchAllBoxes()
	 * Used to get all data from table boxes.
	 * @param null
	 * @return data [array]
	 * @author Cygnusinfosystems
	 */
	public function fetchAllBoxes()
    {
		$qry = $this->db->from('tbl_boxes');
		$this->db->where('location', 'boxes');
		$this->db->order_by('isnull(box_sort), box_sort', 'asc');
		$this->db->order_by('created', 'desc');
		$data = $this->db->get()->result();
        return $data;
    }
	/**
	 * Function fetchBannerLast()
	 * Used to get the last banner record by ordering created date.
	 * @param null
	 * @return data [array]
	 * @author Cygnusinfosystems
	 */
	public function fetchBannerLast()
    {
		$this->db->from('tbl_boxes');
		$this->db->where('location', 'banner');
		$this->db->order_by("created", "asc");
		$this->db->limit(1);
		$data = current($this->db->get()->result());
		return $data;
    }
    public function validation_rules()
    {
        return array(
            'title'      => array(
                'field' => 'title',
                'label' => 'title',
                'rules' => 'required'
            ),
            'body'     => array(
                'field' => 'body',
                'label' => 'body',
                'rules' => 'required'
            ),
            'url'      => array(
                'field' => 'url'
            ),
            'seo_keywords'      => array(
                'field' => 'seo_keywords'
            ),
            'seo_meta_tags'      => array(
                'field' => 'seo_meta_tags'
            ),
            'seo_meta_desc'      => array(
                'field' => 'seo_meta_desc'
            ),
        );
    } 

}

?>
