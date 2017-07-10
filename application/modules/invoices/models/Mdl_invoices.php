<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mdl_Invoices extends Response_Model {

    public $table               = 'invoices';
    public $primary_key         = 'invoices.id';
    //public $date_created_field  = 'date_created';
    //public $date_modified_field = 'date_modified';

    

    public function default_order_by()
    {
        $this->db->order_by('invoices.id');
    }

    public function validation_rules()
    {
        return array(
			
					'invoice_no' => array(
                'field' => 'invoice_no',
                'label' => 'Telephone',
                'rules' => 'required'
            ),
            
        );
    }

    public function getInvoiceUsingDate ($date, $type)
    {

    	$query = 
    		$this->mdl_invoices
	  			->where('date_of_invoice', $date)
	  			->where('category', $type);

	  	return $query->get()->row();
    } 

    public function newInvoice ($data)
    {

    	$this->db->where('category', $data['category'])->where('date_of_invoice', $data['date_of_invoice'])->delete('invoices');
  		$this->db->insert('invoices', $data);
  		$id = $this->db->insert_id();
  		$invoice_no = str_pad($id, 5, '0', STR_PAD_LEFT);

  		$this->db->where('id', $id);
  		$this->db->set([ "invoice_no" => $invoice_no ]);
  		$this->db->update('invoices');

  		return $invoice_no;
    } 

    public function getNewInvoiceNo () {
      $invoice_id = $this->db->query('select max(id) as last_id from tbl_invoices')->result();
      if (isset($invoice_id[0])) {
        return str_pad((string)$invoice_id[0]->last_id+1, 5, '0', STR_PAD_LEFT);
      } else {
        return str_pad('1', 5, '0', STR_PAD_LEFT);
      }
    }

}

?>
