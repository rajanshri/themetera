<div id="post-<?php the_ID(); ?>" <?php post_class('detail-main'); ?>>
	<div class="row deto-row">
		<div class="col-md-8 col-sm-7 col-xs-12 deto-col-left">
			<div class="detail-left">
				<div class="detail-title detail-title-desktop">
					<div class="detail-title-left">
						<h3><?php the_title(); ?></h3>
						<h6><?php echo themetera_property_details_breadcrumb(); ?></h6>
					</div>
					
					<div class="detail-title-right">
						<i class="star"></i> <span>3.7 rating</span>
						<p><?php _e('by','themetera');?>: <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><strong><?php the_author(); ?></strong></a> <?php echo get_avatar(get_the_author_meta( 'ID' ), 22,'mystery'); ?></p>
					</div>
				</div>
				<div class="detail-tabs">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active nav-first" id="photo">
							<?php echo themetera_property_gallery(); ?>
						</div>
						
						<?php $coordinate= themetera_property_coordinate($post->ID); ?>
						<div role="tabpanel" class="tab-pane nav-second" id="view">
							<iframe  width="600"  height="450"  frameborder="0" style="border:0"  src="https://www.google.com/maps/embed/v1/streetview?key=AIzaSyBqe2XugPuj9Hvq-PIE6t95Mkm_BUP1UX8&location=<?php echo $coordinate['latitude']; ?>,<?php echo $coordinate['longitude']; ?>&heading=210&pitch=10&fov=35" allowfullscreen></iframe>
						</div>
						<div role="tabpanel" class="tab-pane nav-third" id="map">
							<iframe  width="600"  height="450"  frameborder="0" style="border:0"  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBqe2XugPuj9Hvq-PIE6t95Mkm_BUP1UX8&q=<?php echo $coordinate['latitude']; ?>,<?php echo $coordinate['longitude']; ?>" allowfullscreen></iframe>
						</div>
					</div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active nav-first"><a href="#photo" aria-controls="photo" role="tab" data-toggle="tab"><i class="icon-camera"></i>Photo</a></li>
						<li role="presentation" class="nav-second"><a href="#view" aria-controls="view" role="tab" data-toggle="tab"><i class="icon-street"></i> Street View</a></li>
						<li role="presentation" class="nav-third"><a href="#map" aria-controls="map" role="tab" data-toggle="tab"><i class="icon-mapview"></i> Map</a></li>
					</ul>
				</div>
				<div class="detail-tab-below">
					<div class="detail-title detail-title-mobile">
						<div class="detail-title-left">
							<h3><?php the_title(); ?></h3>
							<h6><?php echo themetera_property_details_breadcrumb(); ?></h6>
						</div>
						<div class="detail-title-right">
							<i class="star"></i> <span>3.7 rating</span>
							<p><?php _e('by','themetera');?>: <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><strong><?php the_author(); ?></strong></a> <?php echo get_avatar(get_the_author_meta( 'ID' ), 22,'mystery'); ?></p>
						</div>
					</div>
					<h5><?php _e('About this listing','themetera');?></h5>
					<p><?php  the_content(); ?></p>
					<div class="detail-info-outer">
						<div class="detail-info">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class="detail-info-blog">
										<h5><?php _e('Details','themetera');?></h5>
									</div>
								</div>
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="detail-info-blog">
										<p><?php _e('Accommodates','themetera');?>: <strong><?php echo get_post_meta($post->ID,'_max_occupants',true); ?></strong></p>
										<p><?php _e('Property type','themetera');?>: <strong><?php $types = wp_get_post_terms($post->ID,'themetera_type'); if(!empty($types[0]))echo $types[0]->name;  ?></strong></p>
										<p><?php _e('Bedrooms','themetera');?>: <strong><?php echo get_post_meta($post->ID,'_bedrooms',true); ?></strong></p>
										<p><?php _e('Bathrooms','themetera');?>: <strong><?php echo get_post_meta($post->ID,'_bathrooms',true); ?></strong></p>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="detail-info-blog">
										<p><?php _e('Beds','themetera');?>: <strong>6</strong></p> 
										<p><?php _e('Size','themetera');?>: <strong><?php echo get_post_meta($post->ID,'_total_area',true); ?> m2</strong></p>										
									</div>
								</div>
							</div>
						</div>
						<?php $amennities=wp_get_post_terms( $post->ID,'themetera_amenities'); ?>
						<?php if(!is_wp_error($amennities) && !empty($amennities)){ ?>
						<div class="detail-info">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-12">
									<div class="detail-info-blog">
										<h5><?php _e('Amenities','themetera');?></h5>
									</div>
								</div>
								<div class="col-md-9 col-sm-9 col-xs-12">
									<div class="detail-info-blog">
										<?php
										foreach($amennities as $amenity){
										?>										
										<div class="col-md-6 col-sm-6 col-xs-12"><?php echo $amenity->name; ?></div>
										<?php }?>
									</div>
								</div>
								
							</div>
						</div>
						<?php } ?>
					</div>
					
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-5 col-xs-12 deto-col-right">
			<div class="sidebar-right">
				<div class="detail-right-top">
					<div id="booking_result">
						
					</div>
					<div class="fix-date">
						<span><input type="text" name="booking_check_in" id="booking_check_in" placeholder="<?php _e('Start Date','themetera'); ?>"> <i class="arrow-forward"></i> <input type="text" name="booking_check_out" id="booking_check_out" placeholder="<?php _e('End Date','themetera'); ?>"></span>
					</div>
					<div class="guest-blog">
						<select id="guests">
							<option value=""><?php _e('Guests','themetera');?></option>
							<?php
								$max_occupants=get_post_meta($post->ID,'_max_occupants',true);
								if(!empty($max_occupants))
								{
									for($i=1;$i<=$max_occupants;$i++)
									{
										?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php
									}
								}
							?>
						</select>
						<input type="hidden" value="<?php the_ID()?>" id="property_id">
					</div>
					<div class="guest-info" id="calculated-info">
						
					</div>
					<div class="btn-book">
						<a href="javascript:void(0);" id="submit_booking"><i class="icon-book"></i><?php _e('Book','themetera');?></a>
					</div>
					<div class="wish-list">
						<i class="like unlike"></i> <span>Save to Wish List</span>
					</div>
					<div class="book-extra">
						<a href="#">Additional booking information.</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>