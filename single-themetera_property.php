<?php get_header(); ?>

        <!-- Start Main -->

        <main>
            <div class="main-part">
                <section class="popular-location detail-location">
                    <div class="container">
						<?php while ( have_posts() ) { the_post();?>
                        <?php get_template_part('content','property'); ?>
						<?php if ( comments_open() ) {
											comments_template();
						} ?>
						
						<?php
						$types = wp_get_post_terms($post->ID,'themetera_type' ); 
						$locations=wp_get_post_terms($post->ID,'themetera_location');
						$similar_property_query = new WP_Query( 
							array(
							'post_type'=>'themetera_property',
							'post_status'=>'publish',
							'posts_per_page'=>3,
							'post__not_in'=>array($post->ID),
							'tax_query' => array(
									'relation' => 'AND',
									array(
										'taxonomy' => 'themetera_location',
										'field'    => 'term_id',
										'terms'    => !empty($locations[0])?$locations[0]->term_id:false,
									),
									array(
										'taxonomy' => 'themetera_type',
										'field'    => 'term_id',
										'terms'    => !empty($types[0])?$types[0]->term_id:false,
									),
								)
							
							) 
						);
						
						if ( $similar_property_query->have_posts() ) {
						?>
                        <div class="rent-wrap">
                            <div class="similar-title">
                                <h5><?php _e('Similar listings','themetera');?></h5>
                            </div>
                            <div class="row">
                               <?php
							   while ( $similar_property_query->have_posts() ) {
								$similar_property_query->the_post();
								get_template_part('property','loop');
							   
							   } 
							   wp_reset_postdata();
							   ?>
                        </div>
                    </div>
					<?php } ?>
					<div class="btn-book desktop-book-hide">
						<a href="#"><i class="icon-book"></i>Book</a>
					</div>
					<?php } ?>	
					</div>
                </section>
            </div>
        </main>

        <!-- End Main -->

       <?php get_footer(); ?>