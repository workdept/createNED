<?php
/**
 * @package Awaken
 */
?>
<div class="col-xs-12 col-sm-6 col-md-6">
<article id="post-<?php the_ID(); ?>" <?php post_class( 'genaral-post-item' ); ?>>
	<figure class="genpost-featured-image">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php if ( has_post_thumbnail() ) { ?>
				<?php the_post_thumbnail( 'featured' ); ?>
			<?php } else { ?>
				<img src="<?php echo get_template_directory_uri() . '/images/thumbnail-default.jpg'; ?>" />
			<?php } ?>
				<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="gen-ico"><i class="fa fa-play"></i></span>'; ?>
				<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="gen-ico"><i class="fa fa-volume-up"></i></span>'; ?>
				<?php if ( has_post_format('gallery') && !is_sticky() ) echo'<span class="gen-ico"><i class="fa fa-image"></i></span>'; ?>
				<?php if ( is_sticky() ) echo'<span class="gen-ico"><i class="fa fa-star"></i></span>'; ?>
		</a>
	</figure>

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
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'awaken-pro' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
</div>