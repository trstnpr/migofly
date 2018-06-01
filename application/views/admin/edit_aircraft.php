<div class="pages-section">

	<section class="section-header">
		
		<div class="container-fluid">
			
			<div class="page-title">
				<h1>Edit Aircraft</h1>
			</div>

			<div class="breadcrumb-wrap">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
					<li><a href="<?php echo base_url('admin/aircrafts'); ?>">Aircrafts</a></li>
					<li class="active">Edit</li>
				</ol>
			</div>

		</div>

	</section>

	<section class="section-content">
		
		<div class="container-fluid">
			<form class="updateaircraft-form" method="post" action="<?php echo base_url('admin/aircrafts/edit/'.$aircraft->id); ?>">
				<div class="row">
					<div class="col-md-9">
						<div class="well">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control" name="name" placeholder="Enter name ..." value="<?php echo $aircraft->name; ?>" required />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Code</label>
										<input type="text" class="form-control" name="code" maxlength="3" placeholder="Enter code ..." value="<?php echo $aircraft->code; ?>" required />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Slug</label>
										<input type="text" class="form-control slug" name="slug" value="<?php echo $aircraft->slug; ?>" placeholder="Aircraft slug ..." />
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