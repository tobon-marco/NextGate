<style> 
	.errors 
	{	
		color: red;
	}
	#pagewrapper
	{
		position:relative;
		top:250px;
	}
	#opening-font
	{
		font-family: 'Rock Salt', cursive;
	}
	
</style>
<div id="pagewrapper">
	<h1 id="opening-font">
		<center>
			Music Database
		</center>
	</h1>
	<div>
		<center>
		<img alt="NextGate Database" src="<?php echo base_url('assets/pictures/database.jpg');?>"> 
		</center>
	</div>
	<!-- =========================== ENTER NAME OF FORM TO OPEN ======================================== -->

	<div>
		<center>
		<?php echo form_open('user/search'); ?>
			<div class="form-group">
				<?php echo form_input('search', set_value(''), 'id = search; style="width:38%"'); ?>
			</div>
				<?php echo form_submit('submit', 'Search', 'class="btn btn-primary"'); ?>
		<?php echo form_close(); ?>
		</center>
	</div>
</div>
