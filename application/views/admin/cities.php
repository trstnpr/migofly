<div class="cities-section">

	<section class="section-header">
		
		<div class="container-fluid">
			
			<div class="page-title">
				<h1>Cities <a href="<?php echo base_url('admin/cities/new'); ?>" class="btn btn-default btn-sm">Add New</a></h1>
			</div>

			<div class="breadcrumb-wrap">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
					<li class="active">Cities</li>
				</ol>
			</div>

		</div>

	</section>

	<section class="section-content">
		
		<div class="container-fluid">

			<div class="tools">
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<a href="<?php echo base_url('admin/cities/new'); ?>" class="btn btn-default btn-sm">Add New</a>
							<button type="button" class="btn btn-danger btn-sm delcity-all" data-action="<?php echo base_url('admin/cities/delete/all'); ?>" data-type="city">Delete All</button>
						</div>
					</div>
					<div class="col-md-4">
						<form action="<?php echo base_url('admin/cities/search'); ?>" method="get">
							<div class="form-group">
								<div class="input-group">
									<input type="text" class="form-control input-sm" name="keyword" placeholder="Keyword" />
									<span class="input-group-btn">
										<button type="submit" class="btn btn-success btn-sm">GO</button>
									</span>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

		<?php
			if($cities) {
		?>
			<div class="data-list table-responsive">
				<table class="table table-striped" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				        	<th>#</th>
				            <th>Code</th>
				            <th>City</th>
				            <th>Country</th>
				            <th>Coordinates (x,y)</th>
				            <th>Action</th>
				        </tr>
				    </thead>
				    <tbody>
				    <?php foreach ($cities as $city) { ?>
				        <tr>
				        	<td><?php echo $city->id; ?></td>
				            <td><?php echo $city->code; ?></td>
				            <td><?php echo $city->name; ?></td>
				            <td><?php echo $city->country_name; ?></td>
				            <td><?php echo $city->latitude.', '.$city->longitude; ?></td>
				            <td width="10%">
				            	<a href="<?php echo base_url('city/'.strtolower($city->code)); ?>" class="btn btn-primary btn-xs btn-block" target="_blank">View</a>
				            	<a href="<?php echo base_url('admin/cities/edit/'.strtolower($city->id)); ?>" class="btn btn-warning btn-xs btn-block">Edit</a>
				            	<button type="button" class="btn btn-danger btn-xs btn-block city-delete" data-delete="<?php echo $city->id; ?>" data-action="<?php echo base_url('admin/cities/delete'); ?>">Delete</button>
				            </td>
				        </tr>
				    <?php } ?>
				    </tbody>
				</table>
			</div>
		<?php
			if (strlen($pagination)) {
                echo $pagination;
            }
		} else { ?>
			<div class="well">
				<h2 class="txt-center">No Cities Available</h2>
			</div>
		<?php } ?>
		</div>

	</section>

</div>