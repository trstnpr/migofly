<div class="cities-section">

	<section class="section-header">
		
		<div class="container-fluid">
			
			<div class="page-title">
				<h1>Aircrafts <a href="<?php echo base_url('admin/aircraft/new'); ?>" class="btn btn-default btn-sm">Add New</a></h1>
			</div>

			<div class="breadcrumb-wrap">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
					<li class="active">Aircrafts</li>
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
							<a href="<?php echo base_url('admin/aircrafts/new'); ?>" class="btn btn-default btn-sm">Add New</a>
							<button type="button" class="btn btn-danger btn-sm delaircraft-all" data-action="<?php echo base_url('admin/aircrafts/delete/all'); ?>" data-type="aircraft">Delete All</button>
						</div>
					</div>
					<div class="col-md-4">
						<form action="<?php echo base_url('admin/aircrafts/search'); ?>" method="get">
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
			if($aircrafts) {
		?>
			<div class="data-list table-responsive">
				<table class="table table-striped" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				            <th>Code</th>
				            <th>Aircraft</th>
				            <th>Action</th>
				        </tr>
				    </thead>
				    <tbody>
				    <?php foreach ($aircrafts as $aircraft) { ?>
				        <tr>
				            <td><?php echo $aircraft->code; ?></td>
				            <td><?php echo $aircraft->name; ?></td>
				            <td width="10%">
				            	<a href="<?php echo base_url('admin/aircrafts/edit/'.strtolower($aircraft->id)); ?>" class="btn btn-warning btn-xs btn-block">Edit</a>
				            	<button type="button" class="btn btn-danger btn-xs btn-block aircraft-delete" data-delete="<?php echo $aircraft->id; ?>" data-action="<?php echo base_url('admin/aircrafts/delete'); ?>">Delete</button>
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
				<h2 class="txt-center">No Aircrafts Available</h2>
			</div>
		<?php } ?>
		</div>

	</section>

</div>