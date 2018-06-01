<div class="cities-section">

	<section class="section-header">
		
		<div class="container-fluid">
			
			<div class="page-title">
				<h1>Countries <a href="<?php echo base_url('admin/countries/new'); ?>" class="btn btn-default btn-sm">Add New</a></h1>
			</div>

			<div class="breadcrumb-wrap">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
					<li class="active">Countries</li>
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
							<a href="<?php echo base_url('admin/countries/new'); ?>" class="btn btn-default btn-sm">Add New</a>
							<button type="button" class="btn btn-danger btn-sm delcountry-all" data-action="<?php echo base_url('admin/countries/delete/all'); ?>" data-type="country">Delete All</button>
						</div>
					</div>
					<div class="col-md-4">
						<form action="<?php echo base_url('admin/countries/search'); ?>" method="get">
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
			if($countries) {
		?>
			<div class="data-list table-responsive">
				<table class="table table-striped" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				            <th>Code</th>
				            <th>Country</th>
				            <th>Map Reference</th>
				            <th>Area</th>
				            <th>Action</th>
				        </tr>
				    </thead>
				    <tbody>
				    <?php foreach ($countries as $country) { ?>
				        <tr>
				            <td><?php echo $country->code; ?></td>
				            <td>
				            	<?php echo $country->name; ?>
				            	<p class="hidden-xs"><?php echo base_url('country/'.strtolower($country->code)); ?></p>	
				            </td>
				            <td><?php echo $country->map_reference; ?></td>
				            <td><?php echo $country->area; ?></td>
				            <td width="10%">
				            	<a href="<?php echo base_url('country/'.strtolower($country->code)); ?>" class="btn btn-primary btn-xs btn-block" target="_blank">View</a>
				            	<a href="<?php echo base_url('admin/countries/edit/'.strtolower($country->id)); ?>" class="btn btn-warning btn-xs btn-block">Edit</a>
				            	<button type="button" class="btn btn-danger btn-xs btn-block country-delete" data-delete="<?php echo $country->id; ?>" data-action="<?php echo base_url('admin/countries/delete'); ?>">Delete</button>
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
				<h2 class="txt-center">No Countries Available</h2>
			</div>
		<?php } ?>
		</div>

	</section>

</div>