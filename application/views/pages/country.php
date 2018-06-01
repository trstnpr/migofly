<div class="country-content">

	<section class="section-banner data-img" data-bg="<?php echo base_url('build/images/banner/banner-'.rand(1,10).'.jpeg'); ?>">

		<div class="overlay">
		
			<div class="container">

				<h2 class="page-subtitle"><?php echo the_config('site_name'); ?></h2>
				<span class="title-line"></span>
				
				<h1 class="page-title"><?php echo $country->name; ?></h1>

			</div>

		</div>

	</section>

	<section class="section-page">

		<div class="container">

			<div class="row">
			
				<div class="col-md-9 col-sm-8">

					<div class="section-content">

						<h2 class="section-title"><?php echo $country->name; ?></h2>

						<div class="content-wrap">

							<div class="content-section thumb">
								<div class="thumbnail">
									<img src="https://maps.googleapis.com/maps/api/staticmap?zoom=4&size=500x200&scale=2&maptype=roadmap&sensor=false&language=en&markers=color:red|<?php echo $country->name; ?>&key=<?php echo the_config('gmap_apikey'); ?>" alt="...">
								</div>
							</div>

							<div class="country-to-world">
								<div class="row">
									<div class="col-md-10 col-md-offset-1">
										<div class="ctw-wrap data-img" data-bg="<?php echo base_url('build/images/flags/'.strtolower($country->code).'.png'); ?>">
											<div class="overlay">
												<p>Travel from any point in <?php echo $country->name; ?> to popular destinations.</p>
												<a href="<?php echo base_url('city/'.strtolower($country->code)); ?>" class="ctw-cta">Click here</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="content-section background">
								<h3 class="section-label">Background</h3>
								<hr/>

								<?php echo $country->background; ?>

							</div>

							<div class="panel-group country-info-group" id="accordion" role="tablist" aria-multiselectable="true">
							    <div class="panel panel-default">
							        <div class="panel-heading" role="tab" id="headingFlag">
							            <h4 class="panel-title">
							                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#flag" aria-expanded="true" aria-controls="flag">
									        	Flag of the <?php echo $country->name ?>
									        </a>
							            </h4>
							        </div>
							        <div id="flag" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFlag">
							            <div class="panel-body">
							            	<div class="row">
							            		<div class="col-sm-8 col-sm-offset-2">
									            	<div class="thumb">
									        			<img src="<?php echo base_url('build/images/flags/'.strtolower($country->code).'.png'); ?>" class="img-responsive" alt="<?php echo 'Flag of the '.$country->name; ?>" title="<?php echo 'Flag of the '.$country->name; ?>" />
									        		</div>
									        	</div>
									        </div>
							            </div>
							        </div>
							    </div>
							    <div class="panel panel-default">
							        <div class="panel-heading" role="tab" id="headingGeography">
							            <h4 class="panel-title">
							                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#geography" aria-expanded="false" aria-controls="geography">
									        	Geography
									        </a>
							            </h4>
							        </div>
							        <div id="geography" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGeography">
							            <div class="panel-body">
							        		<div class="table-responsive">
												<table class="table table-striped">
													<thead>
														<tr>
															<th>Key</th>
															<th>Value</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Map Reference</td>
															<td><?php echo $country->map_reference; ?></td>
														</tr>
														<tr>
															<td>Coordinates</td>
															<td><?php echo $country->coordinates; ?></td>
														</tr>
														<tr>
															<td>Area</td>
															<td><?php echo $country->area; ?></td>
														</tr>
														<tr>
															<td>Popular Cities</td>
															<td><?php echo count(cities_of_country($country->code)); ?> <a href="<?php echo base_url('country/'.$country->slug.'/city'); ?>" class="label label-primary">See all</a></td>
														</tr>
													</tbody>
												</table>
											</div>
							            </div>
							        </div>
							    </div>
							    <div class="panel panel-default">
							        <div class="panel-heading" role="tab" id="headingPeopleSociety">
							            <h4 class="panel-title">
							                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#peopleSociety" aria-expanded="false" aria-controls="peopleSociety">
									        	People and Society
									        </a>
							            </h4>
							        </div>
							        <div id="peopleSociety" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingPeopleSociety">
							            <div class="panel-body">
							                <div class="table-responsive">
												<table class="table table-striped">
													<thead>
														<tr>
															<th width="30%">Key</th>
															<th>Value</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Population</td>
															<td><?php echo $country->population; ?></td>
														</tr>
														<tr>
															<td>Citizen</td>
															<td><?php echo $country->nationality; ?></td>
														</tr>
														<tr>
															<td>Ethnic Groups</td>
															<td><?php echo $country->ethnic_groups; ?></td>
														</tr>
														<tr>
															<td>Languages</td>
															<td><?php echo $country->languages; ?></td>
														</tr>
														<tr>
															<td>Religions</td>
															<td><?php echo $country->religions; ?></td>
														</tr>
													</tbody>
												</table>
											</div>
							            </div>
							        </div>
							    </div>
							    <div class="panel panel-default">
							        <div class="panel-heading" role="tab" id="headingGovernment">
							            <h4 class="panel-title">
							                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#government" aria-expanded="false" aria-controls="government">
									        	Government 
									        </a>
							            </h4>
							        </div>
							        <div id="government" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGovernment">
							            <div class="panel-body">
							                <div class="table-responsive">
												<table class="table table-striped">
													<thead>
														<tr>
															<th width="30%">Key</th>
															<th>Value</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Country Name</td>
															<td><?php echo $country->conventional_name; ?></td>
														</tr>
														<tr>
															<td>Government Type</td>
															<td><?php echo $country->government_type; ?></td>
														</tr>
														<tr>
															<td>Capital</td>
															<td><?php echo $country->capital; ?></td>
														</tr>
														<tr>
															<td>Administrative divisions</td>
															<td><?php echo $country->administrative_divisions; ?></td>
														</tr>
														<tr>
															<td>Independence</td>
															<td><?php echo $country->independence; ?></td>
														</tr>
													</tbody>
												</table>
											</div>
							            </div>
							        </div>
							    </div>
							    <div class="panel panel-default">
							        <div class="panel-heading" role="tab" id="headingEconomy">
							            <h4 class="panel-title">
							                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#economy" aria-expanded="false" aria-controls="economy">
									        	Economy 
									        </a>
							            </h4>
							        </div>
							        <div id="economy" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEconomy">
							            <div class="panel-body">
							            	<?php if($country->economy_overview) { ?>
							            	<div style="padding:20px;background-color:#fff;">
							            		<?php echo $country->economy_overview; ?>
							            	</div>
							            	<?php } ?>
							                <div class="table-responsive">
												<table class="table table-striped">
													<thead>
														<tr>
															<th width="30%">Key</th>
															<th>Value</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>GDP</td>
															<td><?php echo $country->gdp_exchange_rate; ?></td>
														</tr>
														<tr>
															<td>Agriculture</td>
															<td><?php echo $country->agriculture; ?></td>
														</tr>
														<tr>
															<td>Industries</td>
															<td><?php echo $country->industries; ?></td>
														</tr>
														<tr>
															<td>Labor Force</td>
															<td><?php echo $country->labor_force; ?></td>
														</tr>
														<tr>
															<td>Exports</td>
															<td><?php echo $country->exports; ?></td>
														</tr>
													</tbody>
												</table>
											</div>
							            </div>
							        </div>
							    </div>
							    <div class="panel panel-default">
							        <div class="panel-heading" role="tab" id="headingEnergy">
							            <h4 class="panel-title">
							                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#energy" aria-expanded="false" aria-controls="energy">
									        	Energy 
									        </a>
							            </h4>
							        </div>
							        <div id="energy" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEnergy">
							            <div class="panel-body">
							                <div class="table-responsive">
												<table class="table table-striped">
													<thead>
														<tr>
															<th width="30%">Key</th>
															<th>Value</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Electricity</td>
															<td><?php echo $country->electricity; ?></td>
														</tr>
														<tr>
															<td>Crude Oil</td>
															<td><?php echo $country->crude_oil; ?></td>
														</tr>
														<tr>
															<td>Refined Petroleum</td>
															<td><?php echo $country->refined_petroleum; ?></td>
														</tr>
														<tr>
															<td>Natural Gas</td>
															<td><?php echo $country->natural_gas; ?></td>
														</tr>
													</tbody>
												</table>
											</div>
							            </div>
							        </div>
							    </div>
							    <div class="panel panel-default">
							        <div class="panel-heading" role="tab" id="headingTransportation">
							            <h4 class="panel-title">
							                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#transportation" aria-expanded="false" aria-controls="transportation">
									        	Transportation 
									        </a>
							            </h4>
							        </div>
							        <div id="transportation" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTransportation">
							            <div class="panel-body">
							                <div class="table-responsive">
												<table class="table table-striped">
													<thead>
														<tr>
															<th width="30%">Key</th>
															<th>Value</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Country Code</td>
															<td><?php echo $country->aircraft_code_prefix; ?></td>
														</tr>
														<tr>
															<td>Airports</td>
															<td><?php echo $country->airports; ?></td>
														</tr>
														<tr>
															<td>Heliports</td>
															<td><?php echo $country->heliports; ?></td>
														</tr>
														<tr>
															<td>Pipelines</td>
															<td><?php echo $country->pipelines; ?></td>
														</tr>
														<tr>
															<td>Railways</td>
															<td><?php echo $country->railways; ?></td>
														</tr>
														<tr>
															<td>Roadways</td>
															<td><?php echo $country->roadways; ?></td>
														</tr>
														<tr>
															<td>Waterways</td>
															<td><?php echo $country->waterways; ?></td>
														</tr>
													</tbody>
												</table>
											</div>
							            </div>
							        </div>
							    </div>
							</div>
						
						</div>

						<hr/>

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