<div class="page-content">

	<section class="section-banner data-img" data-bg="<?php echo base_url('build/images/banner/banner-1.jpeg'); ?>">

		<div class="overlay">
		
			<div class="container">

				<h2 class="page-subtitle"><?php echo the_config('site_name'); ?></h2>
				<span class="title-line"></span>
				
				<h1 class="page-title"><?php echo $airline->name; ?></h1>

			</div>

		</div>

	</section>

	<section class="section-page">

		<div class="container">

			<div class="row">
			
				<div class="col-md-9 col-sm-8">

					<div class="section-content">

						<h2 class="section-title"><?php echo $airline->name; ?></h2>

						<div class="content-wrap">
							<hr/>
							<div class="airline-wrap">
								<?php if($airline->iata != NULL) { ?>
								<div class="airline-thumb-wrap">
									<img src="<?php echo airline_logo($airline->iata, 500, 150); ?>" alt="<?php echo $airline->name; ?>" title="<?php echo $airline->name; ?>" />
								</div>
								<?php } ?>

								<div class="table-responsive airline-details">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<th>Name</th>
												<td><?php echo $airline->name; ?></td>
											</tr>
											<tr>
												<th>Country</th>
												<td><?php echo $airline->country; ?></td>
											</tr>
											<tr>
												<th>Alias</th>
												<td><?php echo $airline->alias; ?></td>
											</tr>
											<tr>
												<th>IATA</th>
												<td><?php echo $airline->iata; ?></td>
											</tr>
											<tr>
												<th>ICAO</th>
												<td><?php echo $airline->icao; ?></td>
											</tr>
											<tr>
												<th>Callsign</th>
												<td><?php echo $airline->callsign; ?></td>
											</tr>
											<tr>
												<th>Status</th>
												<td>
													<?php if($airline->is_active == 'true') { ?>
													<label class="label label-success">ACTIVE</label>
													<?php } else { ?>
													<label class="label label-danger">INACTIVE</label>
													<?php } ?>
												</td>
											</tr>
										</tbody>
									</table>
								</div>

							</div>
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