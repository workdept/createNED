<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Awaken
 */

get_header(); ?>
<div class="row">
<div class="col-xs-12 col-sm-6 col-md-8 awaken-content-float">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="archive-page-header">
				<h1 class="archive-page-title">
					<?php
						if ( is_category() ) :
							echo '<span class="archive-title-span">';
							_e( 'Category', 'awaken-pro' ); 
							echo '</span>';
							single_cat_title();

						elseif ( is_tag() ) :
							echo '<span class="archive-title-span">';
							_e( 'Tag', 'awaken-pro' ); 
							echo '</span>';
							single_tag_title();

						elseif ( is_author() ) :
							echo '<span class="archive-title-span">';
							_e( 'Author', 'awaken-pro' ); 
							echo '</span>';
							echo get_the_author();

						elseif ( is_day() ) :
							echo '<span class="archive-title-span">';
							_e( 'Date', 'awaken-pro' ); 
							echo '</span>';
							echo get_the_date();
							//printf( __( 'Day: %s', 'awaken-pro' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							echo '<span class="archive-title-span">';
							_e( 'Month', 'awaken-pro' ); 
							echo '</span>';
							echo get_the_date( _x( 'F Y', 'monthly archives date format', 'awaken-pro' ) );
							//printf( __( 'Month: %s', 'awaken-pro' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'awaken-pro' ) ) . '</span>' );

						elseif ( is_year() ) :
							echo '<span class="archive-title-span">';
							_e( 'Year', 'awaken-pro' ); 
							echo '</span>';
							echo get_the_date( _x( 'Y', 'yearly archives date format', 'awaken-pro' ) );
							//printf( __( 'Year: %s', 'awaken-pro' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'awaken-pro' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'awaken-pro' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'awaken-pro' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'awaken-pro' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'awaken-pro' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'awaken-pro' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'awaken-pro' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'awaken-pro' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'awaken-pro' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'awaken-pro' );

						else :
							_e( 'Archives', 'awaken-pro' );

						endif;
					?>
				</h1>
			</header><!-- .page-header -->
			<?php
				// Show an optional term description.
				$term_description = term_description();
				if ( ! empty( $term_description ) ) :
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				endif;
			?>
			<?php /* Start the Loop */
				$counter = 0;
			 ?>
			<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content' );
				?>
				<?php $counter++;
					if ($counter % 2 == 0) {
						echo '</div><div class="row">';
				 	} 
				?>
			<?php endwhile; ?>

			<div class="col-xs-12 col-sm-12 col-md-12">
				<?php awaken_pro_paging_nav(); ?>
			</div>
		</div><!-- .row -->

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

</div><!-- .bootstrap cols -->
<div class="col-xs-12 col-sm-6 col-md-4 awaken-widgets-float">
	<?php get_sidebar(); ?>
</div><!-- .bootstrap cols -->
</div><!-- .row -->
<?php get_footer(); ?>
