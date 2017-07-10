<?php
$this->load->view('header');
$this->load->view('navigation_menu');
?>
<style>
  td {
    text-align:center !important;
    width: auto;
    vertical-align: middle !important;
  }
  th {
    text-align:center !important;
    width: auto;
  }
  table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:after {
    bottom: 19px !important;
  }
  .dataTables_length, .dataTables_info {
  	text-align: left !important;
  }
</style>
<div class="col-sm-12 fix-left-right mob-hide">
  <table class="table table-striped dataTable">
    <thead>
      <tr>
        <th><?php echo strtoupper(lang('invoice_month_year')); ?></th>
        <th style="text-align:center !important;"><?php echo strtoupper(lang('download_link')); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($invoice_list) {
        	foreach($invoice_list as $invoice) {
        		$month = date('m', strtotime($invoice['created_at']));
        		$year = date('Y', strtotime($invoice['created_at']));
        ?>
      <tr>
        <td><?php echo date('F-Y', strtotime($invoice['created_at'])); ?></td>
        <td style="text-align:center !important;"><a href='<?php echo site_url(PAGE_LANGUAGE."/invoice-users/$month/$year"); ?>' class="btn btn-primary" ><i class="fa fa-download"></i></a></td>
      </tr>
      <?php } } ?>
    </tbody>
  </table>
</div>
<?php
$this->load->view('footer');
?>
