<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Awaken
 */

if ( is_front_page() ) {
	$sidebar_choice = get_theme_mod( 'frontpage_sidebar', 'sidebar-1' );
} elseif ( is_page() ) {
	$sidebar_choice = get_theme_mod( 'page_sidebar', 'sidebar-1' );
} elseif( is_single() ) {
	$sidebar_choice = get_theme_mod( 'post_sidebar', 'sidebar-1' );
} else {
	$sidebar_choice = 'sidebar-1';
}


	if ( ! is_active_sidebar( $sidebar_choice ) ) { return; } ?>  
	
	<div id="secondary" class="main-widget-area" role="complementary">
	    <?php dynamic_sidebar($sidebar_choice); ?>
	</div><!-- #secondary -->