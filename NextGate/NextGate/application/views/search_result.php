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

<div id="pagewrapper">
	<!-- CREATE TABS FOR EACH OF THE SINGERS FOUND -->
	<ul class="nav nav-tabs">
	<?php 
		$i = 0;
		foreach ( $albums as $key => $vals)
		{
	?>
			<li role="presentation">
				<a href="#<?php echo $i?>"  data-toggle="tab"> 
					<?php
						echo $key;
					?>
				</a>
			</li>
		<?php
			$i = $i + 1;
		}
	?>
	</ul>
	<!-- THE CONTENT FOR EACH TAB ----------------------------- -->
	<div class="tab-content">
	<!-- ALBUM NAME ============================ -->
		<?php 
			$i =0;
			$test = array();
			//CREATE THE VIEW FOR EACH ARTIST TAB 
			foreach ( $albums as $key => $vals )
			{
		?>
    			<div id="<?php echo $i?>" class="tab-pane fade">
					<?php
//////////////////////////////// ARTIST INFO ///////////////////////////////////////////////
						//if (!array_key_exists($key, $test))
						if (isset($test[$key]))
						{
							echo "NOT HERE PRESENT";
						}
						else
						{
							$test[$key] = 1;
							$artist = $singers[$key];
							$artist_info = explode ("|", $artist[0]);
					?>
							<div class="media">
						 	<img style="float:left" src="<?php echo base_url('assets/pictures/singer.jpg')?>" class="img-responsive" alt="default pic" width="200" height="200"> 
      						<h2> Name: <?php echo ucwords(strtolower($artist_info[0])) ?> </h1>
      						<h3> Date of Birth: <?php echo $artist_info[1] ?> </h2>
      						<h3> Sex: <?php echo ucfirst(strtolower($artist_info[2])) ?> </h3>
							</div>
							<hr>
					<?php
						}
					?>
					<div id="albums">
								<h1>ALBUMS</h1>
					</div>
					<?php
////////////////////////////////// TO BE THE ALBUM INFO
?>
					<div class="row">

<?php	
						foreach ($vals as $v )
						{
							$album_info = explode ("|", $v);
							//ALBUM NAME -> 0, RELEASE_YEAR -> 1, RECORD COMPANY -> 2
					?>
  							<div class="col-xs-6 col-md-3">
 						   		<a href="#" class="thumbnail">
 						     		<img src="<?php echo base_url('assets/pictures/no_cover.jpg')?>" alt="album_cover">
 						   		</a>
								<center>
      								<p> <?php echo $album_info[0] ?> </p>
      								<p> <?php echo $album_info[1] ?> </p>
      								<p> <?php echo $album_info[2] ?> </p>
								</center>
 						 	</div>
					<?php
						}
					?>
					</div>
    			</div>
		<?php
			$i = $i+1;
			}
		?>
  </div>	


</div>
