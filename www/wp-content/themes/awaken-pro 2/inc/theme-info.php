<?php
/**
 * Awaken Pro info page
 *
 * @package Awaken Pro
 */


add_action('admin_menu', 'awaken_pro_theme_info');

function awaken_pro_theme_info() {
	add_theme_page('Awaken Pro WordPress Theme Information', 'Awaken Pro Info', 'edit_theme_options', 'awaken-pro-info', 'awaken_pro_info_display_content');
}


function awaken_pro_info_display_content() { ?>
	
	<div class="awaken-theme-info">
		<?php 
			$awaken_pro_details = wp_get_theme();
			$version = $awaken_pro_details->get( 'Version' ); 
			$name = $awaken_pro_details->get( 'Name' ); 
			$description = $awaken_pro_details->get( 'Description' ); 
		?>
		<div class="awaken-info-header">
			<h1 class="awaken-info-title">
				<?php echo strtoupper( $name ) . ' ' . $version; ?>
			</h1>
		</div>
		<div class="awaken-info-body">
			<div class="awaken-theme-description">
				<p>
					<?php echo $description; ?>
				</p>
			</div>
			<div class="awaken-info-blocks">
				<div class="awaken-info-block aw-n-margin">
					<span class="dashicons dashicons-visibility"></span>
					<a href="<?php echo esc_url('http://themezhut.com/demo/awaken-pro/'); ?>" target="_blank"><?php _e( 'View Demo', 'awaken-pro' ); ?></a>
				</div>
				<div class="awaken-info-block">
					<span class="dashicons dashicons-book-alt"></span>
					<a href="<?php echo esc_url('http://themezhut.com/awaken-pro-wordpress-theme-documentation/'); ?>" target="_blank"><?php _e( 'Documentation', 'awaken-pro' ); ?></a>
				</div>
				<div class="awaken-info-block">
					<span class="dashicons dashicons-businessman"></span>
					<a href="<?php echo esc_url('http://themezhut.com/contact/'); ?>" target="_blank"><?php _e( 'Get Support', 'awaken-pro' ); ?></a>
				</div>
				<div class="awaken-info-block aw-n-margin">
					<span class="dashicons dashicons-admin-generic"></span>
					<a href="<?php echo admin_url('customize.php'); ?>"><?php _e( 'Customize Site', 'awaken-pro' ); ?></a>
				</div>
				<div class="awaken-info-block">
					<span class="dashicons dashicons-awards"></span>
					<a href="<?php echo esc_url('http://themezhut.com/themes/awaken-pro/'); ?>" target="_blank"><?php _e( 'Theme Details', 'awaken-pro' ); ?></a>
				</div>
				<div class="awaken-info-block">
					<span class="dashicons dashicons-smiley"></span>
					<a href="<?php echo esc_url('http://themezhut.com/contact/'); ?>" target="_blank"><?php _e( 'Contact ThemezHut', 'awaken-pro' ); ?></a>
				</div>

			</div>
		</div>
	</div>

<?php }

add_action( 'admin_menu', 'awaken_pro_options_menu_item' );

function awaken_pro_options_menu_item() {
	add_menu_page( 'Awaken Options', 'Awaken Options', 'manage_options', 'awaken-options', 'awaken_pro_options_page', 'dashicons-admin-generic', 100 ); 
}

function awaken_pro_options_page() { ?>
	<div class="awaken-theme-info awaken-options">
		<p><?php _e( 'As per the new guidelines to remove theme options panels of the themes that are available on WordPress.org, we have completely removed the "Awaken Options" panel with the new Awaken 2.0 and Awaken Pro 2.0 updates. All the options are now located in the theme customizer. Go to <b>"Appearence > Customize"</b> to find the Customizer or please use the "Contact Us" link below if you have run into any issues with the update.', 'awaken-pro' ); ?></p>
		<p><a href="<?php echo admin_url('customize.php'); ?>"><?php _e( 'Go to customizer.', 'awaken-pro' ); ?></a></p>
		<a href="<?php echo esc_url('http://themezhut.com/contact/'); ?>" target="_blank"><?php _e( 'Contact Us', 'awaken-pro' ); ?></a>
	</div>
<?php }