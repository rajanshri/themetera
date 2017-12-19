<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 col-sm-6 col-xs-12 msrItem companynews'); ?> >
	<div class="blog-filter-wrp">
		<?php if(has_post_thumbnail()){ ?>
		<div class="blog-filter-img">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
		</div>
		<?php } ?>
		<div class="blog-filter-info">
			<div class="blog-date"><?php echo themetera_get_post_categories_string($post->ID); ?> / <span><?php echo get_the_date(); ?></span></div>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
			<p><?php the_excerpt(); ?></p>
		</div>
	</div>
</div>