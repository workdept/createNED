<?php
/**
 * Writes out the CSS as defined by the values in the Theme Options Panel
 * to the `head` element of the header template.
 *
 * @package awaken
 * @since Awaken Pro 2.0
 */
function awaken_pro_customize_css() { ?>

	<style type="text/css">
	
	<?php
			$customizer_styles = '';

			$customizer_styles .= 'body {
				color: ' . get_theme_mod( 'body_text_color', '#404040' ) . ';
				font-family: "'. get_theme_mod( 'body_font', 'Source Sans Pro' ) .'";
				font-size: '. get_theme_mod( 'body_font_size', 16 ) .'px;
				line-height: '. get_theme_mod( 'body_font_line_height', 24 ) .'px;
			}

			.awaken-boxed .site {
				background-color: '. get_theme_mod( 'boxed_background_color', '#fff' ) .';
			}

			/*@media (min-width: 1200px) {
				.awaken-boxed .container {
					width: 1160px;
				}
			}*/

			button, input, select, textarea {
				font-family: "'. get_theme_mod( 'body_font', 'Source Sans Pro' ) .'";
			}

			a {
				color: '. get_theme_mod( 'article_links_color', '#4169e1' ) .';
			}

			.site-title,
			.top-navigation,
			.main-navigation,
			.main-widget-area .widget-title,
			.awt-title,
			#awt-widget,
			.footer-widget-area .awt-title,
			.footer-widget-title,
			.page-entry-title,
			.archive-page-title,
			.search-page-title {
				font-family: "'. get_theme_mod( 'title_font', 'Ubuntu' ) .'";
			}

			.genpost-entry-meta, 
			.single-entry-meta, 
			.genpost-entry-footer {
				font-family: "'. get_theme_mod( 'body_font', 'Source Sans Pro' ) .'";
			}

			.site-description {
				font-family: "'. get_theme_mod( 'body_font', 'Source Sans Pro' ) .'";
			}';

		// Site Main Color
		$color = get_theme_mod( 'site_main_color', '#FA5742' );
	
		if ( $color != '#FA5742') : 
			$customizer_styles .= '.post-navigation a:hover {
				  color: '.$color.';
				}
				.main-widget-area ul li a:hover {
				  color: '.$color.';
				}
				.ams-title a:hover {
				  color: '.$color.';
				}
				.site-footer a:hover {
				  color: '.$color.';
				}
				.site-title a {
				  color: '.$color.';
				}
				.genpost-entry-title a:hover {
				  color: '.$color.';
				}
				.genpost-entry-meta a:hover,
				.single-entry-meta a:hover,
				.genpost-entry-footer a:hover {
				  color: '.$color.';
				}
				.moretag:hover {
				  color: '.$color.';
				}
				.comment-author .fn,
				.comment-author .url,
				.comment-reply-link,
				.comment-reply-login {
				  color: '.$color.';
				}
				.main-widget-area a:hover{
				  color: '.$color.';
				}
				.authorlla:hover{
					color: '.$color.';
				}
				.awt-nav a:hover{
					color: '.$color.';
				}
				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"] {
					background: '.$color.';
				}
				.awaken-slider-title:hover, .afp-title a:hover {
				  color: '.$color.';
				}
				#awt-nav a:hover {
					color: '.$color.';
				}
				.bd h4 {
					color: '.$color.';
				}
				#block-loader {
					color: '.$color.';
				}
				.main-navigation a:hover {
				  background: '.$color.';
				}
				.main-navigation li.current-menu-item {
				  background-color: '.$color.';
				}
				.page-numbers a:hover {
				  background: '.$color.';
				}
				.page-numbers .current {
				  background: '.$color.';
				}
				#awaken-search-form input[type="submit"] {
				  background-color: '.$color.';
				}
				.responsive-mainnav li a:hover,
				.responsive-topnav li a:hover {
				  background: '.$color.';
				}
				.main-widget-area .widget-title {
				  background: '.$color.';
				}
				.afp:hover .afp-title {
				  color: '.$color.';
				}
				#awt-widget > li:active {
				  background: '.$color.';
				}
				#awaken-tags a:hover {
				  background: '.$color.';
				}
				.page-entry-title,
				.archive-page-title,
				.search-page-title {
				  background: '.$color.';
				}
				.awt-title {
					background: '.$color.';
				}
				#awt-widget > li.active > a, 
				.nav-tabs > li.active > a:hover, 
				#awt-widget > li.active > a:focus {
				    background: '.$color.';
				}
				.awaken-category-list a:hover,
				.awaken-tag-list a:hover {
				  background: '.$color.';
				}

				blockquote {
				  border-left: 2px solid '.$color.';
				}
				.awt-container {
				  border-bottom: 2px solid '.$color.';
				}
				#awt-widget {
				  border-bottom: 2px solid '.$color.';
				}
				.widget-title-container {
				  border-bottom: 2px solid '.$color.';
				}
				.page-entry-header,
				.archive-page-header,
				.search-page-header {
				  border-bottom: 2px solid '.$color.';
				}';
		endif;

		$customizer_styles .= '.site-header {
			background-color: '. get_theme_mod( 'header_bg_color', '#ffffff' ) .';
		}';
		
		$heading_text_color = get_theme_mod( 'heading_text_color', '#353434' );

		$customizer_styles .= '.genpost-entry-title a {
				color: '. $heading_text_color .';
			}

			.single-entry-title {
				color: '. $heading_text_color .';
			}

			h1, h2, h3, h4, h5, h6 {
				color: '. $heading_text_color .';
				font-family: "'. get_theme_mod( 'heading_font', 'Roboto Condensed' ) .'";
			}

			.single-entry-title,
			.awaken-slider-title,
			.afp-title {
				font-family: "'. get_theme_mod( 'heading_font', 'Roboto Condensed' ) .'";
			}';

		// Post / page meta data
		
		$customizer_styles .= '.genpost-entry-meta a, 
				.single-entry-meta a, 
				.genpost-entry-footer a,
				.genpost-entry-meta, 
				.single-entry-meta, 
				.genpost-entry-footer {
					color: '. get_theme_mod( 'post_metadata_color', '#9f9f9f' ) .';
				}';

		// Main Navigation

		$customizer_styles .= '.main-navigation {
				background-color: '. get_theme_mod( 'main_nav_bg_color', '#232323' ) .';
			}

			.main-navigation a, 
			.main-navigation .menu-item-has-children > a:after, 
			.main-navigation .page_item_has_children > a:after, 
			.awaken-search-button-icon {
				color: '. get_theme_mod( 'main_nav_text_color', '#cacaca') .';
			}

			.main-navigation a:hover, 
			.main-navigation .menu-item-has-children:hover > a:after, 
			.main-navigation .page_item_has_children:hover > a:after, 
			.awaken-search-button-icon:hover {
				color: '. get_theme_mod( 'main_nav_text_hover_color', '#ffffff') .';
			}

			.main-navigation a:hover {
				background-color: '. get_theme_mod( 'main_nav_text_hover_bg_color', '#fa5742'). ';
			}

			.main-navigation li.current-menu-item {
				background-color: '. get_theme_mod( 'main_nav_text_hover_bg_color', '#fa5742'). ';
			}

			.main-navigation ul ul a {
				color: '. get_theme_mod( 'main_nav_drpdwn_text_color', '#cccccc') .';
			}

			.main-navigation ul ul a:hover {
				color: '. get_theme_mod( 'main_nav_text_drpdwn_hover_color', '#ffffff') .';
			}

			.main-navigation ul ul {
				background-color: '. get_theme_mod( 'main_nav_drpdwn_bg_color', '#333333' ) .';
			}

			.main-navigation ul ul a:hover {
				background-color: '. get_theme_mod( 'main_nav_drpdwn_hover_bg_color', '#222222' ) .';
			} ';
		

		// Top Navigation

		$customizer_styles .= '.top-nav {
				background-color: '. get_theme_mod( 'top_nav_bg_color', '#232323' ) .';
			}

			.asocial-icon a,
			.top-navigation a, 
			.top-navigation .menu-item-has-children > a:after, 
			.top-navigation .page_item_has_children > a:after, 
			.awaken-search-button-icon {
				color: '. get_theme_mod( 'top_nav_text_color', '#d7d7d7') .';
			}

			.top-navigation a:hover, 
			.top-navigation .menu-item-has-children:hover > a:after, 
			.top-navigation .page_item_has_children:hover > a:after, 
			.awaken-search-button-icon:hover {
				color: '. get_theme_mod( 'top_nav_text_hover_color', '#ffffff') .';
			}

			.top-navigation ul ul a {
				color: '. get_theme_mod( 'top_nav_drpdwn_text_color', '#cccccc') .';
			}

			.top-navigation ul ul a:hover {
				color: '. get_theme_mod( 'top_nav_drpdwn_text_hover_color', '#ffffff') .';
			}

			.top-navigation ul ul {
				background-color: '. get_theme_mod( 'top_nav_drpdwn_bg_color', '#333333' ) .';
			}

			.top-navigation ul ul a:hover {
				background-color: '. get_theme_mod( 'top_nav_drpdwn_hover_bg_color', '#222222' ) .';
			}';

		// Footer area.
		$customizer_styles .= '.site-footer {
				background-color: '. get_theme_mod( 'footer_widget_bg_color', '#242424' ) .';
				color: '. get_theme_mod( 'footer_text_color', '#bbbbbb' ) .';
			}

			.site-footer .ams-meta {
				color: '. get_theme_mod( 'footer_text_color', '#bbbbbb' ) .';
			}

			.footer-widget-area .awt-title, 
			.footer-widget-title,
			.footer-widget-area #awt-nav a {
				color: '. get_theme_mod( 'footer_widget_title_color', '#f5f5f5' ) .';
			}

			.site-footer a {
				color: '. get_theme_mod( 'footer_link_color', '#cccccc' ) .';
			}

			.site-footer a:hover,
			.footer-widget-area #awt-nav a:hover {
				color: '. get_theme_mod( 'footer_link_hover_color', '#fa5742' ) .';
			}

			.footer-site-info {
				background-color: '. get_theme_mod( 'footer_copyright_bg_color', '#171717' ) .';
				color: '. get_theme_mod( 'footer_copyright_text_color', '#bbbbbb' ) .';
			}

			.footer-site-info a {
				color: '. get_theme_mod( 'footer_copyright_text_color', '#bbbbbb' ) .';
			}

			.footer-site-info a:hover {
				color: '. get_theme_mod( 'footer_link_hover_color', '#fa5742' ) .';
			}';

			echo preg_replace('/\s+/', ' ', $customizer_styles);
	?>
	</style>
<?php
	
}
add_action( 'wp_head', 'awaken_pro_customize_css' );


/**
* Tinymce editor styles.
*/
function awaken_pro_tinymce_callback() {

    $body_font = get_theme_mod( 'body_font', 'Source Sans Pro' ); 
    $heading_font = get_theme_mod( 'heading_font', 'Roboto Condensed' );
    $font_size = get_theme_mod( 'body_font_size', 16 );
	$line_height = get_theme_mod( 'body_font_line_height', 24 );

    ?>

    <script type="text/javascript">
    jQuery( document ).ready(

        function() {
            var my_style = 'body { font-family: "<?php echo $body_font; ?>"; font-size: <?php echo $font_size; ?>px; line-height: <?php echo $line_height; ?>px; } button, input, select, textarea{ font-family: "<?php echo $body_font; ?>"; } h1, h2, h3, h4, h5, h6{ font-family: "<?php echo $heading_font; ?>"; }';

            var checkInterval = setInterval(
                function() {

                    if ( 'undefined' !== typeof( tinyMCE ) ) {
                        if ( tinyMCE.activeEditor && ! tinyMCE.activeEditor.isHidden() ) {

                            jQuery( '#content_ifr' ).contents().find( 'head' ).append( '<style type="text/css">' + my_style + '</style>' );

                            clearInterval( checkInterval );
                        }
                    }
                }, 
                500 
            );
        }
    );
    </script>
<?php }
add_action( 'before_wp_tiny_mce', 'awaken_pro_tinymce_callback' );