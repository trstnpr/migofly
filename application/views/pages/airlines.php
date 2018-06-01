<div class="destinations-content">

	<section class="section-banner data-img" data-bg="<?php echo base_url('build/images/banner/banner-1.jpeg'); ?>">

		<div class="overlay">
		
			<div class="container">

				<h2 class="page-subtitle"><?php echo the_config('site_name'); ?></h2>
				<span class="title-line"></span>
				
				<h1 class="page-title">All Airlines</h1>

			</div>

		</div>

	</section>

	<section class="section-page">

		<div class="container">

			<div class="row">
			
				<div class="col-md-9 col-sm-8">

					<div class="section-content">

						<h2 class="section-title">All Airlines</h2>
						<?php if($airlines->result()) { ?>
						<div class="destination-wrap">
							<?php foreach($airlines->result() as $airline) { ?>
							<div class="item">
								<div class="media">
									<div class="media-left">
										<a href="<?php echo base_url('airline/'.$airline->slug); ?>">
											<img src="<?php echo airline_logo($airline->iata, 500, 500); ?>" class="media-object city-thumb" alt="<?php echo $airline->name; ?>" title="<?php echo $airline->name; ?>" />
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading"><?php echo $airline->name; ?></h4>
										<small><?php echo base_url('airline/'.$airline->slug); ?></small>
										<ul class="info list-inline">
											<li><i class="fa fa-location-arrow"></i> <?php echo $airline->country; ?></li>
											<?php if($airline->is_active == 'true') { ?>
											<li><i class="fa fa-check-circle-o"></i> Active</li>
											<?php } else { ?>
											<li><i class="fa fa-times-circle-o"></i> Inactive</li>
											<?php } ?>
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

					<div class="aside">

						<?php include('partials/widget-aside-search.php'); ?>

						<?php include('partials/widget-aside-download.php'); ?>

						<?php include('partials/widget-aside-blog.php'); ?>
						
						<?php include('partials/widget-aside-menu.php'); ?>
						
					</div>

				</div>

			</div>

		</div>

	</section>

</div>