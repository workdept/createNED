<?php

/**
 * Displays latest or category wised posts in a 3 block layout.
 */

class awaken_pro_three_block_posts extends WP_Widget {

	/* Register Widget with WordPress*/
	function __construct() {
		parent::__construct(
			'three_block_widget', // Base ID
			__( 'Awaken: Three Block Posts Widget', 'awaken-pro' ), // Name
			array( 'description' => __( 'Displays posts by three blocks per row.', 'awaken-pro' ), ) // Args
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
			'category'	=>	'',
			'number_posts'	=> 3,
			'sticky_posts' => true,
			'posts_per_row' => 3
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
			<label for="<?php echo $this->get_field_id( 'posts_per_row' ); ?>"><?php _e( 'Number of posts per row:', 'awaken-pro' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'posts_per_row' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_row' ); ?>">
				<option <?php if ( 2 == $instance['posts_per_row'] ) echo 'selected="selected"'; ?>>2</option>
				<option <?php if ( 3 == $instance['posts_per_row'] ) echo 'selected="selected"'; ?>>3</option>
			</select>
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
		$instance[ 'posts_per_row' ] = $new_instance[ 'posts_per_row' ];
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
		$number_posts = ( ! empty( $instance['number_posts'] ) ) ? absint( $instance['number_posts'] )  : 5;
		$sticky_posts = ( isset( $instance['sticky_posts'] ) ) ? $instance['sticky_posts'] : false;
		$category = $instance['category'];
		$posts_per_row = ( ! empty( $instance['posts_per_row'] ) ) ? $instance['posts_per_row'] : 3;
		global $paged;
		$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;

		$the_query = new WP_Query(
			array(
				'post_type' => 'post',
				'cat'	=>	$category,
				'posts_per_page' =>	$number_posts,
				'paged' => $paged,
				'ignore_sticky_posts' => $sticky_posts
				)
		);


		echo $before_widget;

		?>

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
			<div class="awaken-posts-container">
			<div class="row">

				<?php $i = 1; ?>
				<?php if ( $the_query->have_posts() ) :

					while ( $the_query -> have_posts() ) : $the_query -> the_post();

					if ( $posts_per_row == 3 ) {
						echo '<div class="col-xs-12 col-sm-4 col-md-4">';
					} else {
						echo '<div class="col-xs-12 col-sm-6 col-md-6">';
					} ?>
						<div class="awaken-block-post">
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
						</div><!-- .awaken-block-post -->

						</div><!-- .bootstrap-cols -->

						<?php if( /*$posts_per_row == 3 && */$i%3 == 0 ) {
							echo '</div><!--.row--><div class="row">';
						} ?>
						<?php if( $posts_per_row == 2 && $i%2 == 0 ) {
							//echo '</div><!--.row--><div class="row">';
						} ?>
						<?php $i++; ?>
						<?php
							if( !empty($category) ) {
								$arc_link = get_category_link( $category );
							} else {
								$pfp_id = get_option('page_for_posts');
								$arc_link = get_permalink($pfp_id);
							}
						?>
					<?php endwhile; ?>

                    <?php if( !is_rtl() ) : ?>

                        <?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
                            <div id="awt-nav" data-blockid="<?php echo $block_id ?>" data-blockuid="<?php echo $block_uid_js ?>">
                                <span class="ajax-nav-next"><?php echo get_previous_posts_link( '<i class="fa fa-chevron-left"></i>' ); ?></span>
                                <span class="ajax-view-all"><a class="ajax-vall" href="<?php echo esc_url($arc_link); ?>" data-toggle="tooltip" data-placement="top" title="<?php _e( 'View All Posts', 'awaken-pro'); ?>"><i class="fa fa-th-large"></i></a></span>
                                <span class="ajax-nav-previous"><?php echo get_next_posts_link( '<i class="fa  fa-chevron-right"></i>', $the_query->max_num_pages ); ?></span>
                            </div>
                        <?php } ?>

                    <?php else: ?>

                        <?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
                            <div id="awt-nav" data-blockid="<?php echo $block_id ?>" data-blockuid="<?php echo $block_uid_js ?>">
                                <span class="ajax-nav-previous"><?php echo get_next_posts_link( '<i class="fa  fa-chevron-right"></i>', $the_query->max_num_pages ); ?></span>
                                <span class="ajax-view-all"><a class="ajax-vall" href="<?php echo esc_url($arc_link); ?>" data-toggle="tooltip" data-placement="top" title="<?php _e( 'View All Posts', 'awaken-pro'); ?>"><i class="fa fa-th-large"></i></a></span>
                                <span class="ajax-nav-next"><?php echo get_previous_posts_link( '<i class="fa fa-chevron-left"></i>' ); ?></span>
                            </div>
                        <?php } ?>

                    <?php endif; ?>

				<?php wp_reset_postdata(); ?>
				<?php endif; ?>
				</div><!-- .row -->
			</div><!-- .awaken-posts-container -->
		</div><!-- .awaken-b3 -->
	</div><!-- .block-container -->
	<?php
		echo $after_widget;
	}
}

// register awaken three block posts widget
function register_awaken_pro_three_block_posts() {
    register_widget( 'awaken_pro_three_block_posts' );
}
add_action( 'widgets_init', 'register_awaken_pro_three_block_posts' );


