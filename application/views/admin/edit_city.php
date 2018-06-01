<div class="pages-section">

	<section class="section-header">
		
		<div class="container-fluid">
			
			<div class="page-title">
				<h1>Edit City</h1>
			</div>

			<div class="breadcrumb-wrap">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
					<li><a href="<?php echo base_url('admin/cities'); ?>">Cities</a></li>
					<li class="active">Edit</li>
				</ol>
			</div>

		</div>

	</section>

	<section class="section-content">
		<div class="container-fluid">
			<form class="updatecity-form" method="post" action="<?php echo current_url(); ?>">
				<div class="row">
					<div class="col-md-9">
						<div class="well">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control" name="name" value="<?php echo $city->name; ?>" placeholder="Enter city name ..." required />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>City Code</label>
										<input type="text" class="form-control slugcity to-upper" name="code" value="<?php echo $city->code; ?>" maxlength="3" placeholder="Enter city code ..." required />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Country</label>
										<select class="form-control slugcountry" name="country">
											<option disabled>Select A Country</option>
											<?php foreach(countries() as $country) { ?>
											<option value="<?php echo $country->code; ?>" <?php echo ($country->code == $city->country) ? 'selected' : null; ?> ><?php echo $country->name; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Slug</label>
										<input type="text" class="form-control slug" name="slug" data-slug="<?php echo base_url('admin/validateslug'); ?>" data-posttype="city" value="<?php echo $city->slug; ?>" placeholder="City slug ..." readonly required />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Latitude (x)</label>
						            	<input type="text" class="form-control" name="latitude" value="<?php echo $city->latitude; ?>" placeholder="Enter latitude" />
									</div>
								</div>
								<div class="col-md-6">

									<label>Longitude (y)</label>
						            <input type="text" class="form-control" name="longitude" value="<?php echo $city->longitude; ?>" placeholder="Enter longitude" />

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