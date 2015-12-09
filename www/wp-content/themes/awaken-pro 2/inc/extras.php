<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Awaken
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function awaken_pro_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'awaken_pro_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function awaken_pro_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	global $post;

	$boxed = get_theme_mod( 'awaken_boxed_layout', 'off' );
	if( $boxed === 'on' ) { $classes[] = 'awaken-boxed'; }

	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'awaken_pro_layout', true ); }

	if( is_home() ) {
		$queried_id = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'awaken_pro_layout', true ); 
	}

	if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }
	$awaken_pro_default_layout = get_theme_mod( 'main_layout', 'right-sidebar' );
	$awaken_pro_default_page_layout = get_theme_mod( 'page_layout', 'right-sidebar' ); 
	$awaken_pro_default_post_layout = get_theme_mod( 'single_post_layout', 'right-sidebar' );

	if( $layout_meta == 'default_layout' ) {
		if( is_page() ) {
			if( $awaken_pro_default_page_layout == 'right-sidebar' ) { $classes[] = ''; }
			elseif( $awaken_pro_default_page_layout == 'left-sidebar' ) { $classes[] = 'left-sidebar'; }
			elseif( $awaken_pro_default_page_layout == 'full-width' ) { $classes[] = 'no-sidebar-full-width'; }
		}
		elseif( is_single() ) {
			if( $awaken_pro_default_post_layout == 'right-sidebar' ) { $classes[] = ''; }
			elseif( $awaken_pro_default_post_layout == 'left-sidebar' ) { $classes[] = 'left-sidebar'; }
			elseif( $awaken_pro_default_post_layout == 'full-width' ) { $classes[] = 'no-sidebar-full-width'; }
		}
		elseif( $awaken_pro_default_layout == 'right-sidebar' ) { $classes[] = ''; }
		elseif( $awaken_pro_default_layout == 'left-sidebar' ) { $classes[] = 'left-sidebar'; }
		elseif( $awaken_pro_default_layout == 'full-width' ) { $classes[] = 'no-sidebar-full-width'; }
	}
	elseif( $layout_meta == 'right_sidebar' ) { $classes[] = ''; }
	elseif( $layout_meta == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
	elseif( $layout_meta == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }

	return $classes;
}
add_filter( 'body_class', 'awaken_pro_body_classes' );

/**
 * Add backward compatibility for the title-tag.
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {

function awaken_render_title() { ?>

	<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php }
	
add_action( 'wp_head', 'awaken_render_title' );

}

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function awaken_pro_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'awaken_pro_setup_author' );

/**
 * Sets the post excerpt length to 70 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function awaken_pro_excerpt_length($length) {
	return $excerpt_length = get_theme_mod( 'excerpt_length', '25' );
}
add_filter( 'excerpt_length', 'awaken_pro_excerpt_length' );