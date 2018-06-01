<div class="pages-section">

	<section class="section-header">
		
		<div class="container-fluid">
			
			<div class="page-title">
				<h1>Add New Airline</h1>
			</div>

			<div class="breadcrumb-wrap">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
					<li><a href="<?php echo base_url('admin/aircrafts'); ?>">Aircrafts</a></li>
					<li class="active">New</li>
				</ol>
			</div>

		</div>

	</section>

	<section class="section-content">
		
		<div class="container-fluid">
			<form class="addaircraft-form" method="post" action="<?php echo base_url('admin/airlines/new'); ?>">
				<div class="row">
					<div class="col-md-9">
						<div class="well">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control" name="name" placeholder="Enter name ..." required />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Alias</label>
										<input type="text" class="form-control" name="alias" placeholder="Enter alias ..." required />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>IATA</label>
										<input type="text" class="form-control" name="iata" maxlength="3" placeholder="Enter iata ..." required />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>ICAO</label>
										<input type="text" class="form-control" name="icao" maxlength="3" placeholder="Enter icao ..." required />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Slug</label>
										<input type="text" class="form-control" name="slug" placeholder="Airline slug ..." />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Callsign</label>
										<input type="text" class="form-control" name="callsign" placeholder="Airline slug ..." />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Country</label>
										<select name="country" class="form-control">
											<option value="NULL" disabled selected>Choose country</option>
											<?php foreach(countries() as $country) { ?>
											<option value="<?php echo $country->name; ?>"><?php echo $country->name; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Status</label>
										<select name="is_active" class="form-control">
											<option value="NULL" disabled selected>Choose status</option>
											<option value="true">Active</option>
											<option value="false">Inactive</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
						    <div class="panel panel-default">
						        <div class="panel-heading" role="tab" id="headingOne">
						            <h4 class="panel-title">
								        <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#publish" aria-expanded="true" aria-controls="collapseOne">
								         	Action
								        </a>
								    </h4>
						        </div>
						        <div id="publish" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
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