<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang = "en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<link href="<?php echo base_url('assets/css/bootstrap-theme.css');?>" rel="stylesheet" media="screen" />
	<link href="<?php echo base_url('assets/css/bootstrap-theme.min.css');?>" rel="stylesheet" media="screen" />
	<link href="<?php echo base_url('assets/css/bootstrap.css');?>" rel="stylesheet" media="screen" />
	<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" media="screen" />
	<script src="<?php echo base_url('assets/js/bootstrap.js');?>" type="text/javascript" > </script> 
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript" > </script> 
	<link href='https://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Ceviche+One' rel='stylesheet' type='text/css'>
	<meta charset="utf-8">
	<title> <?php echo $meta_title ?></title>
</head>

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
        <li class="active"><a href="index">Home <span class="sr-only">(current)</span></a></li>
        <li><?php echo anchor('User/logout','Logout') ?><span class="sr-only"></span></li>
      </ul>

		<form class="navbar-form navbar-right" role="search" action="<?=site_url('User/search')?>" method="post">
        	<div class="input-group">
            	<input type="text" class="form-control" name="search" placeholder="Search this site">
                	<span class="input-group-btn">
                    	<button type="submit" class="btn btn-default">Submit!</button>
                    </span>
             </div>
		</form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
