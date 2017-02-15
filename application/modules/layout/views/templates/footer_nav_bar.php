<div class="footer-bottom <?php echo isset($class)? $class:'';?>">
  <div class="container">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="copyright">
          <?php echo $contact->name; ?> | <?php  echo $contact->address; ?> | Tel/Fax. <?php echo $contact->telephone;?>
        </div>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="design">
          <a href="<?php echo site_url(PAGE_LANGUAGE); ?>/terms" class="btn-link" target="_blank">Condiciones legales</a> <i class="fa fa-lg fa-twitter-square"></i> <i class="fa fa-lg fa-facebook-square"></i>
        </div>
      </div>
  </div>
</div>
