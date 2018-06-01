<div class="cities-section">

	<section class="section-header">
		
		<div class="container-fluid">
			
			<div class="page-title">
				<h1>Airlines <a href="<?php echo base_url('admin/airlines/new'); ?>" class="btn btn-default btn-sm">Add New</a></h1>
			</div>

			<div class="breadcrumb-wrap">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
					<li class="active">Airlines</li>
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
							<a href="<?php echo base_url('admin/airlines/new'); ?>" class="btn btn-default btn-sm">Add New</a>
							<button type="button" class="btn btn-danger btn-sm delairline-all" data-action="<?php echo base_url('admin/airlines/delete/all'); ?>" data-type="airline">Delete All</button>
						</div>
					</div>
					<div class="col-md-4">
						<form action="<?php echo base_url('admin/airlines/search'); ?>" method="get">
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
			if($airlines) {
		?>
			<div class="data-list table-responsive">
				<table class="table table-striped" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				            <th>Airline</th>
				            <th>IATA</th>
				            <th>ICAO</th>
				            <th>Call Sign</th>
				            <th>Country</th>
				            <th>Status</th>
				            <th>Action</th>
				        </tr>
				    </thead>
				    <tbody>
				    <?php foreach ($airlines as $airline) { ?>
				        <tr>
				            <td><?php echo $airline->name; ?></td>
				            <td><?php echo $airline->iata; ?></td>
				            <td><?php echo $airline->icao; ?></td>
				            <td><?php echo $airline->callsign; ?></td>
				            <td><?php echo $airline->country; ?></td>
				            <td><?php echo $airline->is_active; ?></td>
				            <td width="10%">
				            	<a href="<?php echo base_url('admin/airlines/edit/'.strtolower($airline->id)); ?>" class="btn btn-warning btn-xs btn-block">Edit</a>
				            	<button type="button" class="btn btn-danger btn-xs btn-block airline-delete" data-delete="<?php echo $airline->id; ?>" data-action="<?php echo base_url('admin/airlines/delete'); ?>">Delete</button>
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
				<h2 class="txt-center">No Airlines Available</h2>
			</div>
		<?php } ?>
		</div>

	</section>

</div>