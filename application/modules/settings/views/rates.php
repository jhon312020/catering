<div class="headerbar">
	<h1><?php echo lang('rates'); ?></h1>
</div>

<?php echo $this->layout->load_view('layout/alerts'); ?>
<span class="orange-text" style="font-size:18px;">Rate 1</span><hr/>
<div class="row">
	<div class="col-sm-4">
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('places'); ?></th>
		            <th><?php echo lang('go'); ?></th>
					<th><?php echo lang('go_back'); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr><td class="orange-text">1</td><td>8</td><td>15</td></tr>
				<tr><td class="orange-text">2</td><td>16</td><td>31</td></tr>
				<tr><td class="orange-text">3</td><td>22</td><td>32</td></tr>
				<tr><td class="orange-text">4</td><td>22</td><td>32</td></tr>
			</tbody>
		</table>
		*Price in Euros
	</div>
	<div class="col-sm-3">
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('go').'*'; ?></th>
					<th><?php echo lang('go_back').'**'; ?></th>
				</tr>
			</thead>
			<tbody>
				<tr><td>8</td><td>7,5</td></tr>
				<tr><td>8</td><td>7,75</td></tr>
				<tr><td>7,33</td><td>5,33</td></tr>
				<tr><td>5,5</td><td>4</td></tr>
			</tbody>
		</table>
		*Unit Price<br/>**Unit Price with Back
	</div>
</div>
<br/><span style="font-size:18px;" class="orange-text">Rate 2</span><hr/>
<div class="row">
	<div class="col-sm-4">
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('places'); ?></th>
		            <th><?php echo lang('go'); ?></th>
					<th><?php echo lang('go_back'); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr><td class="orange-text">1</td><td>12</td><td>24</td></tr>
				<tr><td class="orange-text">2</td><td>18</td><td>36</td></tr>
				<tr><td class="orange-text">3</td><td>24</td><td>48</td></tr>
				<tr><td class="orange-text">4</td><td>25</td><td>50</td></tr>
				<tr><td class="orange-text">5</td><td>40</td><td>80</td></tr>
				<tr><td class="orange-text">6</td><td>44</td><td>88</td></tr>
			</tbody>
		</table>
		*Price in Euros
	</div>
	<div class="col-sm-3">
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('go').'*'; ?></th>
					<th><?php echo lang('go_back').'**'; ?></th>
				</tr>
			</thead>
			<tbody>
				<tr><td>12</td><td>12</td></tr>
				<tr><td>9</td><td>9</td></tr>
				<tr><td>8</td><td>8</td></tr>
				<tr><td>6,25</td><td>6,25</td></tr>
				<tr><td>8</td><td>8</td></tr>
				<tr><td>7,33</td><td>7,33</td></tr>
			</tbody>
		</table>
		*Unit Price<br/>**Unit Price with Back
	</div>
</div>
<div class="row">
	<div class="col-sm-4"></div>
	<div class="col-sm-3"><br/>
		<button class="pull-right btn btn-lg btn-sm btn-danger" onclick="alert('Under Development');return false;">Save</button>
	</div>
</div>