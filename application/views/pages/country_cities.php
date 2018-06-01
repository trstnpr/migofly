<div class="destinations-content">

	<section class="section-banner data-img" data-bg="<?php echo base_url('build/images/banner/banner-5.jpeg'); ?>">

		<div class="overlay">
		
			<div class="container">

				<h2 class="page-subtitle"><?php echo the_config('site_name'); ?></h2>
				<span class="title-line"></span>
				
				<h1 class="page-title"><?php echo $country->name; ?> Cities</h1>

			</div>

		</div>

	</section>

	<section class="section-page">

		<div class="container">

			<div class="row">
			
				<div class="col-md-9 col-sm-8">

					<div class="section-content">

						<h2 class="section-title"><?php echo $country->name; ?> Locations</h2>

						<?php if($cities->result()) { ?>

						<div class="destination-wrap">
							<?php foreach($cities->result() as $city) { ?>
							<div class="item">
								<div class="media">
									<div class="media-left">
										<a href="<?php echo base_url('city/'.strtolower($city->code)); ?>">
											<img class="media-object city-thumb" src="<?php echo static_map_xy($city->latitude, $city->longitude); ?>" title="<?php echo country_name($city->country); ?>" />
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading"><strong><?php echo $city->name; ?></strong> <small><?php echo $city->country_name; ?></small></h4>
										<ul class="info">
											<li><i class="fa fa-plane"></i> Travel from <strong><?php echo $city->name.', '.$city->country; ?></strong> to any popular cities around the world any month of the year.</li>
											<li><i class="fa fa-check-circle-o"></i> Check for available flight tickets for every month of the year.</li>
										</ul>
										
									</div>
								</div>
							</div>
							<?php } ?>

						</div>


						<?php

							if (strlen($pagination)) {
	                            echo $pagination;
	                        }

						} else { ?>
							
							<h2 class="text-center">No Destinations Available</h2>

						<?php } ?>

					</div>
					
				</div>
				
				<div class="col-md-3 col-sm-4">

					<?php if(current_url() == base_url('watch-movies-while-on-travel')) { ?>

					<div class="aside">
						
						<?php include('partials/widget-aside-mob.php'); ?>

					</div>

					<?php } else { ?>

					<div class="aside">

						<?php include('partials/widget-aside-search.php'); ?>

						<?php include('partials/widget-aside-download.php'); ?>

						<?php include('partials/widget-aside-blog.php'); ?>
						
						<?php include('partials/widget-aside-menu.php'); ?>
						

					</div>

					<?php } ?>

				</div>

			</div>

		</div>

	</section>

</div>