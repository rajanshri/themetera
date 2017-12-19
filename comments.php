<div class="review-list">
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-12">
			<h5><?php _e('Comment','themetera');?></h5>
		</div>
		<div class="col-md-9 col-sm-9 col-xs-12">
			<div class="review-area">
				<?php 		
				$args=array(
				'comment_field'=>'<textarea id="comment" name="comment" aria-required="true" placeholder="'.__('Message','themetera').'...."></textarea>',
				//'fields'=>array(),
				'label_submit'      => __( 'Comment','themetera' ),
				'logged_in_as' => '',
				'comment_notes_before' => '',
				'comment_notes_after' =>''
				);
				comment_form($args); 
				?>
				<?php if ( have_comments() ) { ?>
				<div class="review-comment-main">
					<?php wp_list_comments(array( 'style' => 'div','walker' => new Themetera_Walker_Comment() )); ?>
					
				</div>
					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {?>
						<nav class="navigation comment-navigation" role="navigation">
							<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'themetera' ); ?></h2>
							<div class="nav-links">
								<?php
									if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'themetera' ) ) ) :
										printf( '<div class="nav-previous">%s</div>', $prev_link );
									endif;

									if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'themetera' ) ) ) :
										printf( '<div class="nav-next">%s</div>', $next_link );
									endif;
								?>
							</div><!-- .nav-links -->
						</nav><!-- .comment-navigation -->
					<?php
					}
			  } ?>
			</div>
		</div>
	</div>
</div>