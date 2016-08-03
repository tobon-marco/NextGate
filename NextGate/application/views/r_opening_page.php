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
	#brand
	{
		position: relative;
		top: -33px;
	}
	
</style>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" id="brand">
	  	<img alt="NextGate" src="<?php echo base_url('assets/pictures/nextgate-logo.png');?>"> 
	  </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="root">Home <span class="sr-only">(current)</span></a></li>
        <li class=""><a href="index">Add User <span class="sr-only"></span></a></li>
        <li class=""><a href="index">Add Music <span class="sr-only"></span></a></li>
        <li><?php echo anchor('User/logout','Logout') ?><span class="sr-only"></span></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
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
