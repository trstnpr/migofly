<div class="pages-section">

	<section class="section-header">
		
		<div class="container-fluid">
			
			<div class="page-title">
				<h1>Pages <a href="<?php echo base_url('admin/pages/new'); ?>" class="btn btn-default btn-sm">Add New</a></h1>
			</div>

			<div class="breadcrumb-wrap">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
					<li class="active">Pages</li>
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
							<a href="<?php echo base_url('admin/pages/new'); ?>" class="btn btn-default btn-sm">Add New</a>
							<a href="<?php echo base_url('admin/pages/trash'); ?>" class="btn btn-warning btn-sm">Go To Trash</a>
						</div>
					</div>
					<div class="col-md-4">
						<form action="<?php echo base_url('admin/pages/search'); ?>" method="get">
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
			if($pages != 0) {
		?>
			<div class="data-list table-responsive">
				<table class="table table-striped" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				            <th>Title</th>
				            <th>Status</th>
				            <th>Author</th>
				            <th>Action</th>
				        </tr>
				    </thead>
				    <tbody>
				    <?php foreach ($pages as $page) { ?>
				        <tr>
				            <td width="50%">
				            	<strong><?php echo $page->title; ?></strong>
				            	<p class="hidden-xs"><?php echo base_url($page->slug); ?></p>		
				            </td>
				            <td><?php echo ucwords(status($page->status)); ?></td>
				            <td><?php echo $page->author; ?></td>
				            <td width="10%">
				            	<?php if($page->status == 1) { ?>
				            	<a href="<?php echo base_url($page->slug); ?>" class="btn btn-primary btn-xs btn-block" target="_blank">View</a>
				            	<?php } ?>
				            	<a href="<?php echo base_url('admin/pages/edit/'.$page->id); ?>" class="btn btn-warning btn-xs btn-block">Edit</a>
				            	<button type="button" class="btn btn-danger btn-xs btn-block btn-trash" data-trash="<?php echo $page->id; ?>" data-action="<?php echo base_url('admin/pages/trash'); ?>">Trash</button>
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
				<h2 class="txt-center">No Pages Available</h2>
			</div>

		<?php } ?>

		</div>

	</section>

</div>