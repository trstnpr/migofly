<div class="pages-section">

	<section class="section-header">
		
		<div class="container-fluid">
			
			<div class="page-title">
				<h1>Edit Country</h1>
			</div>

			<div class="breadcrumb-wrap">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
					<li><a href="<?php echo base_url('admin/countries'); ?>">Countries</a></li>
					<li class="active">Edit</li>
				</ol>
			</div>

		</div>

	</section>

	<section class="section-content">
		
		<div class="container-fluid">

			<form class="updatecountry-form" method="post" action="<?php echo base_url('admin/countries/edit/'.$country->id); ?>">
			
				<div class="row">
					
					<div class="col-md-9">
						<div class="well">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control" name="name" value="<?php echo $country->name; ?>" placeholder="Enter country name ..." required />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Code</label>
										<input type="text" class="form-control slugcity to-upper" name="code" maxlength="2" value="<?php echo $country->code; ?>" placeholder="Enter country code ..." required />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Slug</label>
										<input type="text" class="form-control slug" name="slug" data-slug="<?php echo base_url('admin/validateslug'); ?>" data-posttype="country" placeholder="Country slug ..." value="<?php echo $country->slug; ?>" readonly />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Background</label>
										<textarea class="form-control wysiwyg" name="background" placeholder="Country background ..."><?php echo $country->background; ?></textarea>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						    <div class="panel panel-default">
						        <div class="panel-heading">
						            <h4 class="panel-title">
						                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#geography">Geography</a>
						            </h4>
						        </div>
						        <div id="geography" class="panel-collapse collapse in">
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-4">
												<div class="form-group">
													<label>Map Reference</label>
									            	<input type="text" class="form-control" name="map_reference" value="<?php echo $country->map_reference; ?>" placeholder="Enter map reference" />
												</div>
											</div>
											<div class="col-md-4">
												<label>Coordinates</label>
									            <input type="text" class="form-control" name="coordinates" value="<?php echo $country->coordinates; ?>" placeholder="Enter coordinates" />
											</div>
											<div class="col-md-4">
												<label>Area</label>
									            <input type="text" class="form-control" name="area" value="<?php echo $country->area; ?>" placeholder="Enter area" />
											</div>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="panel panel-default">
						        <div class="panel-heading">
						            <h4 class="panel-title">
						                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#people_society">People And Society</a>
						            </h4>
						        </div>
						        <div id="people_society" class="panel-collapse collapse">
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-6">
						                		<div class="form-group">
													<label>Population</label>
													<input type="text" class="form-control" name="population" value="<?php echo $country->population; ?>" placeholder="Country population ..." />
												</div>
						                	</div>
						                	<div class="col-md-6">
						                		<div class="form-group">
													<label>Nationality</label>
													<input type="text" class="form-control" name="nationality" value="<?php echo $country->nationality; ?>" placeholder="Country nationality ..." />
												</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
													<label>Ethnic Groups</label>
													<textarea rows="3" class="form-control" name="ethnic_groups" placeholder="Ethnic Groups ..."><?php echo $country->ethnic_groups; ?></textarea>
												</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
													<label>Languages</label>
													<textarea rows="3" class="form-control" name="languages" placeholder="Languages ..."><?php echo $country->languages; ?></textarea>
												</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
													<label>Religions</label>
													<textarea rows="3" class="form-control" name="religions" placeholder="Religions ..."><?php echo $country->religions; ?></textarea>
												</div>
						                	</div>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="panel panel-default">
						        <div class="panel-heading">
						            <h4 class="panel-title">
						                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#government">Government</a>
						            </h4>
						        </div>
						        <div id="government" class="panel-collapse collapse">
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-6">
						                		<div class="form-group">
													<label>Convertional Name</label>
													<input type="text" class="form-control" name="conventional_name" value="<?php echo $country->conventional_name; ?>" placeholder="Convertional Name ..." />
												</div>
						                	</div>
						                	<div class="col-md-6">
						                		<div class="form-group">
													<label>Government Type</label>
													<input type="text" class="form-control" name="government_type" value="<?php echo $country->government_type; ?>" placeholder="Government Type ..." />
												</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
													<label>Capital</label>
													<input type="text" class="form-control" name="capital" value="<?php echo $country->capital; ?>" placeholder="Capital ..." />
												</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
													<label>Administrative Divisions</label>
													<textarea rows="4" class="form-control" name="administrative_divisions" value="<?php echo $country->administrative_divisions; ?>" placeholder="Administrative Divisions ..."></textarea>
												</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
													<label>Independence</label>
													<input type="text" class="form-control" name="independence" value="<?php echo $country->independence; ?>" placeholder="Independence ..." />
												</div>
						                	</div>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="panel panel-default">
						        <div class="panel-heading">
						            <h4 class="panel-title">
						                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#economy">Economy</a>
						            </h4>
						        </div>
						        <div id="economy" class="panel-collapse collapse">
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Economy Overview</label>
						                			<textarea name="economy_overview" class="form-control" rows="5" placeholder="Economy overview ..."><?php echo $country->economy_overview; ?></textarea>
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<labrl>GDP</labrl>
						                			<input type="text" name="gdp_exchange_rate" class="form-control" value="<?php echo $country->gdp_exchange_rate; ?>" placeholder="GDP exchange rate ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<labrl>Agriculture</labrl>
						                			<textarea rows="3" name="agriculture" class="form-control" placeholder="Agriculture ..."><?php echo $country->agriculture ?></textarea>
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<labrl>Industries</labrl>
						                			<textarea rows="3" name="industries" class="form-control" placeholder="Industries ..." ><?php echo $country->industries; ?></textarea>
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<labrl>Labor Force</labrl>
						                			<input type="text" name="labor_force" class="form-control" value="<?php echo $country->labor_force; ?>" placeholder="Labor Force ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<labrl>Exports</labrl>
						                			<textarea rows="3" name="exports" class="form-control" placeholder="Exports ..." ><?php echo $country->exports; ?></textarea>
						                		</div>
						                	</div>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="panel panel-default">
						        <div class="panel-heading">
						            <h4 class="panel-title">
						                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#energy">Energy</a>
						            </h4>
						        </div>
						        <div id="energy" class="panel-collapse collapse">
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Electricity</label>
						                			<input type="text" name="electricity" class="form-control" value="<?php echo $country->electricity; ?>" placeholder="Electricity ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Crude Oil</label>
						                			<input type="text" name="crude_oil" class="form-control" value="<?php echo $country->crude_oil; ?>" placeholder="Crude Oil ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Refined Petroleum</label>
						                			<input type="text" name="refined_petroleum" class="form-control" value="<?php echo $country->refined_petroleum; ?>" placeholder="Refined Petroleum ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Gatural Gas</label>
						                			<input type="text" name="natural_gas" class="form-control" value="<?php echo $country->natural_gas; ?>" placeholder="Natural Gas ..." />
						                		</div>
						                	</div>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="panel panel-default">
						        <div class="panel-heading">
						            <h4 class="panel-title">
						                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#transportaion">Transportation</a>
						            </h4>
						        </div>
						        <div id="transportaion" class="panel-collapse collapse">
						            <div class="panel-body">
						                <div class="row">
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Aircraft Code Prefix</label>
						                			<input type="text" name="aircraft_code_prefix" class="form-control" value="<?php echo $country->aircraft_code_prefix; ?>" placeholder="Aircraft Code Prefix ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Airports</label>
						                			<input type="text" name="airports" class="form-control" value="<?php echo $country->airports; ?>" placeholder="Airports ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Heliports</label>
						                			<input type="text" name="heliports" class="form-control" value="<?php echo $country->heliports; ?>" placeholder="Heliports ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Pipelines</label>
						                			<input type="text" name="pipelines" class="form-control" value="<?php echo $country->pipelines; ?>" placeholder="Pipelines ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Railways</label>
						                			<input type="text" name="railways" class="form-control" value="<?php echo $country->railways; ?>" placeholder="Railways ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Roadways</label>
						                			<input type="text" name="roadways" class="form-control" value="<?php echo $country->roadways; ?>" placeholder="Roadways ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Waterways</label>
						                			<input type="text" name="waterways" class="form-control" value="<?php echo $country->waterways; ?>" placeholder="Waterways ..." />
						                		</div>
						                	</div>
						                </div>
						            </div>
						        </div>
						    </div>
						</div>
					</div>

					<div class="col-md-3">
						
						<div class="panel-group" id="accordion4" role="tablist" aria-multiselectable="true">
						    <div class="panel panel-default">
						        <div class="panel-heading" role="tab" id="headingOne">
						            <h4 class="panel-title">
								        <a role="button" data-toggle="collapse" data-parent="#accordion4" href="#action" aria-expanded="true" aria-controls="collapseOne">
								         	Action
								        </a>
								    </h4>
						        </div>
						        <div id="action" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						            <div class="panel-body">
						            	<button type="submit" class="btn btn-success btn-block btn-save">Save</button>
						            </div>
						        </div>
						    </div>
						</div>

					</div>

				</div>

			</form>

		</div>

	</section>

</div>