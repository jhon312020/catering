<?php //print_r($rates); ?>
<div class="headerbar">
	<h1><?php echo lang('rates'); ?></h1>
</div>
<style>
input {
	width:65px;
}
</style>
<?php echo $this->layout->load_view('layout/alerts'); ?>
<form name="rates" method="post" action="<?php echo site_url("admin/rates/form/");?>">
<span class="orange-text" style="font-size:18px;">Rate 1</span><hr/>
<div class="row">
	<div class="col-sm-3">
		<div class="col-sm-12">
			<label>Normal journey rate</label>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('places'); ?></th>
		            <th><?php echo lang('go'); ?></th>
					<th><?php echo lang('go_back'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if ($rates1) {
						foreach ($rates1 as $rate) {
							//print_r($rate);
							echo "<tr>";
							echo "<td class='orange-text'>";
							echo $rate->no_of_seats;
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='rate_one_way_".$rate->id."' name='rates[".$rate->id."][rate_for_one_way]' value='".$rate->rate_for_one_way."' required >";
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='rate_one_way_".$rate->id."' name='rates[".$rate->id."][rate_for_round_a_trip]' value='".$rate->rate_for_round_a_trip."' required >";
							echo "</td>";
							echo "</tr>";
						}
					} else { ?>
						<tr><td class="orange-text">1</td><td>8</td><td>15</td></tr>
						<tr><td class="orange-text">2</td><td>16</td><td>31</td></tr>
						<tr><td class="orange-text">3</td><td>22</td><td>32</td></tr>
						<tr><td class="orange-text">4</td><td>22</td><td>32</td></tr>
					<?php } ?>
				
			</tbody>
		</table>
		*Price in Euros
	</div>
	<div class="col-sm-3">
		<div class="col-sm-12">
			<label>&nbsp;</label>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('go').'*'; ?></th>
					<th><?php echo lang('go_back').'**'; ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if ($rates1) {
						foreach ($rates1 as $rate) {
							//print_r($rate);
							echo "<tr>";
							echo "<td>";
							echo "<input type='text' id='rate_one_way_".$rate->id."' name='rates[".$rate->id."][rate_per_unit_one_way]' value='".$rate->rate_per_unit_one_way."' required>";
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='rate_round_a_trip_".$rate->id."' name='rates[".$rate->id."][rate_per_unit_round_a_trip]' value='".$rate->rate_per_unit_round_a_trip."' required>";
							echo "</td>";
							echo "</tr>";
						}
					} else { ?>
						<tr><td>8</td><td>7,5</td></tr>
						<tr><td>8</td><td>7,75</td></tr>
						<tr><td>7,33</td><td>5,33</td></tr>
						<tr><td>5,5</td><td>4</td></tr>
					<?php } ?>
			</tbody>
		</table>
		*Unit Price<br/>**Unit Price with Back
	</div>
	<div class="col-sm-3">
		<div class="col-sm-12">
			<label>Night journey rate</label>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('go'); ?></th>
					<th><?php echo lang('go_back'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if ($rates1) {
						foreach ($rates1 as $rate) {
							//print_r($rate);
							echo "<tr>";
							echo "<td>";
							echo "<input type='text' id='night_rate_one_way_".$rate->id."' name='rates[".$rate->id."][night_rate_for_one_way]' value='".$rate->night_rate_for_one_way."' required >";
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='night_rate_one_way_".$rate->id."' name='rates[".$rate->id."][night_rate_for_round_a_trip]' value='".$rate->night_rate_for_round_a_trip."' required >";
							echo "</td>";
							echo "</tr>";
						}
					} else { ?>
						<tr><td class="orange-text">1</td><td>8</td><td>15</td></tr>
						<tr><td class="orange-text">2</td><td>16</td><td>31</td></tr>
						<tr><td class="orange-text">3</td><td>22</td><td>32</td></tr>
						<tr><td class="orange-text">4</td><td>22</td><td>32</td></tr>
					<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="col-sm-3">
		<div class="col-sm-12">
			<label>&nbsp;</label>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('go').'*'; ?></th>
					<th><?php echo lang('go_back').'**'; ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if ($rates1) {
						foreach ($rates1 as $rate) {
							//print_r($rate);
							echo "<tr>";
							echo "<td>";
							echo "<input type='text' id='night_rate_one_way_".$rate->id."' name='rates[".$rate->id."][night_rate_per_unit_one_way]' value='".$rate->night_rate_per_unit_one_way."' required>";
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='night_rate_round_a_trip_".$rate->id."' name='rates[".$rate->id."][night_rate_per_unit_round_a_trip]' value='".$rate->night_rate_per_unit_round_a_trip."' required>";
							echo "</td>";
							echo "</tr>";
						}
					} else { ?>
						<tr><td>8</td><td>7,5</td></tr>
						<tr><td>8</td><td>7,75</td></tr>
						<tr><td>7,33</td><td>5,33</td></tr>
						<tr><td>5,5</td><td>4</td></tr>
					<?php } ?>
			</tbody>
		</table>
		*Unit Price<br/>**Unit Price with Back
	</div>
</div>


<br/><span style="font-size:18px;" class="orange-text">Rate 2</span><hr/>
<div class="row">
	<div class="col-sm-3">
		<div class="col-sm-12">
			<label>Normal journey rate</label>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('places'); ?></th>
		            <th><?php echo lang('go'); ?></th>
					<th><?php echo lang('go_back'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if ($rates2) {
						foreach ($rates2 as $rate) {
							//print_r($rate);
							echo "<tr>";
							echo "<td class='orange-text'>";
							echo $rate->no_of_seats;
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='rate_one_way_".$rate->id."' name='rates[".$rate->id."][rate_for_one_way]' value='".$rate->rate_for_one_way."' required >";
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='rate_one_way_".$rate->id."' name='rates[".$rate->id."][rate_for_round_a_trip]' value='".$rate->rate_for_round_a_trip."' required >";
							echo "</td>";
							echo "</tr>";
						}
					} else { ?>
						<tr><td class="orange-text">1</td><td>12</td><td>24</td></tr>
						<tr><td class="orange-text">2</td><td>18</td><td>36</td></tr>
						<tr><td class="orange-text">3</td><td>24</td><td>48</td></tr>
						<tr><td class="orange-text">4</td><td>25</td><td>50</td></tr>
						<tr><td class="orange-text">5</td><td>40</td><td>80</td></tr>
						<tr><td class="orange-text">6</td><td>44</td><td>88</td></tr>
					<?php } ?>
			</tbody>
		</table>
		*Price in Euros
	</div>
	<div class="col-sm-3">
		<div class="col-sm-12">
			<label>&nbsp;</label>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('go').'*'; ?></th>
					<th><?php echo lang('go_back').'**'; ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if ($rates2) {
						foreach ($rates2 as $rate) {
							//print_r($rate);
							echo "<tr>";
							echo "<td>";
							echo "<input type='text' id='rate_one_way_".$rate->id."' name='rates[".$rate->id."][rate_per_unit_one_way]' value='".$rate->rate_per_unit_one_way."' required>";
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='rate_round_a_trip_".$rate->id."' name='rates[".$rate->id."][rate_per_unit_round_a_trip]' value='".$rate->rate_per_unit_round_a_trip."' required>";
							echo "</td>";
							echo "</tr>";
						}
					} else { ?>
						<tr><td>12</td><td>12</td></tr>
						<tr><td>9</td><td>9</td></tr>
						<tr><td>8</td><td>8</td></tr>
						<tr><td>6,25</td><td>6,25</td></tr>
						<tr><td>8</td><td>8</td></tr>
						<tr><td>7,33</td><td>7,33</td></tr>
					<?php } ?>
			</tbody>
		</table>
		*Unit Price<br/>**Unit Price with Back
	</div>
	<div class="col-sm-3">
		<div class="col-sm-12">
			<label>Night journey rate</label>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('go'); ?></th>
					<th><?php echo lang('go_back'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if ($rates2) {
						foreach ($rates2 as $rate) {
							//print_r($rate);
							echo "<tr>";
							echo "<td>";
							echo "<input type='text' id='night_rate_one_way_".$rate->id."' name='rates[".$rate->id."][night_rate_for_one_way]' value='".$rate->night_rate_for_one_way."' required >";
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='night_rate_one_way_".$rate->id."' name='rates[".$rate->id."][night_rate_for_round_a_trip]' value='".$rate->night_rate_for_round_a_trip."' required >";
							echo "</td>";
							echo "</tr>";
						}
					} else { ?>
						<tr><td class="orange-text">1</td><td>12</td><td>24</td></tr>
						<tr><td class="orange-text">2</td><td>18</td><td>36</td></tr>
						<tr><td class="orange-text">3</td><td>24</td><td>48</td></tr>
						<tr><td class="orange-text">4</td><td>25</td><td>50</td></tr>
						<tr><td class="orange-text">5</td><td>40</td><td>80</td></tr>
						<tr><td class="orange-text">6</td><td>44</td><td>88</td></tr>
					<?php } ?>
			</tbody>
		</table>
		*Price in Euros
	</div>
	<div class="col-sm-3">
		<div class="col-sm-12">
			<label>&nbsp;</label>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('go').'*'; ?></th>
					<th><?php echo lang('go_back').'**'; ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if ($rates2) {
						foreach ($rates2 as $rate) {
							//print_r($rate);
							echo "<tr>";
							echo "<td>";
							echo "<input type='text' id='night_rate_one_way_".$rate->id."' name='rates[".$rate->id."][night_rate_per_unit_one_way]' value='".$rate->night_rate_per_unit_one_way."' required>";
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='night_rate_round_a_trip_".$rate->id."' name='rates[".$rate->id."][night_rate_per_unit_round_a_trip]' value='".$rate->night_rate_per_unit_round_a_trip."' required>";
							echo "</td>";
							echo "</tr>";
						}
					} else { ?>
						<tr><td>12</td><td>12</td></tr>
						<tr><td>9</td><td>9</td></tr>
						<tr><td>8</td><td>8</td></tr>
						<tr><td>6,25</td><td>6,25</td></tr>
						<tr><td>8</td><td>8</td></tr>
						<tr><td>7,33</td><td>7,33</td></tr>
					<?php } ?>
			</tbody>
		</table>
		*Unit Price<br/>**Unit Price with Back
	</div>
</div>
<br/><span style="font-size:18px;" class="orange-text">Rate 3</span><hr/>
<div class="row">
	<div class="col-sm-6">
		<div class="col-sm-12">
			<label>Normal journey rate</label>
		</div>	
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('places'); ?></th>
		            <th><?php echo lang('go'); ?></th>
					<th><?php echo lang('go_back'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if ($rates3) {
						foreach ($rates3 as $rate) {
							//print_r($rate);
							echo "<tr>";
							echo "<td class='orange-text'>";
							echo $rate->no_of_seats;
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='rate_one_way_".$rate->id."' name='rates[".$rate->id."][rate_for_one_way]' value='".$rate->rate_for_one_way."' required >";
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='rate_one_way_".$rate->id."' name='rates[".$rate->id."][rate_for_round_a_trip]' value='".$rate->rate_for_round_a_trip."' required >";
							echo "</td>";
							echo "</tr>";
						}
					} else { ?>
						<tr><td class="orange-text">1</td><td>12</td><td>24</td></tr>
						<tr><td class="orange-text">2</td><td>18</td><td>36</td></tr>
						<tr><td class="orange-text">3</td><td>24</td><td>48</td></tr>
						<tr><td class="orange-text">4</td><td>25</td><td>50</td></tr>
						<tr><td class="orange-text">5</td><td>40</td><td>80</td></tr>
						<tr><td class="orange-text">6</td><td>44</td><td>88</td></tr>
					<?php } ?>
			</tbody>
		</table>
		*Price in Euros
	</div>
	<div class="col-sm-6">
		<div class="col-sm-12">
			<label>Night journey rate</label>
		</div>	
		<table class="table table-bordered">
			<thead>
				<tr>
		            <th><?php echo lang('go'); ?></th>
					<th><?php echo lang('go_back'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if ($rates3) {
						foreach ($rates3 as $rate) {
							//print_r($rate);
							echo "<tr>";
							echo "<td>";
							echo "<input type='text' id='night_rate_one_way_".$rate->id."' name='rates[".$rate->id."][night_rate_for_one_way]' value='".$rate->night_rate_for_one_way."' required >";
							echo "</td>";
							echo "<td>";
							echo "<input type='text' id='night_rate_one_way_".$rate->id."' name='rates[".$rate->id."][night_rate_for_round_a_trip]' value='".$rate->night_rate_for_round_a_trip."' required >";
							echo "</td>";
							echo "</tr>";
						}
					} else { ?>
						<tr><td class="orange-text">1</td><td>12</td><td>24</td></tr>
						<tr><td class="orange-text">2</td><td>18</td><td>36</td></tr>
						<tr><td class="orange-text">3</td><td>24</td><td>48</td></tr>
						<tr><td class="orange-text">4</td><td>25</td><td>50</td></tr>
						<tr><td class="orange-text">5</td><td>40</td><td>80</td></tr>
						<tr><td class="orange-text">6</td><td>44</td><td>88</td></tr>
					<?php } ?>
			</tbody>
		</table>
		*Price in Euros
	</div>
	<div class="col-sm-3">
		&nbsp;
	</div>
</div>

<div class="row">
	<div class="col-sm-6">&nbsp;</div>
	<div class="col-sm-3 pull-right" style="margin-right: 15%" ><br/>
		<button class="pull-right btn btn-lg btn-sm btn-danger" type="submit">Save</button>
	</div>
</div>
</form>
