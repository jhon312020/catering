<?php
  //echo $lang;
  $template_path = base_url()."assets/cc/";
  $ln = $this->uri->segment(1);
  //echo $this->uri->segment();die;
  if(!$ln || $ln == ""){  $ln = "es"; }
  $this->load->view('navigation_menu');
?>
<style>

</style>
<header id="header" class="container text-center">
  <hr class="mob-show mob-hr-line">
  <section class="container-hero index-bottom-margin" style="margin-top:10px;">
    <div class="index-hero js-index-hero">
    <?php
    //print_r($banner);die;
    $text = '';
    foreach($data as $key=>$res){
      if($key == 0){
        $text = ($ln == 'en')?$res->slogan_en:$res->slogan_es;
    ?>
        <div style="opacity: 1;display:block;background-image:url(<?php echo $template_path;?>images/homepage/slider/<?php echo $res->image; ?>);" class="index-carousel-image js-index-carousel-image" data-text="<?php echo ($ln == 'en')?$res->slogan_en:$res->slogan_es; ?>"></div>
    <?php
      }
      else{
    ?>
        <div style="opacity: 0;display:none;background-image:url(<?php echo $template_path;?>images/homepage/slider/<?php echo $res->image; ?>);" class="index-carousel-image js-index-carousel-image" data-text="<?php echo ($ln == 'en')?$res->slogan_en:$res->slogan_es; ?>"></div>
    <?php 
      }
    }
    ?>      
    <!--<div style="opacity: 0; display: none;" class="index-carousel-image js-index-carousel-image" data-text="beach life"></div>
    <div style="display: none; opacity: 0;" class="index-carousel-image js-index-carousel-image" data-text="family life"></div>
    <div style="display: block; opacity: 1;" class="index-carousel-image js-index-carousel-image" data-text="WOOOW"></div>
    <div class="index-carousel-image js-index-carousel-image" data-text="travel life"></div>
    <div class="index-carousel-image js-index-carousel-image" data-text="home life"></div>-->
    
    <h1 class="index-hero-header">
    <div class="index-invest-in-hero-text">
      <p class="mybannerpara">Barcelona!</p>
      <div class="index-invest-in-leadin"></div>
      <div style="width: 433px;" class="js-index-yellow-underline index-yellow-underline">
        <div class="js-underline-text index-underline-text"><?php echo $text; ?></div>
        <div class="js-underline-text-reference index-underline-text-reference"><?php echo $text; ?></div>
      </div>
    </div>
    </h1>
    <div class="index-hero-overlay">
    <div class="pickbluebg mob-hide">
      <div class="index-hero-show-md">
      <span class="index-hero-row-sm">
        <?php echo ($ln == 'en')?$banner->text_above_banner:$banner->text_above_banner_es; ?>
        <!-- Proin gravida nibh vel
        <span>
        <select style="position: absolute; opacity: 0;" name="investment_amount" class="onboarding-form-control js-custom-select">
        <option value="Place 01">Place 01</option>
        <option value="Place 02">Place 02</option>
        <option value="Place 03">Place 03</option>
        <option value="Place 04">Place 04</option>
        </select>
      </span> 
      Aenean
      <span>
        <select style="position: absolute; opacity: 0;" name="investment_amount" class="onboarding-form-control js-custom-select">
        <option value="Place 01">Place 01</option>
        <option value="Place 02">Place 02</option>
        <option value="Place 03">Place 03</option>
        <option value="Place 04">Place 04</option>
        </select>
      </span>-->
      </span>
        
      </div>
      <a href="<?php echo site_url($ln."/reservation"); ?>"><button type="button" class="btn btn-default" style="margin-left:40px;"><?php echo lang('book_now'); ?></button></a>
      
    </div>
    </div>
  </div>
  </section>  
</header>
<!-- Banner -->
<div class="container">
  <div class="row" style="margin-top:-15px;">
    <div class="col-sm-12">
    <a href="<?php echo ($ln == 'en')?$banner->link:$banner->link_es; ?>"><img src="<?php echo $template_path;?>images/homepage/banner/<?php echo ($ln == 'en')?$banner->image:$banner->image_es; ?>" class="img-responsive mob-hide"></a>
    <a href="<?php echo site_url($ln.'/reservation'); ?>" class="btn btn-warning mob-show pull-right mob_res_btn_sh"><?php echo lang('book_now'); ?></a>
    <img src="<?php echo $template_path;?>images/cta_<?php echo $ln; ?>.jpg" class="img-responsive mob-show add_mob_res_img" style="width:100%;">
    
    </div>
  </div>
</div>
<!--Box-->
<div class="container my_mas_grid">
  <div id="container" data-columns>
  <!--<iframe src="https://player.vimeo.com/video/144927592?title=0&byline=0&portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<p><a href="https://vimeo.com/144927592">Rolodex of Hate</a> from <a href="https://vimeo.com/biancadelrio">Bianca Del Rio</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
  <iframe width="420" height="345" src="http://www.youtube.com/embed/YOXyt43zJX8"  frameborder="0" allowfullscreen></iframe>
  <object width="420" height="315" data="http://www.youtube.com/v/XGSy3_Czz8k"></object>-->
    <?php
    foreach($boxes as $box) {
      $image = ($ln == 'en')?$box->image:$box->image_es;
      $title = ($ln == 'en')?$box->title:$box->title_es;
      //$link = ($ln == 'en')?$box->link:$box->link_es;
      $link = $box->link;
      //$video_link = ($ln == 'en')?$box->video_link:$box->video_link_es;
      $video = ($ln == 'en')?$box->video:$box->video_es;
      if ($title != '' && $box->title_bgcolor != '') {
    ?>
    <div class="box one item" style="background:<?php echo $box->title_bgcolor; ?>">
        <?php       
          if($box->show_home == 'video') {
            $regexstr = '~
              # Match Youtube link and embed code
              (?:               # Group to match embed codes
                (?:&lt;iframe [^&gt;]*src=")?   # If iframe match up to first quote of src
                |(?:            # Group to match if older embed
                  (?:&lt;object .*&gt;)?    # Match opening Object tag
                  (?:&lt;param .*&lt;/param&gt;)*  # Match all param tags
                  (?:&lt;embed [^&gt;]*src=")?  # Match embed tag to the first quote of src
                )?              # End older embed code group
              )?                # End embed code groups
              (?:               # Group youtube url
                https?:\/\/             # Either http or https
                (?:[\w]+\.)*            # Optional subdomains
                (?:                         # Group host alternatives.
                youtu\.be/                # Either youtu.be,
                | youtube\.com        # or youtube.com 
                | youtube-nocookie\.com   # or youtube-nocookie.com
                )             # End Host Group
                (?:\S*[^\w\-\s])?         # Extra stuff up to VIDEO_ID
                ([\w\-]{11})            # $1: VIDEO_ID is numeric
                [^\s]*            # Not a space
              )               # End group
              "?                # Match end quote if part of src
              (?:[^&gt;]*&gt;)?           # Match any extra stuff up to close brace
              (?:               # Group to match last embed code
                &lt;/iframe&gt;             # Match the end of the iframe 
                |&lt;/embed&gt;&lt;/object&gt;          # or Match the end of the older embed
              )?                # End Group of last bit of embed code
              ~ix';
            preg_match($regexstr, $video, $matches);
            if(isset($matches[1])) {
        ?>        
              <!--<object width="100%" height="315" data="http://www.youtube.com/v/<?php echo $vid; ?>"></object>-->
              <iframe height="340" src='http://www.youtube.com/embed/<?php echo $matches[1]; ?>?rel=0&autoplay=1' allowfullscreen frameborder='0' ></iframe>
        <?php 
            } else {
              $regexstr = '~
                # Match Vimeo link and embed code
                (?:&lt;iframe [^&gt;]*src=")?   # If iframe match up to first quote of src
                (?:             # Group vimeo url
                  https?:\/\/       # Either http or https
                  (?:[\w]+\.)*      # Optional subdomains
                  vimeo\.com        # Match vimeo.com
                  (?:[\/\w]*\/videos?)? # Optional video sub directory this handles groups links also
                  \/            # Slash before Id
                  ([0-9]+)        # $1: VIDEO_ID is numeric
                  [^\s]*          # Not a space
                )             # End group
                "?              # Match end quote if part of src
                (?:[^&gt;]*&gt;&lt;/iframe&gt;)?    # Match the end of the iframe
                (?:&lt;p&gt;.*&lt;/p&gt;)?            # Match any title information stuff
                ~ix';
              
              preg_match($regexstr, $video, $matches);
        ?>
              <iframe src="https://player.vimeo.com/video/<?php echo $matches[1]; ?>?autoplay=1" width="640" height="528" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        <?php 
            }
            
          } else {
         ?>
            <img src="<?php echo $template_path; ?>images/homepage/boxes/<?php echo $image; ?>" class="img-responsive">
        <?php 
          }
        ?>    
      <h2><?php echo $title;?></h2>
      <p class="mas_btn_area"><a href="<?php echo $link; ?>"><button class="btn btn-default gobtn">GO</button></a></p>
    </div>
    <?php } else { ?>
    <div class="box two item">
      <img src="<?php echo $template_path; ?>images/homepage/boxes/<?php echo $image; ?>" class="img-responsive">
      <p class="mas_btn_area"><a href="<?php echo $link; ?>"><button class="btn btn-default gobtn">GO</button></a></p>
    </div>
    <?php
    }
    }
    ?>
  </div>
</div>
<div class="row" style="width:95%;">&nbsp;</div>
<?php $this->load->view('footer');?>
<script>
$(document).ready(function(){
  $('iframe').attr('height', '275');
  $('iframe').attr('width', '100%');
});
</script>
