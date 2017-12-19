<?php get_header(); ?>
        <!-- Start Main -->

        <main>
            <div class="main-part">
                <section class="blog-part">
                    <div class="container">
						<?php if ( have_posts() ) { ?>
                        <div class="filter-pack">
                            <div class="filter-tab">
                                <div class="search-filter">
									<form action="<?php echo home_url('/'); ?>">
										<input type="text" name="s"  placeholder="Search articles">
									</form>
                                </div>
                                <!--<a href="javascript:;" data-filter="*" class="current">Latest articles</a>
                                <a href="javascript:;" data-filter=".companynews">Company news</a>
                                <a href="javascript:;" data-filter=".othercategory">Another category</a>
                                <a href="javascript:;" data-filter=".categorytwo">Category two</a>
                                <a href="javascript:;" data-filter=".categorydefault">Category</a>-->
                            </div>
                            <div class="filter-blog row">
                                <?php
								
								while ( have_posts() ) : the_post();
									get_template_part( 'content','loop');
									$i++;
								endwhile;
								
								?>
                                
                            </div>
                        </div>
                        <div class="post-describe">
                            <?php posts_nav_link(null,__('Newer Posts','themetera').'<i class="arrow-left"></i>',__('Older Posts','themetera').'<i class="arrow-right"></i>'); ?>
                        </div>
						<?php }else{ 
						
							get_template_part( 'content', 'none' );
						 } ?>
                    </div>
                </section>
            </div>
        </main>

        <!-- End Main -->

<?php get_footer(); ?>