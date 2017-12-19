<?php get_header(); ?>

        <!-- Start Main -->

        <main>
            <div class="main-part">
                <section class="blog-single">
                    <div class="container">
					<?php while ( have_posts() ) { the_post(); ?>
                        <?php get_template_part('content'); ?>
                        <div class="single-container">
                            <div class="row">
                                <div class="col-md-10 col-sm-9 col-xs-12 blog-single-left">
                                    <div class="share-article-wrapper">
                                        <div class="share-social-help">
                                            <h6><?php _e('ENJOYED THIS ARTICLE? SHARE IT.','themetera');?></h6>
                                            <ul>
                                                <li><a href="<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.urlencode(get_the_permalink()); ?>"><img src="<?php echo THEMETERA_URL; ?>/images/dark-facebook.png" alt=""></a></li>
                                                <li><a href="<?php echo 'https://plus.google.com/share?url='.urlencode(get_the_permalink()); ?>"><img src="<?php echo THEMETERA_URL; ?>/images/dark-gmail.png" alt=""></a></li>
                                                <li><a href="<?php echo 'https://twitter.com/home?status='.urlencode(get_the_permalink()); ?>"><img src="<?php echo THEMETERA_URL; ?>/images/dark-twitter.png" alt=""></a></li>
                                            </ul>
                                        </div>
                                        <?php if ( comments_open() ) {
											comments_template();
										} ?>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-12">
                                    
                                </div>
                            </div>
                        </div>
                        
						<?php } ?>
                    </div>
                </section>
            </div>
        </main>

        <!-- End Main -->

       <?php get_footer(); ?>