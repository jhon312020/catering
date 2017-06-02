<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_discount_applied extends Response_Model {
    public $table               = 'discount_applied';
    public $primary_key         = 'discount_applied.id';

    function getDiscountDetailByReferenceNo($reference_no) {
        //$qry = $this->db->where('reference_no', $reference_no)->get('tbl_discount_applied');
        $qry = $this->db->query("select * from tbl_discount_applied where reference_no=$reference_no");
        if($qry->num_rows()){
          $result = current($qry->result_array());
          $result['original_total_price'] = number_format($result['original_total_price'],2,'.','');
          $result['discount'] = number_format($result['discount'],2,'.','');
          $result['total_price'] = number_format($result['total_price'],2,'.','');
          return $result;
        }
        return false;
    }
}
?>
