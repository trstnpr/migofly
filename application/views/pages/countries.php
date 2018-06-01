<div class="countries-content">

	<section class="section-banner data-img" data-bg="<?php echo base_url('build/images/banner/banner-5.jpeg'); ?>">

		<div class="overlay">
		
			<div class="container">

				<h2 class="page-subtitle"><?php echo the_config('site_name'); ?></h2>
				<span class="title-line"></span>
				
				<h1 class="page-title">All Countries</h1>

			</div>

		</div>

	</section>

	<section class="section-page">

		<div class="container">

			<div class="row">
			
				<div class="col-md-9 col-sm-8">

					<div class="section-content">

						<h2 class="section-title">All Countries</h2>

						<?php if($countries->result()) { ?>

						<div class="countries-wrap">

							<div class="masonry-row">
							<?php foreach($countries->result() as $country) { ?>
								<div class="masonry-cell">
									
									<div class=" country-item">
										<a href="<?php echo base_url('country/'.strtolower($country->code)); ?>">
											<span><img src="<?php echo base_url('build/images/flags/sm/'.strtolower($country->code).'.png'); ?>" alt="" />&nbsp;</span> <?php echo $country->name; ?>
										</a>
									</div>

								</div>
							<?php } ?>

							</div>

						</div>


						<?php

							if (strlen($pagination)) {
	                            echo $pagination;
	                        }

						} else { ?>
							
							<h2 class="text-center">No Country Available</h2>

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