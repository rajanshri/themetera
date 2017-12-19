<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 col-sm-6 col-xs-12'); ?>>
	<div class="rent-list">
		<?php if(has_post_thumbnail()){ ?>
		<div class="rent-list-img">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail();?>
			</a>
		</div>
		<?php } ?>
		<div class="rent-list-info">
			<a href="<?php the_permalink(); ?>">
				<h5><?php themetera_property_formatted_price($post->ID); ?> <i class="like unlike"></i></h5>
				<span><?php echo get_post_meta($post->ID,'_address',true); ?></span>
			</a>
			<strong><?php printf(__('%d bedrooms','themetera'),get_post_meta($post->ID,'_bedrooms',true)) ?> - <?php printf(__('%d bathrooms','themetera'),get_post_meta($post->ID,'_bathrooms',true)) ?></strong>
		</div>
		<!--<div class="rent-rating">
			<spn><i class="star"></i>Featured</spn>
		</div>-->
	</div>
</div>