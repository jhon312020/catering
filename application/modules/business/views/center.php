<div class="form-content martop">
					<h2>
						<?php echo lang('centre'); ?>
					</h2>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('name');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>"center[$count][Centre]", 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('Centre'), $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('direction');?>
						</label>
						<div class="col-sm-10">
						<?php echo form_textarea(array('name'=>"center[$count][Domicili]", 'class'=>"form-control", 'required'=>'required'),$this->mdl_business->form_value('direction') ); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('cp');?>
						</label>
						<div class="col-sm-2">
							<?php echo form_input(array('name'=>"center[$count][CPostal]", 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('CPostal'), $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('population');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>"center[$count][Poblacio]", 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('Poblacio'), $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('time_limit');?>
						</label>
						<div class="col-sm-2">
							<?php echo form_dropdown("center[$count][hours]", $hours, date('H', strtotime($this->mdl_business->form_value('time_limit') ? $this->mdl_business->form_value('time_limit') : '10:00:00')), 'class="form-control" '.$disabled.''); ?>
							<div class="text-center">
								<span>
									<?php echo lang('hour'); ?>
								</span>
							</div>
						</div>
						<div class="col-sm-2">
							<?php echo form_dropdown("center[$count][minutes]", $minutes, date('i', strtotime($this->mdl_business->form_value('time_limit'))), 'class="form-control" '.$disabled.''); ?>
							<div class="text-center">
								<span>
									<?php echo lang('minutes'); ?>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('route');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>"center[$count][Ruta]", 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('route'), $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 pull-left">
							<?php echo lang('norm_route');?>
						</label>
						<div class="col-sm-10">
							<?php echo form_input(array('name'=>"center[$count][NomRuta]", 'class'=>'form-control', 'value'=>$this->mdl_business->form_value('norm_route'), $readonly=>true, 'required'=>'required')); ?>
						</div>
					</div>
				</div>