<div class="pages-section">

	<section class="section-header">
		
		<div class="container-fluid">
			
			<div class="page-title">
				<h1>Posts <a href="<?php echo base_url('admin/posts/new'); ?>" class="btn btn-default btn-sm">Add New</a></h1>
			</div>

			<div class="breadcrumb-wrap">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
					<li class="active">Posts</li>
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
							<a href="<?php echo base_url('admin/posts/new'); ?>" class="btn btn-default btn-sm">Add New</a>
							<a href="<?php echo base_url('admin/posts/trash'); ?>" class="btn btn-warning btn-sm">Go To Trash</a>
						</div>
					</div>
					<div class="col-md-4">
						<form action="<?php echo base_url('admin/posts/search'); ?>" method="get">
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
			if($posts != 0) {
		?>
			<div class="data-list table-responsive">
				<table class="table table-striped" cellspacing="0" width="100%">
				    <thead>
				        <tr>
				            <th>Title</th>
				            <th>Category</th>
				            <th>Status</th>
				            <th>Author</th>
				            <th>Action</th>
				        </tr>
				    </thead>
				    <tbody>
				    <?php foreach ($posts as $post) { ?>
				        <tr>
				            <td width="30%">
				            	<strong><?php echo $post->title; ?></strong>
				            	<p class="hidden-xs"><?php echo base_url($post->slug); ?></p>		
				            </td>
				            <td width=30%>
				            	<?php
				            		if(unserialize($post->category) != NULL) {
				            			$data = array();
					            		foreach(unserialize($post->category) as $category) {
					            			$data[] = '<span class="label label-default">'.$category.'</span> ';
					            		}
					            		$category = trim(join(' ', $data), ' ');
					            		echo $category;
					            	}
				            	?>
				            </td>
				            <td><?php echo ucwords(status($post->status)); ?></td>
				            <td><?php echo $post->author; ?></td>
				            <td width="10%">
				            	<a href="<?php echo base_url($post->slug); ?>" class="btn btn-primary btn-xs btn-block" target="_blank">View</a>
				            	<a href="<?php echo base_url('admin/posts/edit/'.$post->id); ?>" class="btn btn-warning btn-xs btn-block">Edit</a>
				            	<button type="button" class="btn btn-danger btn-xs btn-block btn-trash" data-trash="<?php echo $post->id; ?>" data-action="<?php echo base_url('admin/posts/trash'); ?>">Trash</button>
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
				<h2 class="txt-center">No Posts Available</h2>
			</div>

		<?php } ?>

		</div>

	</section>

</div>