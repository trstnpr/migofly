<div class="tickets-content">

	<section class="section-banner data-img" data-bg="<?php echo base_url('build/images/banner/banner-2.jpeg'); ?>">

		<div class="overlay">
		
			<div class="container">

				<h2 class="page-subtitle"><?php echo $month.' '.date('Y'); ?></h2>
				<span class="title-line"></span>
				
				<h1 class="page-title">Tickets for <?php echo $origin->name.', '.country_city_code($origin->country).' to '.$city->name.', '.$city->country; ?></h1>

			</div>

		</div>

	</section>

	<section class="section-page">

		<div class="container">

			<div class="row">
			
				<div class="col-md-9 col-sm-8">

					<div class="section-content">

						<h2 class="section-title">Flight Tickets</h2>

						<?php
						if($origin->latitude != null and $origin->longitude != null and $city->latitude != null and $city->longitude != null) {
						?>
						<div id="map"></div>
						<?php } ?>

						<div class="tickets-wrap">

						<?php
						if($tickets != NULL and isset($tickets->$dest_code)) {
							$ticket_data = json_decode(json_encode($tickets->$dest_code), true);
							usort($ticket_data, 'jSort');
							foreach($ticket_data as $ticket) {
						?>

							<div class="item">
								
								<div class="row">

									<div class="col-md-9">
										
										<div class="ticket-details">

											<div class="ticket-itinerary">

												<div class="row">
													
													<div class="col-sm-6">
														
														<div class="departure">
															<div class="info">
																<label>Departure</label>
																<p class="place"><?php echo $origin->name.', '.$origin->country.' to '.$city->name.', '.$city->country; ?></p>
																<h3 class="time"><?php echo date_time($ticket['departure_at']); ?></h3>
																<p class="date"><?php echo date_dd_month_yyyy($ticket['departure_at']); ?></p>
																
															</div>
														</div>

													</div>
													<div class="col-sm-6">
														
														<div class="return">
															<div class="info">
																<label>Return</label>
																<p class="place"><?php echo $city->name.', '.$city->country.' to '.$origin->name.', '.$origin->name; ?></p>
																<h3 class="time"><?php echo date_time($ticket['return_at']); ?></h3>
																<p class="date"><?php echo date_dd_month_yyyy($ticket['return_at']); ?></p>
																
															</div>
														</div>

													</div>

												</div>

											</div>

										</div>

									</div>

									<div class="col-md-3">
										
										<div class="ticket-flight-number">
											<div class="ticket-airline">
												<img src="<?php echo airline_logo($ticket['airline'], 500, 70); ?>" alt="<?php echo airline($ticket['airline'])->name; ?>" title="<?php echo airline($ticket['airline'])->name; ?>" class="img-responsive" />
											</div>
											Flight Number <?php echo $ticket['flight_number']; ?>
										</div>
										<div class="ticket-price">
											<a href="<?php echo flight_search_url($params, 1) ?>" target="_blank" class="btn btn-success btn-lg btn-block"><?php echo $ticket['price']; ?> USD</a>
										</div>
										
									</div>

								</div>

							</div>

						<?php	
							}
						} else { ?>
							<h3 class="text-center">No Tickets Available.</h3>
						<?php } ?>

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