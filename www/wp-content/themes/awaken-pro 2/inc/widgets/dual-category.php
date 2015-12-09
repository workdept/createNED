<?php

/**
 * Displays posts from two categories in a two block layout.
 */

class Awaken_Dual_Category_Posts extends WP_Widget {

    /* Register Widget with WordPress */
    function __construct() {
        parent::__construct(
            'dual_category_posts', // Base ID
            __( 'Awaken: Two Block Posts Widget', 'awaken-pro' ), // Name
            array( 'description' => __( 'Displays posts in a full width layout', 'awaken-pro' ), ) // Args
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
            'title1'		=>	__( 'Latest Posts', 'awaken-pro' ),
            'category1'		=>	'',
            'number_posts1'	=> 3,
            'sticky_posts1' => true,
            'offset1' 		=> 0,
            'title2'		=>	__( 'Latest Posts', 'awaken-pro' ),
            'category2'		=>	'',
            'number_posts2'	=> 3,
            'sticky_posts2' => true,
            'offset2' 		=> 0
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $number_posts1   = isset( $instance['number_posts1'] ) ? absint( $instance['number_posts1'] ) : 3;
        $offset1	=	isset( $instance['offset1'] ) ? absint( $instance['offset1'] ) : 0;
        $number_posts2   = isset( $instance['number_posts2'] ) ? absint( $instance['number_posts2'] ) : 3;
        $offset2	=	isset( $instance['offset2'] ) ? absint( $instance['offset2'] ) : 0;

        ?>
        <!-- Form for category 1 -->
        <h3> First Set of Posts </h3>
        <p>
            <label for="<?php echo $this->get_field_id( 'title1' ); ?>"><?php _e( 'Title:', 'awaken-pro' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title1' ); ?>" name="<?php echo $this->get_field_name( 'title1' ); ?>" value="<?php echo esc_attr($instance['title1']); ?>"/>
        </p>
        <p>
            <label><?php _e( 'Select a post category', 'awaken-pro' ); ?></label>
            <?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category1'), 'selected' => $instance['category1'], 'show_option_all' => 'Show all posts' ) ); ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number_posts1' ); ?>"><?php _e( 'Number of posts:', 'awaken-pro' ); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'number_posts1' ); ?>" name="<?php echo $this->get_field_name( 'number_posts1' );?>" value="<?php echo $number_posts1; ?>" size="3"/>
        </p>
        <p>
            <input type="checkbox" <?php checked( $instance['sticky_posts1'], true ) ?> class="checkbox" id="<?php echo $this->get_field_id('sticky_posts1'); ?>" name="<?php echo $this->get_field_name('sticky_posts1'); ?>" />
            <label for="<?php echo $this->get_field_id('sticky_posts1'); ?>"><?php _e( 'Hide sticky posts.', 'awaken-pro' ); ?></label>
        </p>

        <hr />
        <!-- Form for category 2 -->
        <h3> Second Set of Posts </h3>
        <p>
            <label for="<?php echo $this->get_field_id( 'title2' ); ?>"><?php _e( 'Title:', 'awaken-pro' ); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title2' ); ?>" name="<?php echo $this->get_field_name( 'title2' ); ?>" value="<?php echo esc_attr($instance['title2']); ?>"/>
        </p>
        <p>
            <label><?php _e( 'Select a post category', 'awaken-pro' ); ?></label>
            <?php wp_dropdown_categories( array( 'name' => $this->get_field_name('category2'), 'selected' => $instance['category2'], 'show_option_all' => 'Show all posts' ) ); ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number_posts2' ); ?>"><?php _e( 'Number of posts:', 'awaken-pro' ); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'number_posts2' ); ?>" name="<?php echo $this->get_field_name( 'number_posts2' );?>" value="<?php echo $number_posts2; ?>" size="3"/>
        </p>
        <p>
            <input type="checkbox" <?php checked( $instance['sticky_posts2'], true ) ?> class="checkbox" id="<?php echo $this->get_field_id('sticky_posts2'); ?>" name="<?php echo $this->get_field_name('sticky_posts2'); ?>" />
            <label for="<?php echo $this->get_field_id('sticky_posts2'); ?>"><?php _e( 'Hide sticky posts.', 'awaken-pro' ); ?></label>
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
        $instance[ 'title1' ] = strip_tags( $new_instance[ 'title1' ] );
        $instance[ 'category1' ]	= $new_instance[ 'category1' ];
        $instance[ 'number_posts1' ] = (int)$new_instance[ 'number_posts1' ];
        $instance[ 'sticky_posts1' ] = (bool)$new_instance[ 'sticky_posts1' ];
        //$instance[ 'offset1' ] = (int)$new_instance[ 'offset1' ];
        $instance[ 'title2' ] = strip_tags( $new_instance[ 'title2' ] );
        $instance[ 'category2' ]	= $new_instance[ 'category2' ];
        $instance[ 'number_posts2' ] = (int)$new_instance[ 'number_posts2' ];
        $instance[ 'sticky_posts2' ] = (bool)$new_instance[ 'sticky_posts2' ];
        //$instance[ 'offset2' ] = (int)$new_instance[ 'offset2' ];
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

        $title1 = ( ! empty( $instance['title1'] ) ) ? $instance['title1'] : '';
        $number_posts1 = ( ! empty( $instance['number_posts1'] ) ) ? absint( $instance['number_posts1'] )  : 5;
        $sticky_posts1 = ( isset( $instance['sticky_posts1'] ) ) ? $instance['sticky_posts1'] : false;
        $category1 = $instance['category1'];
        //$offset1 = ( ! empty( $instance['offset1'] ) ) ? absint( $instance['offset1'] ) : 0;
        $title2 = ( ! empty( $instance['title2'] ) ) ? $instance['title2'] : '';
        $number_posts2 = ( ! empty( $instance['number_posts2'] ) ) ? absint( $instance['number_posts2'] )  : 5;
        $sticky_posts2 = ( isset( $instance['sticky_posts2'] ) ) ? $instance['sticky_posts2'] : false;
        $category2 = $instance['category2'];
        //$offset2 = ( ! empty( $instance['offset2'] ) ) ? absint( $instance['offset2'] ) : 0;


        global $paged;
        $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;

        // Latest Posts 1
        $latest_posts1 = new WP_Query(
            array(
                'post_type' => 'post',
                'cat'	=>	$category1,
                'posts_per_page' =>	$number_posts1,
                'paged' => $paged,
                'ignore_sticky_posts' => $sticky_posts1
            )
        );

        // Latest Posts 2
        $latest_posts2 = new WP_Query(
            array(
                'post_type' => 'post',
                'cat'	=>	$category2,
                'posts_per_page' =>	$number_posts2,
                'paged' => $paged,
                'ignore_sticky_posts' => $sticky_posts2
            )
        );
        echo $before_widget;

        ?>
        <!-- Category 1 -->

        <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="awaken-dual-category adc1">
                <?php
                if ( ! empty( $title1 ) ) {
                    echo $before_title . $title1 . $after_title;
                }
                ?>
                <?php
                // Unique id
                $block_id = '#' . $args['widget_id'] . ' .adc1';
                $block_uid = 'block1-' . $args['widget_id'];
                $block_uid_js = '#' . $block_uid;
                ?>
                <div id="block-loader"><i class="fa fa-spinner loader-spin"></i></div>
                <div class="awaken-block" id="<?php echo $block_uid ?>">
                    <?php $j = 1; ?>
                    <?php if ( $latest_posts1 -> have_posts() ) : ?>
                        <?php while ( $latest_posts1 -> have_posts() ) : $latest_posts1 -> the_post(); ?>
                            <?php if( $j == 1) { ?>
                                <div>
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
                                    <div class="genpost-entry-content dmag-summary"><?php the_excerpt(); ?></div>
                                </div>

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
                            <?php $j++ ?>
                            <?php
                            if( !empty($category1) ) {
                                $arc_link1 = get_category_link( $category1 );
                            } else {
                                $pfp_id1 = get_option('page_for_posts');
                                $arc_link1 = get_permalink($pfp_id1);
                            }
                            ?>
                        <?php endwhile; ?>

                        <?php if( !is_rtl() ) : ?>

                            <?php if ($latest_posts1->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
                                <div id="awt-nav" data-blockid="<?php echo $block_id ?>" data-blockuid="<?php echo $block_uid_js ?>">
                                    <span class="ajax-nav-next"><?php echo get_previous_posts_link( '<i class="fa fa-chevron-left"></i>' ); ?></span>
                                    <span class="ajax-view-all"><a class="ajax-vall" href="<?php echo esc_url($arc_link1); ?>" data-toggle="tooltip" data-placement="top" title="<?php _e( 'View All Posts', 'awaken-pro'); ?>"><i class="fa fa-th-large"></i></a></span>
                                    <span class="ajax-nav-previous"><?php echo get_next_posts_link( '<i class="fa  fa-chevron-right"></i>', $latest_posts1->max_num_pages ); ?></span>
                                </div>
                            <?php } ?>

                        <?php else: ?>

                            <?php if ($latest_posts1->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
                                <div id="awt-nav" data-blockid="<?php echo $block_id ?>" data-blockuid="<?php echo $block_uid_js ?>">
                                    <span class="ajax-nav-previous"><?php echo get_next_posts_link( '<i class="fa  fa-chevron-right"></i>', $latest_posts1->max_num_pages ); ?></span>
                                    <span class="ajax-view-all"><a class="ajax-vall" href="<?php echo esc_url($arc_link1); ?>" data-toggle="tooltip" data-placement="top" title="<?php _e( 'View All Posts', 'awaken-pro'); ?>"><i class="fa fa-th-large"></i></a></span>
                                    <span class="ajax-nav-next"><?php echo get_previous_posts_link( '<i class="fa fa-chevron-left"></i>' ); ?></span>
                                </div>
                            <?php } ?>

                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div><!-- .awaken-block -->
            </div><!-- .awaken-dual-category -->
        </div><!-- bootstrap cols -->

        <!-- Category 2 -->

        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="awaken-dual-category adc2">
                <?php
                if ( ! empty( $title2 ) ) {
                    echo $before_title . $title2 . $after_title;
                }
                ?>
                <?php
                // Unique id
                $block_id = '#' . $args['widget_id'] . ' .adc2';
                $block_uid = 'block2-' . $args['widget_id'];
                $block_uid_js = '#' . $block_uid;
                ?>
                <div id="block-loader"><i class="fa fa-spinner loader-spin"></i></div>
                <div class="awaken-block" id="<?php echo $block_uid ?>">
                    <?php $j = 1 ?>
                    <?php if ( $latest_posts2 -> have_posts() ) : ?>
                        <?php while ( $latest_posts2 -> have_posts() ) : $latest_posts2 -> the_post(); ?>
                            <?php if( $j == 1) { ?>
                                <div>
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
                                    <div class="genpost-entry-content dmag-summary"><?php the_excerpt(); ?></div>
                                </div>

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
                            <?php $j++ ?>
                            <?php
                            if( !empty($category2) ) {
                                $arc_link2 = get_category_link( $category2 );
                            } else {
                                $pfp_id2 = get_option('page_for_posts');
                                $arc_link2 = get_permalink($pfp_id2);
                            }
                            ?>
                        <?php endwhile; ?>

                        <?php if( !is_rtl() ) : ?>

                            <?php if ($latest_posts2->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
                                <div id="awt-nav" data-blockid="<?php echo $block_id ?>" data-blockuid="<?php echo $block_uid_js ?>">
                                    <span class="ajax-nav-next"><?php echo get_previous_posts_link( '<i class="fa fa-chevron-left"></i>' ); ?></span>
                                    <span class="ajax-view-all"><a class="ajax-vall" href="<?php echo esc_url($arc_link2); ?>" data-toggle="tooltip" data-placement="top" title="<?php _e( 'View All Posts', 'awaken-pro'); ?>"><i class="fa fa-th-large"></i></a></span>
                                    <span class="ajax-nav-previous"><?php echo get_next_posts_link( '<i class="fa  fa-chevron-right"></i>', $latest_posts2->max_num_pages ); ?></span>
                                </div>
                            <?php } ?>

                        <?php else: ?>

                            <?php if ($latest_posts2->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
                                <div id="awt-nav" data-blockid="<?php echo $block_id ?>" data-blockuid="<?php echo $block_uid_js ?>">
                                    <span class="ajax-nav-previous"><?php echo get_next_posts_link( '<i class="fa  fa-chevron-right"></i>', $latest_posts2->max_num_pages ); ?></span>
                                    <span class="ajax-view-all"><a class="ajax-vall" href="<?php echo esc_url($arc_link2); ?>" data-toggle="tooltip" data-placement="top" title="<?php _e( 'View All Posts', 'awaken-pro'); ?>"><i class="fa fa-th-large"></i></a></span>
                                    <span class="ajax-nav-next"><?php echo get_previous_posts_link( '<i class="fa fa-chevron-left"></i>' ); ?></span>
                                </div>
                            <?php } ?>

                        <?php endif; ?>

                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div><!-- .awaken-block -->
            </div><!-- .awaken-dual-category -->
        </div><!-- bootstrap cols -->
        </div><!-- .row -->

    <?php
        echo $after_widget;

    }


}

// register awaken dual category posts widget
function register_awaken_pro_dual_category_posts() {
    register_widget( 'Awaken_Dual_Category_Posts' );
}
add_action( 'widgets_init', 'register_awaken_pro_dual_category_posts' );