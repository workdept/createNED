<?php
/**
 * Awaken functions and definitions
 *
 * @package Awaken Pro
 */

/**
 * Tweak the redux framework.
 * Register all the theme options.
 * Registers the wpex_option function.
 * Note: As the WordPress.org has announced to remove the options panel it will be not available
 * the Awaken Options Panel after the very next theme update.
 */
if ( file_exists( get_template_directory() . '/inc/options/admin-config.php') ) {
	require_once( get_template_directory() . '/inc/options/admin-config.php' );
}

if ( ! function_exists( 'awaken_pro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function awaken_pro_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Awaken, use a find and replace
	 * to change 'awaken-pro' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'awaken-pro', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured-slider', 752, 440, true );
	add_image_size( 'featured', 388, 220, true );
	add_image_size( 'small-thumb', 120,85, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main_navigation' => __( 'Main Navigation', 'awaken-pro' ),
	) );
	register_nav_menus( array(
		'top_navigation' => __( 'Top Navigation', 'awaken-pro' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'video', 'gallery', 'audio',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'awaken_pro_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 747; /* pixels */
	}	

}
endif; // awaken_pro_setup
add_action( 'after_setup_theme', 'awaken_pro_setup' );

/**
 * Google fonts for customizer.
 */
require( get_template_directory() . '/inc/customizer/fonts.php' );

// Customizer Styles
require get_template_directory() . '/inc/customizer/styles.php';
/**
 * This function Contains All The scripts that Will be Loaded in the Theme Header including Custom Javascript, Custom CSS, etc.
 */
function awaken_pro_initialize_header() {
	
	//Place all Javascript Here
	/*echo '<script>';
		echo $awaken_options['awaken-header-code'];
	echo '</script>';*/
	//Java Script Ends
	
	//CSS Begins
	echo "<style>";
		echo get_theme_mod( 'custom_css', '' );	
	echo "</style>";
	//CSS Ends
	
}
add_action('wp_head', 'awaken_pro_initialize_header');

/**
 * Replaces the excerpt "more" text by a user defined text link
 */
function awaken_pro_excerpt_more() {
    $excerpt = '<a class="moretag" href="'. get_permalink() . '"> ' . wp_kses_post( get_theme_mod( 'read_more_text', '[...]' ) ) . '</a>';
   	return $excerpt;
}
add_filter('excerpt_more', 'awaken_pro_excerpt_more');


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function awaken_pro_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'awaken-pro' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title-container"><h1 class="widget-title">',
		'after_title'   => '</h1></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Magazine 1', 'awaken-pro' ),
		'id'            => 'magazine-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="awt-container"><h1 class="awt-title">',
		'after_title'   => '</h1></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Magazine 2', 'awaken-pro' ),
		'id'            => 'magazine-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="awt-container"><h1 class="awt-title">',
		'after_title'   => '</h1></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Frontpage Sidebar', 'awaken-pro' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'You can use this sidebar for magazine template front page. To use this sidebar for posts go to Customizer > Sidebar Selector and select this sidebar for front page sidebar.', 'awaken-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title-container"><h1 class="widget-title">',
		'after_title'   => '</h1></div>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Post Sidebar', 'awaken-pro' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'You can use this sidebar for single post articles. To use this sidebar for posts go to Customizer > Sidebar Selector and select this sidebar for post sidebar.', 'awaken-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title-container"><h1 class="widget-title">',
		'after_title'   => '</h1></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'awaken-pro' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'You can use this sidebar for pages. To use this sidebar for pages go to Customizer > Sidebar Selector and select this sidebar for page sidebar.', 'awaken-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title-container"><h1 class="widget-title">',
		'after_title'   => '</h1></div>',
	) );		
	register_sidebar( array(
		'name'          => __( 'Header Ad Area', 'awaken-pro' ),
		'id'            => 'header-ad',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="awt-container"><h1 class="awt-title">',
		'after_title'   => '</h1></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Left Sidebar', 'awaken-pro' ),
		'id'            => 'footer-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Footer Mid Sidebar', 'awaken-pro' ),
		'id'            => 'footer-mid',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Footer Right Sidebar', 'awaken-pro' ),
		'id'            => 'footer-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );


/*global $awaken_pro_options;
if ( !empty($awaken_pro_options['awaken-sidebars']) ) {
	$sidebars = $awaken_pro_options['awaken-sidebars'];
}
		
	function generateSlug($phrase, $maxLength) {
	    $result = strtolower($phrase);
	    $result = preg_replace("/[^a-z0-9\s-]/", "", $result);
	    $result = trim(preg_replace("/[\s-]+/", " ", $result));
	    $result = trim(substr($result, 0, $maxLength));
	    $result = preg_replace("/\s/", "-", $result);
    	return $result;
	}
	if( isset( $sidebars ) && sizeof($sidebars) > 0 ) {
	    foreach($sidebars as $sidebar) {
	        register_sidebar( array(
	            'name' => __( $sidebar, 'awaken-pro' ),
	            'id' => generateSlug($sidebar, 45),
	            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	            'after_widget' => "</aside>",
	            'before_title' => '<div class="widget-title-container"><h3 class="widget-title">',
	            'after_title' => '</h3></div>',
	        ) );
	    }
	}*/
	
}
add_action( 'widgets_init', 'awaken_pro_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function awaken_pro_scripts() {
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.1.0' );

	wp_enqueue_style( 'bootstrap.css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), 'all' );
	
	wp_enqueue_style( 'awaken-style', get_stylesheet_uri() );

	wp_enqueue_script( 'awaken-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js',array( 'jquery' ),'', true );	

	wp_enqueue_script( 'awaken-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );

	wp_register_script( 'ajax-scripts', get_template_directory_uri() . '/js/ajax-scripts.js', array( 'jquery' ) );
	wp_enqueue_script('ajax-scripts');
	//wp_localize_script( 'ajax-scripts', 'widget_vars', array( 'block_uid' => "hello" ));


    $awaken_pro_user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if(preg_match('/(?i)msie [1-8]/',$awaken_pro_user_agent)) {
		wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js', true ); 
	}

	wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.min.js' );

	wp_enqueue_script( 'awaken-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'awaken_pro_scripts' );

/**
* Enqueue Google fonts.
*/
function awaken_pro_load_fonts() {
    $fonts = array(
		get_theme_mod( 'title_font', 'Ubuntu' ),
		get_theme_mod( 'heading_font', 'Roboto Condensed' ),
		get_theme_mod( 'body_font', 'Source Sans Pro' )
	);

	$font_uri = awaken_pro_get_google_font_uri( $fonts );

	// Load Google Fonts
	wp_enqueue_style( 'awaken-pro-fonts', $font_uri, array(), null, 'screen' );
}
add_action( 'wp_enqueue_scripts', 'awaken_pro_load_fonts' );

/**
* Add editor stylesheet.
*/
function awaken_pro_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'awaken_pro_add_editor_styles' );


/**
* Enqueue awaken-pro options panel custom css.
*/
function awaken_pro_option_panel_style() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/admin.css', false );
}
add_action( 'admin_enqueue_scripts', 'awaken_pro_option_panel_style' );

/**
 * Activate a favicon for the website.
 */
function awaken_pro_favicon() {
	
	if ( get_theme_mod( 'display_site_favicon', false ) ) {
		$favicon = get_theme_mod( 'site_favicon', '' );
		$awaken_favicon_output = '';
		if ( !empty( $favicon ) ) {
			$awaken_favicon_output .= '<link rel="shortcut icon" href="'.esc_url( $favicon ).'" type="image/x-icon" />';
		}
		echo $awaken_favicon_output;
	}
}
add_action( 'admin_head', 'awaken_pro_favicon' );
add_action( 'wp_head', 'awaken_pro_favicon' );

/**
* Add flex slider.
*/
function awaken_pro_flex_scripts() {
    
    wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), false, true );
    wp_register_script( 'add-awaken-flex-js', get_template_directory_uri() . '/js/awaken.slider.js', array(), '', true );
	wp_enqueue_script( 'add-awaken-flex-js' );    
    wp_register_style( 'add-flex-css', get_template_directory_uri() . '/css/flexslider.css','','', 'screen' );
    wp_enqueue_style( 'add-flex-css' );

}
add_action( 'wp_enqueue_scripts', 'awaken_pro_flex_scripts' );

/* Add Contact methods for authors */
function awaken_pro_contact_methods( $contactmethods ) {
 
    $contactmethods[ 'twitter' ] = 'Twitter Username';
    $contactmethods[ 'facebook' ] = 'Facebook Profile URL';
    $contactmethods[ 'linkedin' ] = 'LinkedIn Public Profile URL';
    $contactmethods[ 'googleplus' ] = 'Google+ Profile URL';
 
    return $contactmethods;
}
 
add_filter( 'user_contactmethods', 'awaken_pro_contact_methods' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';
/**
 * Theme info page.
 */
require get_template_directory() . '/inc/theme-info.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Widget files
 */
require get_template_directory() . '/inc/widgets/three-block-posts.php';
require get_template_directory() . '/inc/widgets/single-category.php';
require get_template_directory() . '/inc/widgets/dual-category.php';
require get_template_directory() . '/inc/widgets/sidebar-posts.php';
require get_template_directory() . '/inc/widgets/medium-rectangle.php';
require get_template_directory() . '/inc/widgets/leaderboard.php';
require get_template_directory() . '/inc/widgets/popular-tags-comments.php';
require get_template_directory() . '/inc/widgets/video-widget.php';
require get_template_directory() . '/inc/widgets/facebook-widget.php';

/* Load slider */
require get_template_directory() . '/inc/functions/slider.php';
/* Social Media Icons */
require get_template_directory() . '/inc/functions/socialmedia.php';

require get_template_directory() . '/inc/meta-boxes.php';


/*
function set_youtube_as_featured_image($post_id) {

    // only want to do this if the post has no thumbnail
    if(!has_post_thumbnail($post_id)) {

        // find the youtube url
        $post_array = get_post($post_id, ARRAY_A);
        $content = $post_array['post_content'];
        $youtube_id = get_youtube_id($content);

        // build the thumbnail string
        $youtube_thumb_url = 'http://img.youtube.com/vi/' . $youtube_id . '/0.jpg';

        // next, download the URL of the youtube image
        media_sideload_image($youtube_thumb_url, $post_id, 'Sample youtube image.');

        // find the most recent attachment for the given post
        $attachments = get_posts(
            array(
                'post_type' => 'attachment',
                'numberposts' => 1,
                'order' => 'ASC',
                'post_parent' => $post_id
            )
        );
        $attachment = $attachments[0];

        // and set it as the post thumbnail
        set_post_thumbnail( $post_id, $attachment->ID );

    } // end if

} // set_youtube_as_featured_image
add_action('save_post', 'set_youtube_as_featured_image');

function get_youtube_id($content) {

    // find the youtube-based URL in the post
    $urls = array();
    preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $content, $urls);
    $youtube_url = $urls[0][0];

    // next, locate the youtube video id
    $youtube_id = '';
    if(strlen(trim($youtube_url)) > 0) {
        parse_str( parse_url( $youtube_url, PHP_URL_QUERY ) );
        $youtube_id = $v;
    } // end if

    return $youtube_id;

}
*/

// Flexslider function for format-gallery
function awaken_pro_flexslider($size) {

	if ( is_page()) :
		$attachment_parent = $post->ID;
	else : 
		$attachment_parent = get_the_ID();
	endif;

	if($images = get_posts(array(
		'post_parent'    => $attachment_parent,
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image',
                'orderby'        => 'menu_order',
                'order'           => 'ASC',
	))) { ?>
	
		<div class="flexslider">
		
			<ul class="slides">
	
				<?php foreach($images as $image) { 
				
					$attimg = wp_get_attachment_image($image->ID, $size); ?>
					
					<li>
						<?php echo $attimg; ?>
					</li>
					
				<?php }; ?>
		
			</ul>
			
		</div><?php
		
	}
}

add_action('wp_ajax_nextPrevious', 'nextPrevious');
add_action('wp_ajax_nopriv_nextPrevious', 'nextPrevious');

function nextPrevious($query) { ?>

	<div class="ajax-nav-previous"><?php echo get_next_posts_link( 'Older Entries', $query->max_num_pages ); ?></div>
	<div class="ajax-nav-next"><?php echo get_previous_posts_link( 'Newer Entries' ); ?></div>
	<?php 

}