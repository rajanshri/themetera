<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-single-title">
		<h2><?php the_title(); ?></h2>
		<p><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?> – </a><?php echo get_the_date(); ?> - <?php comments_number( 'No Comment', 'One Comment', '% Comments' ); ?>.</p>
	</div>
	<div class="single-container">
		<div class="row">
			<div class="col-md-10 col-sm-9 col-xs-12 blog-single-left">
				<?php the_content();?>
			</div>
			<div class="col-md-3 col-sm-4 col-xs-12 blog-single-right desktop-show">
				<div class="sidebar-single">
					<div class="publish-side publish-common">
						<h6><?php _e('PUBLISHED IN','themetera');?></h6>
						<?php echo themetera_get_post_categories_string($post); ?>
					</div>
					<div class="publish-tag publish-common">
						<h6><?php _e('TAGS','themetera');?></h6>
						<?php echo themetera_get_post_categories_string($post,'post_tag'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>