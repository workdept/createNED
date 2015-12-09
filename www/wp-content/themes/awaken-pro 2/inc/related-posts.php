<?php

/*
* Related Posts for a single post.
*/
global $post;	
$exclude = $post->ID;
$cats = get_the_category( $post->ID );
$cat_ids = array(); // empty array to put the IDs into

foreach( $cats as $cat ):
	$cat_ids[] = $cat->term_id;
endforeach;

$args = array(
	'posts_per_page' => 5,
	'category__in' => $cat_ids,				
	'orderby' => 'random',
	'exclude' => $exclude,
	'post_type' => 'post',
	'ignore_sticky_posts'=>	'true'
);

$related_posts = new WP_Query($args); ?>

<?php if ( $related_posts->have_posts() && $related_posts->found_posts >= 2 ) : ?>
<div class="related-posts clearfix">
	<h2><?php _e( 'You may like these posts', 'awaken-pro' ); ?></h2>	
	<div class="awaken-related-posts">
		<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
			<article class="rpost clearfix">
				<div class="amsr-thumb">
					<?php if( has_post_thumbnail() ) { ?>
						<a href="<?php echo get_permalink( $related->ID ); ?>"><?php the_post_thumbnail( 'small-thumb' ); ?></a>
					<?php } else { ?>
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo get_template_directory_uri() . '/images/mini-thumbnail-default.jpg'; ?>"/>
						</a>
					<?php } ?>
				</div>
				<div id="related-posts-title">
					<h3><a href="<?php echo get_permalink( $related->ID ); ?>"><?php the_title(); ?></a></h3>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</div><!-- end related posts -->
<?php wp_reset_postdata(); ?>
<?php endif; ?>