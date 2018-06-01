<?php
	if(recent_blog()) {
?>
	<div class="widget widget-blog">

		<h4 class="widget-header">Recent Blogs</h4>

		<hr/>

		<div class="widget-content">
			<div class="blog-wrap">
				<?php
				foreach(recent_blog() as $widget_blog) {
					$blog_thumb = ($widget_blog->featured_image != NULL) ? base_url($widget_blog->featured_image) : base_url('build/images/placeholder.jpg');
				?>
				<div class="media blog-item">
					<div class="media-left blog-thumb">
						<a href="<?php echo base_url($widget_blog->slug); ?>">
							<img class="media-object" src="<?php echo $blog_thumb; ?>" alt="<?php echo $widget_blog->title; ?>" title="<?php echo $widget_blog->title; ?>" />
						</a>
					</div>
					<div class="media-body blog-body">
						<h4 class="media-heading blog-title"><?php echo $widget_blog->title; ?></h4>
						<small class="blog-meta"><?php echo date_proper($widget_blog->created_at); ?></small>
						<p class="blog-excerpt"><?php echo $widget_blog->excerpt; ?></p>
					</div>
				</div>
				<?php } ?>
			</div>

			<!-- <ul class="blog-list">
			<?php //foreach(recent_blog() as $widget_blog) { ?>
				<li><a href="<?php //echo base_url($widget_blog->slug); ?>"><?php //echo $widget_blog->title; ?></a></li>
			<?php //} ?>
			</ul> -->
			
		</div>

	</div>
<?php
	}
?>