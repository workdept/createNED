<?php
/**
 * The template for displaying all single posts.
 *
 * @package Awaken
 */

get_header(); ?>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-8 awaken-content-float">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php 

			while ( have_posts() ) : the_post(); 

				$format = ( false === get_post_format() ) ? 'single' : get_post_format();

				get_template_part( 'content', $format ); 

				if ( get_theme_mod( 'display_author_box', 1 ) ) { get_template_part( 'authorbox' ); }

				awaken_pro_post_nav();

				if ( get_theme_mod( 'display_related_posts', 1 ) ) { get_template_part('inc/related-posts'); }


                if ( get_theme_mod( 'display_post_comments', 1 ) ) {
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() ) :
                        comments_template();
                    endif;

                }

			endwhile; // end of the loop. 

		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .bootstrap cols -->
<div class="col-xs-12 col-sm-6 col-md-4 awaken-widgets-float">
	<?php get_sidebar(); ?>
</div><!-- .bootstrap cols -->
</div><!-- .row -->
<?php get_footer(); ?>