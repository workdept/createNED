<?php

/**
 * Displays latest, category wised posts in a 3 block layout.
 *
 */

class Awaken_Single_Category_Posts extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'single_category_posts', // Base ID
			__( 'Awaken: Single Category Posts', 'awaken-pro' ), // Name
			array( 'description' => __( 'Displays latest posts or posts from a choosen category.', 'awaken-pro' ), ) // Args
		);
	}


	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */

	public function form( $instance ) {
		//print_r($instance);
		$defaults = array(
			'title'		=>	__( 'Latest Posts', 'awaken-pro' ),
			'category'	=>	'all',
			'number_posts'	=> 5,
			'sticky_posts' => true,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$number_posts   = isset( $instance['number_posts'] ) ? absint( $instance['number_posts'] ) : 3;


	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'awaken-pro' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label><?php _e( 'Select a post category', 'awaken-pro' ); ?></label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category'), 'selected' => $instance['category'], 'show_option_all' => 'Show all posts' ) ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number_posts' ); ?>"><?php _e( 'Number of posts:', 'awaken-pro' ); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'number_posts' ); ?>" name="<?php echo $this->get_field_name( 'number_posts' );?>" value="<?php echo $number_posts; ?>" size="3"/> 
		</p>
		<p>
			<input type="checkbox" <?php checked( $instance['sticky_posts'], true ) ?> class="checkbox" id="<?php echo $this->get_field_id('sticky_posts'); ?>" name="<?php echo $this->get_field_name('sticky_posts'); ?>" />
			<label for="<?php echo $this->get_field_id('sticky_posts'); ?>"><?php _e( 'Hide sticky posts.', 'awaken-pro' ); ?></label>
		</p>

	<?php

	}



	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );	
		$instance[ 'category' ]	= $new_instance[ 'category' ];
		$instance[ 'number_posts' ] = (int)$new_instance[ 'number_posts' ];
		$instance[ 'sticky_posts' ] = (bool)$new_instance[ 'sticky_posts' ];
		return $instance;
	}


	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	
	public function widget( $args, $instance ) {
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';	
		$category = $instance['category'];
		$number_posts = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] )  : 5; 
		$sticky_posts = ( isset( $instance['sticky_posts'] ) ) ? $instance['sticky_posts'] : false;
		global $paged;
		$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;

		// Latest Posts
		$latest_posts = new WP_Query( 
			array(
				'cat' =>	$category,
				'posts_per_page' =>	$number_posts,
				'paged' => $paged,
				'ignore_sticky_posts' => $sticky_posts
				)
		);	

		echo $before_widget; ?>
		<div class="block-container">
		<div class="awt-container">
			<h1 class="awt-title"><?php if ( !empty($title) ) echo $title; ?></h1>
		</div>
		<?php 
			// Unique id
			$block_id = '#' . $args['widget_id'];
			$block_uid = 'block-' . $args['widget_id'];
			$block_uid_js = '#' . $block_uid;
		?>
		<div id="block-loader"><i class="fa fa-spinner loader-spin"></i></div>
		<div class="awaken-block" id="<?php echo $block_uid ?>">
			<div class="row">
				<?php $i = 1 ?>
				<?php while ( $latest_posts -> have_posts() ) : $latest_posts -> the_post(); ?>


					<?php if( $i == 1 ) { ?>

						<div class="col-xs-12 col-sm-6 col-md-6">
							<figure class="genpost-featured-image">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">	
									<?php if ( has_post_thumbnail() ) { ?>
										<?php the_post_thumbnail( 'featured', array('title' => get_the_title()) ); ?>
									<?php } else { ?>
										<img src="<?php echo get_template_directory_uri(); ?>/images/thumbnail-default.jpg" alt="<?php the_title(); ?>" />
									<?php } ?>
								
									<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="gen-ico"><i class="fa fa-play"></i></span>'; ?>
									<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="gen-ico"><i class="fa fa-volume-up"></i></span>'; ?>
									<?php if ( has_post_format('gallery') && !is_sticky() ) echo'<span class="gen-ico"><i class="fa fa-image"></i></span>'; ?>
									<?php if ( is_sticky() ) echo'<span class="gen-ico"><i class="fa fa-star"></i></span>'; ?>
								</a>
							</figure>

						<?php the_title( sprintf( '<h1 class="genpost-entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>							
						<?php if ( 'post' == get_post_type() ) : ?>
							<div class="genpost-entry-meta">
								<?php awaken_pro_posted_on(); ?>
							</div><!-- .entry-meta -->
						<?php endif; ?>
						<div class="genpost-entry-content mag-summary"><?php the_excerpt(); ?></div>
	
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
					<?php } else { ?>
						<div class="ams-post">
							<div class="ams-thumb">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">	
									<?php if ( has_post_thumbnail() ) { ?>
										<?php the_post_thumbnail( 'small-thumb', array('title' => get_the_title()) ); ?>
									<?php } else { ?>
										<img src="<?php echo get_template_directory_uri(); ?>/images/mini-thumbnail-default.jpg" alt="<?php the_title(); ?>" />
									<?php } ?>
								
									<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="gen-ico"><i class="fa fa-play"></i></span>'; ?>
									<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="gen-ico"><i class="fa fa-volume-up"></i></span>'; ?>
									<?php if ( has_post_format('gallery') && !is_sticky() ) echo'<span class="gen-ico"><i class="fa fa-image"></i></span>'; ?>
									<?php if ( is_sticky() ) echo'<span class="gen-ico"><i class="fa fa-star"></i></span>'; ?>
								</a>
							</div>
							<div class="ams-details">
								<?php the_title( sprintf( '<h1 class="ams-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
								<p class="ams-meta"><?php the_time('F j, Y'); ?></p>
							</div>
						</div>
					<?php } ?>
					<?php $i++ ?>
					<?php 
						if( !empty($category) ) { 
							$arc_link = get_category_link( $category ); 
						} else {
							$pfp_id = get_option('page_for_posts');
							$arc_link = get_permalink($pfp_id);
						}
					?>
				<?php endwhile; ?>
				</div><!-- .bootstrap cols -->

                <?php if( !is_rtl() ) : ?>

                    <?php if ($latest_posts->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
                        <div id="awt-nav" data-blockid="<?php echo $block_id ?>" data-blockuid="<?php echo $block_uid_js ?>">
                            <span class="ajax-nav-next"><?php echo get_previous_posts_link( '<i class="fa fa-chevron-left"></i>' ); ?></span>
                            <span class="ajax-view-all"><a class="ajax-vall" href="<?php echo esc_url($arc_link); ?>" data-toggle="tooltip" data-placement="top" title="<?php _e( 'View All Posts', 'awaken-pro'); ?>"><i class="fa fa-th-large"></i></a></span>
                            <span class="ajax-nav-previous"><?php echo get_next_posts_link( '<i class="fa  fa-chevron-right"></i>', $latest_posts->max_num_pages ); ?></span>
                        </div>
                    <?php } ?>

                <?php else: ?>

                    <?php if ($latest_posts->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
                        <div id="awt-nav" data-blockid="<?php echo $block_id ?>" data-blockuid="<?php echo $block_uid_js ?>">
                            <span class="ajax-nav-previous"><?php echo get_next_posts_link( '<i class="fa  fa-chevron-right"></i>', $latest_posts->max_num_pages ); ?></span>
                            <span class="ajax-view-all"><a class="ajax-vall" href="<?php echo esc_url($arc_link); ?>" data-toggle="tooltip" data-placement="top" title="<?php _e( 'View All Posts', 'awaken-pro'); ?>"><i class="fa fa-th-large"></i></a></span>
                            <span class="ajax-nav-next"><?php echo get_previous_posts_link( '<i class="fa fa-chevron-left"></i>' ); ?></span>
                        </div>
                    <?php } ?>

                <?php endif; ?>

                <?php wp_reset_postdata(); ?>
			</div><!-- .row -->
		</div>
	</div>
	<?php
		echo $after_widget;
	}


}

// Register single category posts widget
function register_awaken_pro_single_category_posts() {
    register_widget( 'Awaken_Single_Category_Posts' );
}
add_action( 'widgets_init', 'register_awaken_pro_single_category_posts' );