<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Awaken
 */
?>
<div class="col-xs-12 col-sm-6 col-md-6">
<article id="post-<?php the_ID(); ?>" <?php post_class( 'genaral-post-item' ); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<figure class="genpost-featured-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'featured' ); ?></a>
		</figure>
	<?php } else { ?>
		<figure class="genpost-featured-image">
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo get_template_directory_uri() . '/images/thumbnail-default.jpg'; ?>" />
			</a>
		</figure>
	<?php } ?>

	<header class="genpost-entry-header">
		<?php the_title( sprintf( '<h1 class="genpost-entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="genpost-entry-meta">
			<?php awaken_pro_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="genpost-entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
</article><!-- #post-## -->
</div>