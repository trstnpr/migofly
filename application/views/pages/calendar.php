<div class="page-content">

	<section class="section-banner data-img" data-bg="<?php echo base_url('build/images/banner/banner-2.jpeg'); ?>">

		<div class="overlay">
		
			<div class="container">

				<h2 class="page-subtitle"><?php echo the_config('site_name'); ?></h2>
				<span class="title-line"></span>
				
				<h1 class="page-title">Travel from <?php echo $origin->name.', '.country_city_code($origin->country).' to '.$city->name.', '.$city->country; ?></h1>

			</div>

		</div>

	</section>

	<section class="section-page">

		<div class="container">

			<div class="row">
			
				<div class="col-md-9 col-sm-8">

					<div class="section-content">

						<h2 class="section-title">Ticket Calendar</h2>

						<div class="content-wrap">
							<?php
							if($origin->latitude != null and $origin->longitude != null and $city->latitude != null and $city->longitude != null) {
							?>
							<div id="map"></div>
							<?php } ?>

							<div class="month-calendar">
								
								<div class="row">
									<?php foreach(month() as $month) { ?>
									<div class="col-sm-3 col-xs-6">

										<div class="month-wrap data-img" data-bg="<?php echo base_url('build/images/banner/calendar.jpg'); ?>">
											<a href="<?php echo base_url('destination/'.strtolower($city->code).'/'.$month); ?>">
												<div class="overlay">
													<?php echo date_month($month); ?>
												</div>
											</a>
										</div>

									</div>
									<?php } ?>

								</div>

							</div>

							<hr/>

						</div>

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