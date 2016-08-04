<style> .errors {color: red;} </style>
<style> 
	.errors 
	{	
		color: red;
	}
	#brand
	{
		position: relative;
		top: -33px;
	}
	.tab-content
	{
		background-color: #99b3ff;
	}
	#albums
	{
		font-family: 'Ceviche One', cursive;
	}

</style>

<div class="modal-header">
	<h1>Add User </h1>
	<p>Please enter credentials for new user</p>
</div>

<div class="modal-body">
	<!-- New Login for user enters USERNAME and PASSWORD -->
	<div class="errors"> <?php echo validation_errors(); ?> </div>
	<?php echo form_open('user/add_user'); ?>
	
	<table class="table">
		<tr>
			<td>
				Username: 
			</td>
			<td>
				<?php echo form_input('username', set_value(''), 'id = username'); ?>
			</td>
		</tr>

		<tr>
			<td>Password</td>
			<td>
				<?php echo form_password('password', set_value(''), 'id = password'); ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php echo form_submit('submit', 'Create User', 'class="btn btn-primary"'); ?>
			</td>
		</tr>
	</table>
	<?php echo form_close(); ?>
</div>

