<?php


function awaken_pro_socialmedia() {

if ( get_theme_mod( 'display_social_icons', false ) ) : ?>

	<div class="asocial-area">
	<?php if ( get_theme_mod( 'facebook_url', '' ) ) : ?>
		<span class="asocial-icon facebook"><a href="<?php echo esc_url ( get_theme_mod( 'facebook_url', '' ) ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'Find us on Facebook', 'awaken-pro'); ?>" target="_blank"><i class="fa fa-facebook"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'twitter_url', '' ) ) : ?>
		<span class="asocial-icon twitter"><a href="<?php echo esc_url ( get_theme_mod( 'twitter_url', '' ) ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'Find us on Twitter', 'awaken-pro'); ?>" target="_blank"><i class="fa fa-twitter"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'googleplus_url', '' ) ) : ?>
		<span class="asocial-icon googleplus"><a href="<?php echo esc_url ( get_theme_mod( 'googleplus_url', '' ) ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'Find us on Google Plus', 'awaken-pro'); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'linkedin_url', '' ) ) : ?>
		<span class="asocial-icon linkedin"><a href="<?php echo esc_url ( get_theme_mod( 'linkedin_url', '' ) ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'Find us on Linkedin', 'awaken-pro'); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'pinterest_url', '' ) ) : ?>
		<span class="asocial-icon pinterest"><a href="<?php echo esc_url ( get_theme_mod( 'pinterest_url', '' ) ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'Find us on Pinterest', 'awaken-pro'); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'youtube_url', '' ) ) : ?>
		<span class="asocial-icon youtube"><a href="<?php echo esc_url ( get_theme_mod( 'youtube_url', '' ) ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'Find us on Youtube', 'awaken-pro'); ?>" target="_blank"><i class="fa fa-youtube"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'vimeo_url', '' ) ) : ?>
		<span class="asocial-icon vimeo"><a href="<?php echo esc_url ( get_theme_mod( 'vimeo_url', '' ) ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'Find us on Vimeo', 'awaken-pro'); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></span>
	<?php endif; ?>	
	<?php if ( get_theme_mod( 'rss_url', '' ) ) : ?>
		<span class="asocial-icon rss"><a href="<?php echo esc_url ( get_theme_mod( 'rss_url', '' ) ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'Find us on RSS', 'awaken-pro'); ?>" target="_blank"><i class="fa fa-rss"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'instagram_url', '' ) ) : ?>
		<span class="asocial-icon instagram"><a href="<?php echo esc_url ( get_theme_mod( 'instagram_url', '' ) ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'Find us on Instagram', 'awaken-pro'); ?>" target="_blank"><i class="fa fa-instagram"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'flickr_url', '' ) ) : ?>
		<span class="asocial-icon flickr"><a href="<?php echo esc_url ( get_theme_mod( 'flickr_url', '' ) ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'Find us on Flickr', 'awaken-pro'); ?>" target="_blank"><i class="fa fa-flickr"></i></a></span>
	<?php endif; ?>
	<?php if ( get_theme_mod( 'github_url', '' ) ) : ?>
		<span class="asocial-icon github"><a href="<?php echo esc_url ( get_theme_mod( 'github_url', '' ) ) ?>" data-toggle="tooltip" data-placement="bottom" title="<?php _e( 'Find us on Github', 'awaken-pro'); ?>" target="_blank"><i class="fa fa-github"></i></a></span>
	<?php endif; ?>
	</div>
	
<?php endif;

}