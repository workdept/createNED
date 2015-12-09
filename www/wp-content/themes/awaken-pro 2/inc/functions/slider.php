<?php

/**
* Custom slider and the featured posts for the theme.
*/

if ( !function_exists( 'awaken_pro_featured_posts' ) ) :

function awaken_pro_featured_posts() { 

	global $awaken_pro_options; ?>
	<div class="awaken-featured-container">

	<?php
	if( get_theme_mod('display_custom_slider_switch') == 1 ) { ?>
		 
		 <div class="awaken-featured-slider">
			<section class="slider">
				<div class="flexslider loading">
					<ul class="slides">
						<?php for ( $i=1; $i<=10; $i++ ) { 

								$slider_image = get_theme_mod( 'custom_slide_img_' . $i . '' );
									
									if( ! empty( $slider_image ) ) : 

										$slider_title = get_theme_mod( 'custom_slide_title_' . $i . '' );
										$slider_url = get_theme_mod( 'custom_slide_url_' . $i . '' );

										?>

										<li>
											<div class="awaken-slider-container">
												<img src="<?php echo esc_url($slider_image); ?>">
												<div class="awaken-slider-details-container">
													<?php if( !empty($slider_title) ) : ?>
														<a href="<?php echo !empty($slider_url) ? esc_url( $slider_url ) : '#'; ?>" rel="bookmark"><h1 class="awaken-slider-title"><?php echo esc_html($slider_title); ?></h1></a>
													<?php endif; ?>
												</div>
											</div>
										</li>
							
							<?php endif; 
							} 
						?>
					</ul>
				</div>
			</section>			
		</div>
	
	<?php } else {

		$category = get_theme_mod( 'slider_category', '' );
		$numberposts = get_theme_mod( 'slides_count', '' );

		$slider_posts = new WP_Query( array(
			'posts_per_page' 		=> $numberposts,
			'cat'					=> $category,
			)
		); ?>

		<div class="awaken-featured-slider">
			<section class="slider">
				<div class="flexslider loading">
					<ul class="slides">
					<?php while( $slider_posts->have_posts() ) : $slider_posts->the_post(); ?>

						<li>
							<div class="awaken-slider-container">
								<?php if ( has_post_thumbnail() ) { ?>
									<?php the_post_thumbnail( 'featured-slider' ); ?>
								<?php } else { ?>
									<img src="<?php echo get_template_directory_uri() . '/images/slide.jpg' ?>">
								<?php } ?>

								<div class="awaken-slider-details-container">
									<a href="<?php the_permalink(); ?>" rel="bookmark"><h1 class="awaken-slider-title"><?php the_title(); ?></h1></a>
								</div>
							</div>
						</li>

					<?php endwhile; ?>
					</ul>
				</div>
			</section>
		</div><!-- .awaken-slider -->
	<?php wp_reset_postdata(); ?>
	<?php } ?>

		<div class="awaken-featured-posts">
			<?php 

				$fposts_category = get_theme_mod( 'featured_posts_category', '' );

				$fposts = new WP_Query( array(
					'posts_per_page' => 2,
					'cat'	=>	$fposts_category,
					'ignore_sticky_posts' => 1
				));

				while( $fposts->have_posts() ) : $fposts->the_post(); ?>

					<div class="afp">
						<figure class="afp-thumbnail">
							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'featured', array('title' => get_the_title()) ); ?></a>
							<?php } else { ?>
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/featured.jpg" alt="<?php the_title(); ?>" /></a>
							<?php } ?>						
						</figure>						
						<div class="afp-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</div>
					</div>

				<?php endwhile; ?>

		</div><!-- .awaken-featured-posts -->
	</div><!-- .awaken-featured-container -->
	
	<?php wp_reset_postdata(); 

}

endif;