<?php
/**
 * @package Awaken
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="single-entry-header">
		<?php the_title( '<h1 class="single-entry-title">', '</h1>' ); ?>

		<div class="single-entry-meta">
			<?php awaken_pro_posted_on(); ?>
			<?php edit_post_link( __( 'Edit', 'awaken-pro' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="awaken-gallery">
		<?php awaken_pro_flexslider('featured-slider'); ?>
	</div>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'awaken-pro' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="single-entry-footer">
		<?php

			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ' ', 'awaken-pro' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ' ', 'awaken-pro' ) );

			if ( awaken_pro_categorized_blog() ) {
				echo '<span class="categorized-under">';
					_e( 'Posted Under', 'awaken-pro' );
				echo '</span>';
				echo '<div class="awaken-category-list">' . $category_list . '</div>';
				echo '<div class="clearfix"></div>';
			}

			if ( '' != $tag_list ) {
				echo '<span class="tagged-under">';
					_e( 'Tagged', 'awaken-pro' );
				echo '</span>';
				echo '<div class="awaken-tag-list">' . $tag_list . '</div>';
				echo '<div class="clearfix"></div>';	
			}
		?>

	</footer><!-- .entry-footer -->
</article><!-- #post-## -->