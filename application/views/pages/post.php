<?php 
	$post_cover = ($page->featured_image != NULL) ? base_url($page->featured_image) : base_url('build/images/banner/banner-4.jpeg');
?>

<div class="post-content">

	<section class="section-banner data-img" data-bg="<?php echo $post_cover; ?>">

		<div class="overlay">
		
			<div class="container">

				<h2 class="page-subtitle"><?php echo the_config('site_name'); ?></h2>
				<span class="title-line"></span>
				
				<h1 class="page-title"><?php echo $page->title; ?></h1>

				<h5 class="page-meta">Posted on <?php echo date_proper($page->created_at); ?></h5>

			</div>

		</div>

	</section>

	<section class="section-page">

		<div class="container">

			<div class="row">
			
				<div class="col-md-9 col-sm-8">

					<div class="section-content">

						<h2 class="section-title"><?php echo $page->title; ?></h2>

						<div class="page-meta">
							<ul>
								<li>
									<i class="fa fa-calendar"></i> <?php echo date_proper($page->created_at); ?>
								</li>
								<li>
									<i class="fa fa-user"></i> <?php echo ucwords($page->author); ?>
								</li>
							</ul>
						</div>

						<?php 
							if($page->featured_image != NULL) {
								$page_thumb = ($page->featured_image != NULL) ? base_url($page->featured_image) : base_url('build/images/placeholder.jpg');
						?>
						<div class="page-thumb">
							<img src ="<?php echo $page_thumb; ?>" class="img-responsive" alt="<?php echo $page->title; ?>" title="<?php echo $page->title; ?>" />
						</div>
						<?php } ?>

						<div class="content-wrap">
							
							<?php echo $page->content; ?>

							<hr/>

						</div>

					</div>
					
				</div>
				
				<div class="col-md-3 col-sm-4">

					<div class="aside">

						<?php include('partials/widget-aside-search.php'); ?>
						
						<?php include('partials/widget-aside-download.php'); ?>

						<?php include('partials/widget-aside-blog.php'); ?>
						
						<?php include('partials/widget-aside-menu.php'); ?>

					</div>

				</div>

			</div>

		</div>

	</section>

</div>