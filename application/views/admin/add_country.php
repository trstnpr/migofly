<div class="pages-section">

	<section class="section-header">
		
		<div class="container-fluid">
			
			<div class="page-title">
				<h1>Add New Country</h1>
			</div>

			<div class="breadcrumb-wrap">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
					<li><a href="<?php echo base_url('admin/countries'); ?>">Countries</a></li>
					<li class="active">New</li>
				</ol>
			</div>

		</div>

	</section>

	<section class="section-content">
		
		<div class="container-fluid">

			<form class="addcountry-form" method="post" action="<?php echo base_url('admin/countries/new'); ?>">
			
				<div class="row">
					
					<div class="col-md-9">
						<div class="well">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control" name="name" placeholder="Enter country name ..." required />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Code</label>
										<input type="text" class="form-control slugcity to-upper" name="code" maxlength="2" placeholder="Enter country code ..." required />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Slug</label>
										<input type="text" class="form-control slug" name="slug" data-slug="<?php echo base_url('admin/validateslug'); ?>" data-posttype="country" placeholder="Country slug ..." readonly required />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Background</label>
										<textarea class="form-control wysiwyg" name="background" placeholder="Country background ..."></textarea>
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
									            	<input type="text" class="form-control" name="map_reference" placeholder="Enter map reference" />
												</div>
											</div>
											<div class="col-md-4">
												<label>Coordinates</label>
									            <input type="text" class="form-control" name="coordinates" placeholder="Enter coordinates" />
											</div>
											<div class="col-md-4">
												<label>Area</label>
									            <input type="text" class="form-control" name="area" placeholder="Enter area" />
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
													<input type="text" class="form-control" name="population" placeholder="Country population ..." />
												</div>
						                	</div>
						                	<div class="col-md-6">
						                		<div class="form-group">
													<label>Nationality</label>
													<input type="text" class="form-control" name="nationality" placeholder="Country nationality ..." />
												</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
													<label>Ethnic Groups</label>
													<textarea rows="3" class="form-control" name="ethnic_groups" placeholder="Ethnic Groups ..."></textarea>
												</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
													<label>Languages</label>
													<textarea rows="3" class="form-control" name="languages" placeholder="Languages ..."></textarea>
												</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
													<label>Religions</label>
													<textarea rows="3" class="form-control" name="religions" placeholder="Religions ..."></textarea>
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
													<input type="text" class="form-control" name="conventional_name" placeholder="Convertional Name ..." />
												</div>
						                	</div>
						                	<div class="col-md-6">
						                		<div class="form-group">
													<label>Government Type</label>
													<input type="text" class="form-control" name="government_type" placeholder="Government Type ..." />
												</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
													<label>Capital</label>
													<input type="text" class="form-control" name="capital" placeholder="Capital ..." />
												</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
													<label>Administrative Divisions</label>
													<textarea rows="4" class="form-control" name="administrative_divisions" placeholder="Administrative Divisions ..."></textarea>
												</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
													<label>Independence</label>
													<input type="text" class="form-control" name="independence" placeholder="Independence ..." />
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
						                			<textarea name="economy_overview" class="form-control" rows="5" placeholder="Economy overview ..."></textarea>
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<labrl>GDP</labrl>
						                			<input type="text" name="gdp_exchange_rate" class="form-control" placeholder="GDP exchange rate ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<labrl>Agriculture</labrl>
						                			<textarea rows="3" name="agriculture" class="form-control" placeholder="Agriculture ..."></textarea>
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<labrl>Industries</labrl>
						                			<textarea rows="3" name="industries" class="form-control" placeholder="Industries ..." ></textarea>
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<labrl>Labor Force</labrl>
						                			<input type="text" name="labor_force" class="form-control" placeholder="Labor Force ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<labrl>Exports</labrl>
						                			<textarea rows="3" name="labor_force" class="form-control" placeholder="Labor Force ..." ></textarea>
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
						                			<input type="text" name="electricity" class="form-control" placeholder="Electricity ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Crude Oil</label>
						                			<input type="text" name="crude_oil" class="form-control" placeholder="Crude Oil ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Refined Petroleum</label>
						                			<input type="text" name="refined_petroleum" class="form-control" placeholder="Refined Petroleum ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Gatural Gas</label>
						                			<input type="text" name="natural_gas" class="form-control" placeholder="Natural Gas ..." />
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
						                			<input type="text" name="aircraft_code_prefix" class="form-control" placeholder="Aircraft Code Prefix ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Airports</label>
						                			<input type="text" name="airports" class="form-control" placeholder="Airports ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Heliports</label>
						                			<input type="text" name="heliports" class="form-control" placeholder="Heliports ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Pipelines</label>
						                			<input type="text" name="pipelines" class="form-control" placeholder="Pipelines ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Railways</label>
						                			<input type="text" name="railways" class="form-control" placeholder="Railways ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Roadways</label>
						                			<input type="text" name="roadways" class="form-control" placeholder="Roadways ..." />
						                		</div>
						                	</div>
						                	<div class="col-md-12">
						                		<div class="form-group">
						                			<label>Waterways</label>
						                			<input type="text" name="waterways" class="form-control" placeholder="Waterways ..." />
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