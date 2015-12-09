<?php
/**
 * Awaken Theme Customizer
 *
 * @package Awaken
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function awaken_pro_customize_register( $wp_customize ) {

	require( get_template_directory() . '/inc/customizer/custom-controls/control-category-dropdown.php' );
	require( get_template_directory() . '/inc/customizer/custom-controls/control-checkbox-multiple.php' );
	require( get_template_directory() . '/inc/customizer/custom-controls/control-layout-selector.php' );

	$wp_customize->remove_section( 'themes' );
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	//$wp_customize->get_section( 'title_tagline' )->title 		= esc_html__( 'Site Identity Settings', 'awaken-pro' );
    //$wp_customize->get_section( 'title_tagline' )->panel      = 'awaken_pro_header_settings';
    $wp_customize->get_section( 'static_front_page' )->panel 	= 'awaken_pro_home_settings';
    $wp_customize->get_section( 'background_image' )->panel 	= 'awaken_pro_theme_styling';
    $wp_customize->get_section( 'colors' )->panel 				= 'awaken_pro_theme_styling';
    //background_color
    $wp_customize->get_control( 'background_color' )->section 	= 'awaken_pro_main_colors';
    


	/**
	 * Header Settings Panel
	 */
	$wp_customize->add_panel( 
		'awaken_pro_header_settings', 
		array(
			'title' => __( 'Header Settings', 'awaken-pro' ),
			'description' => __( 'Use this panel to set your header settings', 'awaken-pro' ),
			'priority' => 25, 
		) 
	);


	// Logo image
    $wp_customize->add_setting(
        'site_logo',
        array(
            'sanitize_callback' => 'awaken_pro_sanitize_image'
        ) 
    ); 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
                'label'         => __( 'Site Logo', 'awaken-pro' ),
                'section'       => 'title_tagline',
                'settings'      => 'site_logo',
                'description' 	=> __( 'Upload a logo for your website. Recommended height for your logo is 135px.', 'awaken-pro' ),
            )
        )
    );

    // Logo, title and description chooser
    $wp_customize->add_setting(
        'site_title_option',
        array(
            'default'           => 'text-only',
            'sanitize_callback' => 'awaken_pro_sanitize_logo_title_select',
            'transport'         => 'refresh'
        )
    );
    $wp_customize->add_control(
        'site_title_option',
        array(
            'label'     	=> __( 'Display site title / logo.', 'awaken-pro' ),
            'section'   	=> 'title_tagline',
            'type'      	=> 'radio',
            'description'	=> __( 'Choose your preferred option.', 'awaken-pro' ),
            'choices'   => array (
                'text-only' 	=> __( 'Display site title and description only.', 'awaken-pro' ),
                'logo-only'     => __( 'Display site logo image only.', 'awaken-pro' ),
                'text-logo'		=> __( 'Display both site title and logo image.', 'awaken-pro' ),
                'display-none'	=> __( 'Display none', 'awaken-pro' )
            )
        )
    );

    // Site favicon
	$wp_customize->add_setting(
        'site_favicon',
        array(
            'sanitize_callback' => 'awaken_pro_sanitize_image'
        ) 
    ); 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
                'label'         => __( 'Upload a favicon', 'awaken-pro' ),
                'section'       => 'title_tagline',
                'settings'      => 'site_favicon',
                'description' 	=> __( 'Upload a favicon for your website.', 'awaken-pro' ),
            )
        )
    );

    // Display site favicon?
    $wp_customize->add_setting(
		'display_site_favicon',
		array(
			'default'			=> false,
			'sanitize_callback'	=> 'awaken_pro_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_site_favicon',
		array(
			'settings'		=> 'display_site_favicon',
			'section'		=> 'title_tagline',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display site favicon?', 'awaken-pro' ),
		)
	);


    /**
     * General settings section.
     */
    $wp_customize->add_section( 
    	'awaken_pro_general_settings', 
    	array(
			'title' => __( 'General Settings', 'awaken-pro' ),
			'priority' => 30,
		) 
	);

    // Excerpt Length
	$wp_customize->add_setting(
		'excerpt_length',
		array(
			'default'			=> 25,
			'sanitize_callback'	=> 'awaken_pro_sanitize_intval'
		)
	);

	$wp_customize->add_control(
		'excerpt_length',
		array(
			'settings'		=> 'excerpt_length',
			'section'		=> 'awaken_pro_general_settings',
			'type'			=> 'number',
			'label'			=> __( 'Excerpt Length', 'awaken-pro' ),
			'description'	=> __( 'Number of words to display on posts of blog posts listings.', 'awaken-pro' )
		)
	);	

	// Read more text.
	$wp_customize->add_setting(
		'read_more_text',
		array(
			'default'			=> '[...]',
			'sanitize_callback'	=> 'awaken_pro_sanitize_html'
		)
	);
	$wp_customize->add_control(
		'read_more_text',
		array(
			'settings'		=> 'read_more_text',
			'section'		=> 'awaken_pro_general_settings',
			'type'			=> 'textarea',
			'label'			=> __( 'Read more text', 'awaken-pro' ),
			'description'	=> __( 'Give a read more text for posts. HTML allowed.', 'awaken-pro' )
		)
	);


	// Footer copyright text.
	$wp_customize->add_setting(
		'footer_copyright_text',
		array(
			'default'			=> sprintf( __( 'Copyright %s. All rights reserved.', 'awaken-pro' ), esc_html( get_bloginfo( 'name' ) ) ),
			'sanitize_callback'	=> 'awaken_pro_sanitize_html'
		)
	);
	$wp_customize->add_control(
		'footer_copyright_text',
		array(
			'settings'		=> 'footer_copyright_text',
			'section'		=> 'awaken_pro_general_settings',
			'type'			=> 'textarea',
			'label'			=> __( 'Footer copyright text', 'awaken-pro' ),
			'description'	=> __( 'Copyright or other text to be displayed in the site footer. HTML allowed.', 'awaken-pro' )
		)
	);


    /**
     * Home Settings section.
     */
    $wp_customize->add_panel( 
		'awaken_pro_home_settings', 
		array(
			'title' => __( 'Homepage Settings', 'awaken-pro' ),
			'description' => __( 'Use this panel to set your home page settings', 'awaken-pro' ),
			'priority' => 31, 
		) 
	);

	/**
     * Slider Section.
     */
    $wp_customize->add_section( 
    	'awaken_pro_slider', 
    	array(
			'title' 		=> __( 'Feartured Slider', 'awaken-pro' ),
			'description' 	=> __( 'Use this section to setup the homepage slider and featured posts.', 'awaken-pro' ),
			'panel' 		=> 'awaken_pro_home_settings'
		) 
	);

    // Display slider?
    $wp_customize->add_setting(
		'display_slider',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'awaken_pro_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_slider',
		array(
			'settings'		=> 'display_slider',
			'section'		=> 'awaken_pro_slider',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display slider on homepage ?', 'awaken-pro' )
		)
	);

	// Slide Count
	$wp_customize->add_setting(
		'slides_count',
		array(
			'default'			=> 5,
			'sanitize_callback'	=> 'awaken_pro_sanitize_number'
		)
	);

	$wp_customize->add_control(
		'slides_count',
		array(
			'settings'		=> 'slides_count',
			'section'		=> 'awaken_pro_slider',
			'type'			=> 'number',
			'label'			=> __( 'Number of slides to display in the slider.', 'awaken-pro' ),
		)
	);

	$wp_customize->add_setting(
		'slider_category',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_category_dropdown'
		)
	);

	$wp_customize->add_control(
		new Awaken_Pro_WP_Customize_Category_Control( 
			$wp_customize,
			'slider_category', 
			array(
			    'label'   		=> __( 'Select the category for slider.', 'awaken-pro' ),
			    'description'	=> __( 'Featured images of the posts from selected category will be displayed in the slider', 'awaken-pro' ),
			    'section' 		=> 'awaken_pro_slider',
			    'settings'  	=> 'slider_category',
			) 
		) 
	);

	$wp_customize->add_setting(
		'featured_posts_category',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_category_dropdown'
		)
	);

	$wp_customize->add_control(
		new Awaken_Pro_WP_Customize_Category_Control( 
			$wp_customize,
			'featured_posts_category', 
			array(
			    'label'   		=> __( 'Select the category for featured posts.', 'awaken-pro' ),
			    'description'	=> __( 'Featured images of the posts from selected category will be displayed in the slider', 'awaken-pro' ),
			    'section' 		=> 'awaken_pro_slider',
			    'settings'  	=> 'featured_posts_category',
			) 
		) 
	);
	
	/**
     * Custom Slider Section.
     */
	$wp_customize->add_section( 
    	'awaken_pro_custom_slider', 
    	array(
			'title' 		=> __( 'Custom Slider', 'awaken-pro' ),
			'panel'			=> 'awaken_pro_home_settings',
			'description'	=> __( '<b>Note:</b> Recommended image width is <b>752px</b> and recommended image height is <b>440px</b> for custom slider images. Uploading bigger images may cause slow site loading times.', 'awaken-pro' ),			
		) 
	);

    $wp_customize->add_setting(
		'display_custom_slider_switch',
		array(
			'default'			=> false,
			'sanitize_callback'	=> 'awaken_pro_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_custom_slider_switch',
		array(
			'settings'		=> 'display_custom_slider_switch',
			'section'		=> 'awaken_pro_custom_slider',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display custom slider as main slider?', 'awaken-pro' ),
			'description'	=> __( 'Mark the checkbox if you want to display custom slider instead of category posts slider.', 'awaken-pro' )
		)
	);		

	for ( $i=1; $i <= 10; $i++ ) { 
		$wp_customize->add_setting(
	        'custom_slide_img_' . $i . '',
	        array(
	            'sanitize_callback' => 'awaken_pro_sanitize_image'
	        ) 
	    ); 
	    $wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'custom_slide_img_' . $i . '',
	            array(
	                'label'         => sprintf( __( 'Slide %d image', 'awaken-pro' ), $i ),
	                'section'       => 'awaken_pro_custom_slider',
	                'settings'      => 'custom_slide_img_' . $i . '',
	            )
	        )
	    );

	    $wp_customize->add_setting(
			'custom_slide_title_' . $i . '',
			array(
				'default'			=> '',
				'sanitize_callback'	=> 'awaken_pro_sanitize_html'
			)
		);

		$wp_customize->add_control(
			'custom_slide_title_' . $i . '',
			array(
				'settings'		=> 'custom_slide_title_' . $i . '',
				'section'		=> 'awaken_pro_custom_slider',
				'type'			=> 'text',
				'label'			=> sprintf( __( 'Slide %d title', 'awaken-pro' ), $i )
			)
		);

	    $wp_customize->add_setting(
			'custom_slide_url_' . $i . '',
			array(
				'default'			=> '',
				'sanitize_callback'	=> 'awaken_pro_sanitize_url'
			)
		);

		$wp_customize->add_control(
			'custom_slide_url_' . $i . '',
			array(
				'settings'		=> 'custom_slide_url_' . $i . '',
				'section'		=> 'awaken_pro_custom_slider',
				'type'			=> 'text',
				'label'			=> sprintf( __( 'Slide %d url', 'awaken-pro' ), $i )
			)
		);
    }	


	/**
     * Post / Page settings
     */
    $wp_customize->add_section( 
    	'awaken_pro_post_page_settings', 
    	array(
			'title' 		=> __( 'Post / Page Settings', 'awaken-pro' ),
			'priority'		=> 32
		) 
	);

	$wp_customize->add_setting(
        'index_post_meta',
        array(
            'default'           => array( 'date', 'author', 'comments' ),
            'sanitize_callback' => 'awaken_pro_sanitize_checkbox_multiple'
        )
    );

    $wp_customize->add_control(
        new Awaken_Pro_Customize_Control_Checkbox_Multiple(
            $wp_customize,
            'index_post_meta',
            array(
                'section' => 'awaken_pro_post_page_settings',
                'label'   => __( 'Select what post meta data to display on index pages and on magazine widgets.', 'awaken-pro' ),
                'choices' => array(
                    'date'		=> __( 'Date', 'awaken-pro' ),
                    'author'    => __( 'Author', 'awaken-pro' ),
                    'comments'	=> __( 'Comments', 'awaken-pro' ),
                )
            )
        )
    );

	$wp_customize->add_setting(
        'single_post_meta',
        array(
            'default'           => array( 'date', 'author', 'comments' ),
            'sanitize_callback' => 'awaken_pro_sanitize_checkbox_multiple'
        )
    );

    $wp_customize->add_control(
        new Awaken_Pro_Customize_Control_Checkbox_Multiple(
            $wp_customize,
            'single_post_meta',
            array(
                'section' => 'awaken_pro_post_page_settings',
                'label'   => __( 'Select what post meta data to display in single posts.', 'awaken-pro' ),
                'choices' => array(
                    'date'		=> __( 'Date', 'awaken-pro' ),
                    'author'    => __( 'Author', 'awaken-pro' ),
                    'comments'	=> __( 'Comments', 'awaken-pro' ),
                )
            )
        )
    );

    // Show comments on posts.
    $wp_customize->add_setting(
		'display_post_comments',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'awaken_pro_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_post_comments',
		array(
			'settings'		=> 'display_post_comments',
			'section'		=> 'awaken_pro_post_page_settings',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display post comments.', 'awaken-pro' ),
			'description'	=> __( 'Mark the checkbox if you want to display comments on post articles.', 'awaken-pro' )
		)
	);	

    // Show comments on pages.
    $wp_customize->add_setting(
		'display_page_comments',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'awaken_pro_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_page_comments',
		array(
			'settings'		=> 'display_page_comments',
			'section'		=> 'awaken_pro_post_page_settings',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display page comments.', 'awaken-pro' ),
			'description'	=> __( 'Mark the checkbox if you want to display comments on pages.', 'awaken-pro' )
		)
	);		


    // Show featured image in single posts.
    $wp_customize->add_setting(
		'show_article_featured_image',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'awaken_pro_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'show_article_featured_image',
		array(
			'settings'		=> 'show_article_featured_image',
			'section'		=> 'awaken_pro_post_page_settings',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display featured image inside the single post article.', 'awaken-pro' ),
			'description'	=> __( 'Mark the checkbox if you want to show featured image on single post article.', 'awaken-pro' )
		)
	);	

    // Show related posts.
    $wp_customize->add_setting(
		'display_related_posts',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'awaken_pro_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_related_posts',
		array(
			'settings'		=> 'display_related_posts',
			'section'		=> 'awaken_pro_post_page_settings',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display related posts in single post articles.', 'awaken-pro' ),
			'description'	=> __( 'Mark the checkbox if you want to display related posts in articles.', 'awaken-pro' )
		)
	);	

    // Show author box.
    $wp_customize->add_setting(
		'display_author_box',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'awaken_pro_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_author_box',
		array(
			'settings'		=> 'display_author_box',
			'section'		=> 'awaken_pro_post_page_settings',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display author box in single post articles.', 'awaken-pro' ),
			'description'	=> __( 'Mark the checkbox if you want to display author box in articles.', 'awaken-pro' )
		)
	);	

    /**
     * Layout Options
     */
    $wp_customize->add_section(
		'awaken_pro_layout_options',
		array(
			'title'			=> __( 'Layout Options', 'awaken-pro' ),
			'priority'		=> 32
		)
	);

	$wp_customize->add_setting(
		'awaken_boxed_layout',
		array(
			'default'			=> 'off',
			'sanitize_callback'	=> 'awaken_pro_sanitize_select'
		)
	);	

	$wp_customize->add_control(
		'awaken_boxed_layout',
		array(
			'settings'		=> 'awaken_boxed_layout',
			'section'		=> 'awaken_pro_layout_options',
			'type'			=> 'radio',
			'label'			=> __( 'Boxed Layout', 'awaken-pro' ),
			'description'	=> __( 'Select enable if you want to display your site in a boxed layout.', 'awaken-pro' ),
			'choices'		=> array(
				'on' 	=> __( 'Enable', 'awaken-pro' ),
				'off' 	=> __( 'Disable', 'awaken-pro' )
			)
		)
	);

    // Default layout selector. ( Radio Image )
    $wp_customize->add_setting(
		'main_layout',
		array(
			'default'			=> 'right-sidebar',
			'sanitize_callback'	=> 'awaken_pro_sanitize_select'
		)
	);
	$wp_customize->add_control(
		new Awaken_Pro_Custom_Radio_Image_Control( 
			$wp_customize,
			'main_layout',
			array(
				'settings'		=> 'main_layout',
				'section'		=> 'awaken_pro_layout_options',
				'label'			=> __( 'Default layout', 'awaken-pro' ),
				'description'	=> __( 'Select the main content and sidebar alignment for archives.', 'awaken-pro' ),
				'choices'		=> array(
					'full-width' 		=> get_template_directory_uri() . '/inc/customizer/assets/full-width.png',
					'left-sidebar' 		=> get_template_directory_uri() . '/inc/customizer/assets/left-sidebar.png',
					'right-sidebar'		=> get_template_directory_uri() . '/inc/customizer/assets/right-sidebar.png',
				)
			)
		)
	);

	// Single post layout selector. ( Radio Image )
    $wp_customize->add_setting(
		'single_post_layout',
		array(
			'default'			=> 'right-sidebar',
			'sanitize_callback'	=> 'awaken_pro_sanitize_select'
		)
	);
	$wp_customize->add_control(
		new Awaken_Pro_Custom_Radio_Image_Control( 
			$wp_customize,
			'single_post_layout',
			array(
				'settings'		=> 'single_post_layout',
				'section'		=> 'awaken_pro_layout_options',
				'label'			=> __( 'Single post layout', 'awaken-pro' ),
				'description'	=> __( 'Select the default layout for single post articles.', 'awaken-pro' ),
				'choices'		=> array(
					'full-width' 		=> get_template_directory_uri() . '/inc/customizer/assets/full-width.png',
					'left-sidebar' 		=> get_template_directory_uri() . '/inc/customizer/assets/left-sidebar.png',
					'right-sidebar'		=> get_template_directory_uri() . '/inc/customizer/assets/right-sidebar.png',
				)
			)
		)
	);

	// Page layout selector. ( Radio Image )
    $wp_customize->add_setting(
		'page_layout',
		array(
			'default'			=> 'right-sidebar',
			'sanitize_callback'	=> 'awaken_pro_sanitize_select'
		)
	);
	$wp_customize->add_control(
		new Awaken_Pro_Custom_Radio_Image_Control( 
			$wp_customize,
			'page_layout',
			array(
				'settings'		=> 'page_layout',
				'section'		=> 'awaken_pro_layout_options',
				'label'			=> __( 'Page layout', 'awaken-pro' ),
				'description'	=> __( 'Select the default layout for pages.', 'awaken-pro' ),
				'choices'		=> array(
					'full-width' 		=> get_template_directory_uri() . '/inc/customizer/assets/full-width.png',
					'left-sidebar' 		=> get_template_directory_uri() . '/inc/customizer/assets/left-sidebar.png',
					'right-sidebar'		=> get_template_directory_uri() . '/inc/customizer/assets/right-sidebar.png',
				)
			)
		)
	);

	/**
     * Styling Options.
     */
	$wp_customize->add_panel( 
		'awaken_pro_theme_styling', 
		array(
			'title' 		=> __( 'Site Styling', 'awaken-pro' ),
			'description' 	=> __( 'Use this section to setup the homepage slider and featured posts.', 'awaken-pro' ),
			'priority' 		=> 33, 
		) 
	);

	/**
     * Custom CSS section
     */
    $wp_customize->add_section( 
    	'awaken_pro_custom_css', 
    	array(
			'title' 		=> __( 'Custom CSS', 'awaken-pro' ),
			'panel' 		=> 'awaken_pro_theme_styling',
			'priority'		=> 50
		) 
	);

	$wp_customize->add_setting(
		'custom_css',
		array(
			'default'			=> '',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'awaken_pro_sanitize_css'
		)
	);
	$wp_customize->add_control(
		'custom_css',
		array(
			'settings'		=> 'custom_css',
			'section'		=> 'awaken_pro_custom_css',
			'type'			=> 'textarea',
			'label'			=> __( 'Custom CSS', 'awaken-pro' ),
			'description'	=> __( 'Define custom CSS be used for your site. Do not enclose in script tags.', 'awaken-pro' ),
		)
	);

	/**
	 * Main Colors
	 */
	$wp_customize->add_section( 
    	'awaken_pro_main_colors', 
    	array(
			'title' 		=> __( 'Site Main Colors', 'awaken-pro' ),
			'panel' 		=> 'awaken_pro_theme_styling',
			'priority'		=> 80
		) 
	);

	$wp_customize->add_setting(
		'boxed_background_color',
		array(
			'default'			=> '#ffffff',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'boxed_background_color',
			array(
				'settings'		=> 'boxed_background_color',
				'section'		=> 'awaken_pro_main_colors',
				'label'			=> __( 'Boxed Layout Background Color', 'awaken-pro' ),
				'description'	=> __( 'Works only when the <b>Boxed Layout</b> is enabled from Layout Options.', 'awaken-pro' )
			)
		)
	);

	$wp_customize->add_setting(
		'site_main_color',
		array(
			'default'			=> '#FA5742',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_main_color',
			array(
				'settings'		=> 'site_main_color',
				'section'		=> 'awaken_pro_main_colors',
				'label'			=> __( 'Site Main Color', 'awaken-pro' ),
				'description'	=> __( 'Pick a main color for the site.', 'awaken-pro' )
			)
		)
	);

	$wp_customize->add_setting(
		'header_bg_color',
		array(
			'default'			=> '#ffffff',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_bg_color',
			array(
				'settings'		=> 'header_bg_color',
				'section'		=> 'awaken_pro_main_colors',
				'label'			=> __( 'Header Background Color', 'awaken-pro' ),
				'description'	=> __( 'Background color for the site header.', 'awaken-pro' )

			)
		)
	);	

	$wp_customize->add_setting(
		'body_text_color',
		array(
			'default'			=> '#404040',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_text_color',
			array(
				'settings'		=> 'body_text_color',
				'section'		=> 'awaken_pro_main_colors',
				'label'			=> __( 'Body Text Color', 'awaken-pro' ),
				'description'	=> __( 'Pick a color for the body text.', 'awaken-pro' )
			)
		)
	);


	$wp_customize->add_setting(
		'heading_text_color',
		array(
			'default'			=> '#353434',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'heading_text_color',
			array(
				'settings'		=> 'heading_text_color',
				'section'		=> 'awaken_pro_main_colors',
				'label'			=> __( 'Heading Text Color', 'awaken-pro' ),
				'description'	=> __( 'Text color for widget post titles, single post titles, archive post titles and all the article heading tags.', 'awaken-pro' )
			)
		)
	);

	$wp_customize->add_setting(
		'article_links_color',
		array(
			'default'			=> '#4169e1',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'article_links_color',
			array(
				'settings'		=> 'article_links_color',
				'section'		=> 'awaken_pro_main_colors',
				'label'			=> __( 'Article Link Color', 'awaken-pro' ),
				'description'	=> __( 'Color for links in single post articles.', 'awaken-pro' )
			)
		)
	);		

	$wp_customize->add_setting(
		'post_metadata_color',
		array(
			'default'			=> '#9f9f9f',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'post_metadata_color',
			array(
				'settings'		=> 'post_metadata_color',
				'section'		=> 'awaken_pro_main_colors',
				'label'			=> __( 'Post Metadata Color', 'awaken-pro' ),
				'description'	=> __( 'Color for data like post date, author.', 'awaken-pro' )
			)
		)
	);

	/**
	 * Main Navigation Colors
	 */
	$wp_customize->add_section( 
    	'awaken_pro_main_nav_colors', 
    	array(
			'title' 		=> __( 'Main Navigation Colors', 'awaken-pro' ),
			'panel' 		=> 'awaken_pro_theme_styling',
			'priority'		=> 80
		) 
	);

	$wp_customize->add_setting(
		'main_nav_bg_color',
		array(
			'default'			=> '#232323',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_nav_bg_color',
			array(
				'settings'		=> 'main_nav_bg_color',
				'section'		=> 'awaken_pro_main_nav_colors',
				'label'			=> __( 'Main Navigation Background Color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'main_nav_text_color',
		array(
			'default'			=> '#cacaca',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_nav_text_color',
			array(
				'settings'		=> 'main_nav_text_color',
				'section'		=> 'awaken_pro_main_nav_colors',
				'label'			=> __( 'Main Navigation Text/Link Color', 'awaken-pro' ),
			)
		)
	);			

	$wp_customize->add_setting(
		'main_nav_text_hover_color',
		array(
			'default'			=> '#ffffff',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_nav_text_hover_color',
			array(
				'settings'		=> 'main_nav_text_hover_color',
				'section'		=> 'awaken_pro_main_nav_colors',
				'label'			=> __( 'Main Navigation Text/Link Hover Color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'main_nav_text_hover_bg_color',
		array(
			'default'			=> '#fa5742',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_nav_text_hover_bg_color',
			array(
				'settings'		=> 'main_nav_text_hover_bg_color',
				'section'		=> 'awaken_pro_main_nav_colors',
				'label'			=> __( 'Main Navigation Text/Link Hover Background Color', 'awaken-pro' ),
			)
		)
	);				

	$wp_customize->add_setting(
		'main_nav_drpdwn_text_color',
		array(
			'default'			=> '#CCCCCC',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_nav_drpdwn_text_color',
			array(
				'settings'		=> 'main_nav_drpdwn_text_color',
				'section'		=> 'awaken_pro_main_nav_colors',
				'label'			=> __( 'Main Navigation Dropdown Text/Link Color', 'awaken-pro' ),
			)
		)
	);			

	$wp_customize->add_setting(
		'main_nav_text_drpdwn_hover_color',
		array(
			'default'			=> '#ffffff',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_nav_text_drpdwn_hover_color',
			array(
				'settings'		=> 'main_nav_text_drpdwn_hover_color',
				'section'		=> 'awaken_pro_main_nav_colors',
				'label'			=> __( 'Main Navigation Dropdown Text/Link Hover Color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'main_nav_drpdwn_bg_color',
		array(
			'default'			=> '#333333',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_nav_drpdwn_bg_color',
			array(
				'settings'		=> 'main_nav_drpdwn_bg_color',
				'section'		=> 'awaken_pro_main_nav_colors',
				'label'			=> __( 'Main Navigation Dropdown Background Color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'main_nav_drpdwn_hover_bg_color',
		array(
			'default'			=> '#222222',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_nav_drpdwn_hover_bg_color',
			array(
				'settings'		=> 'main_nav_drpdwn_hover_bg_color',
				'section'		=> 'awaken_pro_main_nav_colors',
				'label'			=> __( 'Main Navigation Dropdown Hover Background Color', 'awaken-pro' ),
			)
		)
	);	

	/**
     * Top navigation colors
     */	

	$wp_customize->add_section( 
    	'awaken_pro_top_nav_colors', 
    	array(
			'title' 		=> __( 'Top Navigation Colors', 'awaken-pro' ),
			'panel' 		=> 'awaken_pro_theme_styling',
			'priority'		=> 80
		) 
	);

	$wp_customize->add_setting(
		'top_nav_bg_color',
		array(
			'default'			=> '#232323',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'top_nav_bg_color',
			array(
				'settings'		=> 'top_nav_bg_color',
				'section'		=> 'awaken_pro_top_nav_colors',
				'label'			=> __( 'Top Navigation Background Color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'top_nav_text_color',
		array(
			'default'			=> '#cacaca',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'top_nav_text_color',
			array(
				'settings'		=> 'top_nav_text_color',
				'section'		=> 'awaken_pro_top_nav_colors',
				'label'			=> __( 'Top Navigation Text/Link Color', 'awaken-pro' ),
			)
		)
	);			

	$wp_customize->add_setting(
		'top_nav_text_hover_color',
		array(
			'default'			=> '#ffffff',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'top_nav_text_hover_color',
			array(
				'settings'		=> 'top_nav_text_hover_color',
				'section'		=> 'awaken_pro_top_nav_colors',
				'label'			=> __( 'Top Navigation Text/Link Hover Color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'top_nav_drpdwn_bg_color',
		array(
			'default'			=> '#333333',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'top_nav_drpdwn_bg_color',
			array(
				'settings'		=> 'top_nav_drpdwn_bg_color',
				'section'		=> 'awaken_pro_top_nav_colors',
				'label'			=> __( 'Top Navigation Dropdown Background Color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'top_nav_drpdwn_hover_bg_color',
		array(
			'default'			=> '#222222',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'top_nav_drpdwn_hover_bg_color',
			array(
				'settings'		=> 'top_nav_drpdwn_hover_bg_color',
				'section'		=> 'awaken_pro_top_nav_colors',
				'label'			=> __( 'Top Navigation Dropdown Hover Background Color', 'awaken-pro' ),
			)
		)
	);

	$wp_customize->add_setting(
		'top_nav_drpdwn_text_color',
		array(
			'default'			=> '#CCCCCC',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'top_nav_drpdwn_text_color',
			array(
				'settings'		=> 'top_nav_drpdwn_text_color',
				'section'		=> 'awaken_pro_top_nav_colors',
				'label'			=> __( 'Top Navigation Dropdown Text/Link Color', 'awaken-pro' ),
			)
		)
	);			

	$wp_customize->add_setting(
		'top_nav_drpdwn_text_hover_color',
		array(
			'default'			=> '#ffffff',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'top_nav_drpdwn_text_hover_color',
			array(
				'settings'		=> 'top_nav_drpdwn_text_hover_color',
				'section'		=> 'awaken_pro_top_nav_colors',
				'label'			=> __( 'Top Navigation Dropdown Text/Link Hover Color', 'awaken-pro' ),
			)
		)
	);

	/**
     * Footer colors
     */	

	$wp_customize->add_section( 
    	'awaken_pro_footer_colors', 
    	array(
			'title' 		=> __( 'Footer Colors', 'awaken-pro' ),
			'panel' 		=> 'awaken_pro_theme_styling',
			'priority'		=> 80
		) 
	);

	$wp_customize->add_setting(
		'footer_widget_bg_color',
		array(
			'default'			=> '#242424',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_widget_bg_color',
			array(
				'settings'		=> 'footer_widget_bg_color',
				'section'		=> 'awaken_pro_footer_colors',
				'label'			=> __( 'Footer widgets area background color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'footer_widget_title_color',
		array(
			'default'			=> '#f5f5f5',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_widget_title_color',
			array(
				'settings'		=> 'footer_widget_title_color',
				'section'		=> 'awaken_pro_footer_colors',
				'label'			=> __( 'Footer widget title color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'footer_text_color',
		array(
			'default'			=> '#bbbbbb',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color',
			array(
				'settings'		=> 'footer_text_color',
				'section'		=> 'awaken_pro_footer_colors',
				'label'			=> __( 'Footer text color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'footer_link_color',
		array(
			'default'			=> '#cccccc',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_link_color',
			array(
				'settings'		=> 'footer_link_color',
				'section'		=> 'awaken_pro_footer_colors',
				'label'			=> __( 'Footer link color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'footer_link_hover_color',
		array(
			'default'			=> '#fa5742',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_link_hover_color',
			array(
				'settings'		=> 'footer_link_hover_color',
				'section'		=> 'awaken_pro_footer_colors',
				'label'			=> __( 'Footer link hover color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'footer_copyright_bg_color',
		array(
			'default'			=> '#171717',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_copyright_bg_color',
			array(
				'settings'		=> 'footer_copyright_bg_color',
				'section'		=> 'awaken_pro_footer_colors',
				'label'			=> __( 'Footer copyright area background color', 'awaken-pro' ),
			)
		)
	);	

	$wp_customize->add_setting(
		'footer_copyright_text_color',
		array(
			'default'			=> '#bbbbbb',
			'sanitize_callback'	=> 'awaken_pro_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_copyright_text_color',
			array(
				'settings'		=> 'footer_copyright_text_color',
				'section'		=> 'awaken_pro_footer_colors',
				'label'			=> __( 'Footer copyright area text color', 'awaken-pro' ),
			)
		)
	);		

	/**
     * Typography
     */
    $wp_customize->add_section( 
    	'awaken_pro_typography', 
    	array(
			'title' 		=> __( 'Typography', 'awaken-pro' ),
			'priority'		=> 34
		) 
	);

	$wp_customize->add_setting(
		'title_font',
		array(
			'default'			=> 'Ubuntu',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'awaken_pro_sanitize_font_choice'
		)
	);

	$font_choices = awaken_pro_get_font_choices();

	$wp_customize->add_control(
		'title_font',
		array(
			'settings'		=> 'title_font',
			'section'		=> 'awaken_pro_typography',
			'type'			=> 'select',
			'label'			=> __( 'Title Font', 'awaken-pro' ),
			'description'	=> __( 'Font for site title, main navigation, top navigation, page titles and widget titles. Default - <b>Ubuntu.</b>', 'awaken-pro' ),
			'choices'		=> $font_choices
		)
	);

	$wp_customize->add_setting(
		'heading_font',
		array(
			'default'			=> 'Roboto Condensed',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'awaken_pro_sanitize_font_choice'
		)
	);

	$font_choices = awaken_pro_get_font_choices();

	$wp_customize->add_control(
		'heading_font',
		array(
			'settings'		=> 'heading_font',
			'section'		=> 'awaken_pro_typography',
			'type'			=> 'select',
			'label'			=> __( 'Heading Font', 'awaken-pro' ),
			'description'	=> __( 'Font for all html heading tags and post tites. Default - <b>Roboto Condensed.</b>', 'awaken-pro' ),
			'choices'		=> $font_choices
		)
	);


	$wp_customize->add_setting(
		'body_font',
		array(
			'default'			=> 'Source Sans Pro',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'awaken_pro_sanitize_font_choice'
		)
	);

	$font_choices = awaken_pro_get_font_choices();

	$wp_customize->add_control(
		'body_font',
		array(
			'settings'		=> 'body_font',
			'section'		=> 'awaken_pro_typography',
			'type'			=> 'select',
			'label'			=> __( 'Body Font', 'awaken-pro' ),
			'description'	=> __( 'Font for the site content. Default - <b>Source Sans Pro.</b>', 'awaken-pro' ),
			'choices'		=> $font_choices
		)
	);

	$wp_customize->add_setting(
		'body_font_size',
		array(
			'default'			=> 16,
			'sanitize_callback'	=> 'awaken_pro_sanitize_number'
		)
	);

	$wp_customize->add_control(
		'body_font_size',
		array(
			'settings'		=> 'body_font_size',
			'section'		=> 'awaken_pro_typography',
			'type'			=> 'number',
			'label'			=> __( 'Body Font Size in Pixels.', 'awaken-pro' ),
			'description'	=> __( 'Default - 16px.', 'awaken-pro' )
		)
	);	

	$wp_customize->add_setting(
		'body_font_line_height',
		array(
			'default'			=> 24,
			'sanitize_callback'	=> 'awaken_pro_sanitize_number'
		)
	);

	$wp_customize->add_control(
		'body_font_line_height',
		array(
			'settings'		=> 'body_font_line_height',
			'section'		=> 'awaken_pro_typography',
			'type'			=> 'number',
			'label'			=> __( 'Body Content Line Height.', 'awaken-pro' ),
			'description'	=> __( 'Default - 24px.', 'awaken-pro' )
		)
	);	

	/**
     * Social Media
     */
    $wp_customize->add_section( 
    	'awaken_pro_social_media', 
    	array(
			'title' 		=> __( 'Social Media', 'awaken-pro' ),
			'priority'		=> 34
		) 
	);

	$wp_customize->add_setting(
		'display_social_icons',
		array(
			'default'			=> false,
			'sanitize_callback'	=> 'awaken_pro_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'display_social_icons',
		array(
			'settings'		=> 'display_social_icons',
			'section'		=> 'awaken_pro_social_media',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display social icons?', 'awaken-pro' ),
		)
	);

	$wp_customize->add_setting(
		'facebook_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'facebook_url',
		array(
			'settings'		=> 'facebook_url',
			'section'		=> 'awaken_pro_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Facebook URL', 'awaken-pro' ),
		)
	);

	$wp_customize->add_setting(
		'twitter_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'twitter_url',
		array(
			'settings'		=> 'twitter_url',
			'section'		=> 'awaken_pro_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Twitter URL', 'awaken-pro' ),
		)
	);

	$wp_customize->add_setting(
		'googleplus_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'googleplus_url',
		array(
			'settings'		=> 'googleplus_url',
			'section'		=> 'awaken_pro_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Google Plus URL', 'awaken-pro' ),
		)
	);

	$wp_customize->add_setting(
		'linkedin_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'linkedin_url',
		array(
			'settings'		=> 'linkedin_url',
			'section'		=> 'awaken_pro_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Linkedin URL', 'awaken-pro' ),
		)
	);

	$wp_customize->add_setting(
		'pinterest_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'pinterest_url',
		array(
			'settings'		=> 'pinterest_url',
			'section'		=> 'awaken_pro_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Pinterest URL', 'awaken-pro' ),
		)
	);	

	$wp_customize->add_setting(
		'rss_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'rss_url',
		array(
			'settings'		=> 'rss_url',
			'section'		=> 'awaken_pro_social_media',
			'type'			=> 'url',
			'label'			=> __( 'RSS URL', 'awaken-pro' ),
		)
	);

	$wp_customize->add_setting(
		'instagram_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'instagram_url',
		array(
			'settings'		=> 'instagram_url',
			'section'		=> 'awaken_pro_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Instagram URL', 'awaken-pro' ),
		)
	);	

	$wp_customize->add_setting(
		'flickr_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'flickr_url',
		array(
			'settings'		=> 'flickr_url',
			'section'		=> 'awaken_pro_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Flickr URL', 'awaken-pro' ),
		)
	);	

	$wp_customize->add_setting(
		'youtube_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'youtube_url',
		array(
			'settings'		=> 'youtube_url',
			'section'		=> 'awaken_pro_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Youtube URL', 'awaken-pro' ),
		)
	);	

	$wp_customize->add_setting(
		'vimeo_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'vimeo_url',
		array(
			'settings'		=> 'vimeo_url',
			'section'		=> 'awaken_pro_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Vimeo URL', 'awaken-pro' ),
		)
	);	

	$wp_customize->add_setting(
		'github_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'awaken_pro_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'github_url',
		array(
			'settings'		=> 'github_url',
			'section'		=> 'awaken_pro_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Github URL', 'awaken-pro' ),
		)
	);	

	/**
     * Sidebar Selector
     */
    $wp_customize->add_section( 
    	'awaken_pro_sidebar_selector', 
    	array(
			'title' 		=> __( 'Sidebar Selector', 'awaken-pro' ),
			'priority'		=> 105,
			'description'	=> __( 'Use this section to choose default sidebars for different areas of the site.', 'awaken-pro' )
		) 
	);

	$wp_customize->add_setting(
		'frontpage_sidebar',
		array(
			'default'			=> 'sidebar-1',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'awaken_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'frontpage_sidebar',
		array(
			'settings'		=> 'frontpage_sidebar',
			'section'		=> 'awaken_pro_sidebar_selector',
			'type'			=> 'select',
			'label'			=> __( 'Frontpage sidebar', 'awaken-pro' ),
			'description'	=> __( 'Select the sidebar for the site frontpage. Default is <b>Main Sidebar</b>', 'awaken-pro' ),
			'choices'		=> array(
				'sidebar-1' => __( 'Main Sidebar', 'awaken-pro' ),
				'sidebar-2' => __( 'Frontpage Sidebar', 'awaken-pro' )
			)
		)
	);

	$wp_customize->add_setting(
		'post_sidebar',
		array(
			'default'			=> 'sidebar-1',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'awaken_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'post_sidebar',
		array(
			'settings'		=> 'post_sidebar',
			'section'		=> 'awaken_pro_sidebar_selector',
			'type'			=> 'select',
			'label'			=> __( 'Sidebar for posts.', 'awaken-pro' ),
			'description'	=> __( 'Select the sidebar for single posts. Default is <b>Main Sidebar</b>', 'awaken-pro' ),
			'choices'		=> array(
				'sidebar-1' => __( 'Main Sidebar', 'awaken-pro' ),
				'sidebar-3' => __( 'Post Sidebar', 'awaken-pro' )
			)
		)
	);	

	$wp_customize->add_setting(
		'page_sidebar',
		array(
			'default'			=> 'sidebar-1',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'awaken_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		'page_sidebar',
		array(
			'settings'		=> 'page_sidebar',
			'section'		=> 'awaken_pro_sidebar_selector',
			'type'			=> 'select',
			'label'			=> __( 'Sidebar for pages', 'awaken-pro' ),
			'description'	=> __( 'Select the sidebar for single posts. Default is <b>Main Sidebar</b>', 'awaken-pro' ),
			'choices'		=> array(
				'sidebar-1' => __( 'Main Sidebar', 'awaken-pro' ),
				'sidebar-4' => __( 'Page Sidebar', 'awaken-pro' )
			)
		)
	);		

}
add_action( 'customize_register', 'awaken_pro_customize_register' );

/**
 * Image sanitization.
 * 
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */

function awaken_pro_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}

/**
 * Sanitize the logo title select option.
 *
 * @param string $logo_option.
 * @return string (text-description-only|site-logo-only|site-logo-text-desc|display-none).
 */
function awaken_pro_sanitize_logo_title_select( $logo_option ) {
	if ( ! in_array( $logo_option, array( 'text-only', 'logo-only', 'text-logo', 'display-none' ) ) ) {
        $logo_option = 'text-description-only';
    } 

    return $logo_option;
}

/**
 * Checkbox sanitization.
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function awaken_pro_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * HTML sanitization 
 *
 * @see wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
 *
 * @param string $html HTML to sanitize.
 * @return string Sanitized HTML.
 */
function awaken_pro_sanitize_html( $html ) {
	return wp_filter_post_kses( $html );
}

/**
 * CSS sanitization.
 * 
 * @see wp_strip_all_tags() https://developer.wordpress.org/reference/functions/wp_strip_all_tags/
 *
 * @param string $css CSS to sanitize.
 * @return string Sanitized CSS.
 */
function awaken_pro_sanitize_css( $css ) {
	return wp_strip_all_tags( $css );
}


/**
 * URL sanitization.
 * 
 * @see esc_url_raw() https://developer.wordpress.org/reference/functions/esc_url_raw/
 *
 * @param string $url URL to sanitize.
 * @return string Sanitized URL.
 */
function awaken_pro_sanitize_url( $url ) {
	return esc_url_raw( $url );
}



/**
 * Number sanitization callback example.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int Sanitized number; otherwise, the setting default.
 */
function awaken_pro_sanitize_number( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );
	
	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

function awaken_pro_sanitize_intval( $number, $setting ) {
	// Ensure number is an integer.
	$number = intval( $number );

	// If the input is an integer, return it; otherwise, return the default
	return ( ( $number >= 0 ) ? $number : $setting->default );
}

/**
 * HEX Color sanitization
 *
 * @see sanitize_hex_color() https://developer.wordpress.org/reference/functions/sanitize_hex_color/
 * @link sanitize_hex_color_no_hash() https://developer.wordpress.org/reference/functions/sanitize_hex_color_no_hash/
 *
 * @param string               $hex_color HEX color to sanitize.
 * @param WP_Customize_Setting $setting   Setting instance.
 * @return string The sanitized hex color if not empty; otherwise, the setting default.
 */
function awaken_pro_sanitize_hex_color( $hex_color, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$hex_color = sanitize_hex_color( $hex_color );
	
	// If $input is a valid hex value, return it; otherwise, return the default.
	return ( ! empty( $hex_color ) ? $hex_color : $setting->default );
}

/**
 * Select sanitization
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function awaken_pro_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}



function awaken_pro_sanitize_checkbox_multiple( $values ) {

    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/**
 * Category dropdown sanitization.
 *
 * @param int $catid to sanitize.
 * @return int $cat_id.
 */
function awaken_pro_sanitize_category_dropdown( $catid ) {
	// Ensure $catid is an absolute integer.
	return $cat_id = absint( $catid );
	
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function awaken_pro_customize_preview_js() {
	wp_enqueue_script( 'awaken_pro_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'awaken_pro_customize_preview_js' );



/**
 * Enqueue the customizer stylesheet.
 */
function awaken_pro_enqueue_customizer_stylesheets() {

    wp_register_style( 'awaken-customizer-css', get_template_directory_uri() . '/inc/customizer/assets/customizer.css', NULL, NULL, 'all' );
    wp_enqueue_style( 'awaken-customizer-css' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.4.0' );

}
add_action( 'customize_controls_print_styles', 'awaken_pro_enqueue_customizer_stylesheets' );
