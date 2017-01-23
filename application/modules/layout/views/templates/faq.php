<?php
	//echo $lang;
	$template_path = base_url()."assets/cc/";
	$ln = $this->uri->segment(1);
	//echo $ln;die;
	if(!$ln || $ln == ""){	$ln = "es"; }
	$this->load->view('navigation_menu');
?>
	<div class="container" id="faq">
	<hr class="mob-show mob-hr-line">
		<div class="row faq">
			<div class="col-sm-4"></div>
			<div class="col-sm-8">
				<?php
				foreach($top_data as $data){
				?>
				<h1 class="pickblue"><?php echo ($ln == 'en')?$data->content_en:$data->content_es; ?></h1>
				<p><?php echo ($ln == 'en')?$data->subcontent_en:$data->subcontent_es; ?></p>
				<?php
				}
				?>
				<span class="mysub_title">
				<?php
				$last = end($bottom_data);
				$engCategory = array('category1' => 'Before my reservation', 'category2' => 'The day of my reservation', 'category3' => 'After my booking');
				$spanCategory = array('category1' => 'Antes de mi reserva', 'category2' => 'el día de mi viaje', 'category3' => 'después de mi viaje');
				$cat1 = array_filter($bottom_data, function($el) { return $el->category == 'category1'; });
				$cat2 = array_filter($bottom_data, function($el) { return $el->category == 'category2'; });
				$cat3 = array_filter($bottom_data, function($el) { return $el->category == 'category3'; });
				foreach($engCategory as $key=>$value){
				?>
				<a href="#<?php echo $key; ?>" class="orange"><?php echo ($ln == 'en')?$engCategory[$key]:$spanCategory[$key]; ?></a> <?php echo ($key != 'category3')?' / ':''; ?> 
				<?php	
				}
				?>
				<hr class="mob-hide" style="border-color:#f7ad30;">
				</span></p>
			</div>
		</div>
		<?php
		if(count($cat1) > 0){
		?>
		<div class="row faq">
			<div class="col-sm-4"><h2><?php echo ($ln == 'en')?$engCategory['category1']:$spanCategory['category1']; ?></h2></div>
			<div class="col-sm-8" id="category1">
			<div id="accordion" style="border-bottom: 1px solid #f7ad30;padding-bottom:10px;margin-bottom:30px;">
			<ul class="ques">
		<?php
		foreach($cat1 as $data){
		?>
			<li data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $data->id; ?>"><span><?php echo ($ln == 'es')?$data->question_es:$data->question; ?></span>
				<ul id="collapse<?php echo $data->id; ?>" class="ans panel-collapse collapse">
					<li><?php echo ($ln == 'es')?$data->answer_es:$data->answer; ?></li>
				</ul>
			</li>
		<?php
		}
		?>
			</ul>
			</div>
			</div>
		</div>
		<?php
		}
		?>
		<?php
		if(count($cat2) > 0){
		?>
		<div class="row faq">
			<div class="col-sm-4"><h2><?php echo ($ln == 'en')?$engCategory['category2']:$spanCategory['category2']; ?></h2></div>
			<div class="col-sm-8" id="category2">
			<div id="accordion" style="border-bottom: 1px solid #f7ad30;padding-bottom:10px;margin-bottom:30px;">
			<ul class="ques">
		<?php
		foreach($cat2 as $data){
		?>
			<li data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $data->id; ?>"><span><?php echo ($ln == 'es')?$data->question_es:$data->question; ?></span>
				<ul id="collapse<?php echo $data->id; ?>" class="ans panel-collapse collapse">
					<li><?php echo ($ln == 'es')?$data->answer_es:$data->answer; ?></li>
				</ul>
			</li>
		<?php
		}
		?>
			</ul>
			</div>
			</div>
		</div>
		<?php
		}
		?>
		<?php
		if(count($cat3) > 0){
		?>
		<div class="row faq">
			<div class="col-sm-4"><h2><?php echo ($ln == 'en')?$engCategory['category3']:$spanCategory['category3']; ?></h2></div>
			<div class="col-sm-8" id="category3">
			<div id="accordion" style="border-bottom: 1px solid #f7ad30;padding-bottom:10px;margin-bottom:30px;">
			<ul class="ques">
		<?php
		foreach($cat3 as $data){
		?>
			<li data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $data->id; ?>"><span><?php echo ($ln == 'es')?$data->question_es:$data->question; ?></span>
				<ul id="collapse<?php echo $data->id; ?>" class="ans panel-collapse collapse">
					<li><?php echo ($ln == 'es')?$data->answer_es:$data->answer; ?></li>
				</ul>
			</li>
		<?php
		}
		?>
			</ul>
			</div>
			</div>
		</div>
		<?php
		}
		?>
	</div>

<?php $this->load->view('footer');?>