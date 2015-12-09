<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Awaken
 */
?>
		</div><!-- container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="footer-widget-area">
					<div class="col-md-4">
						<div class="left-footer">
							<div id="secondary" class="widget-area" role="complementary">
								<?php if ( ! dynamic_sidebar( 'footer-left' ) ) : ?>
									
								<?php endif; // end sidebar widget area ?>
							</div><!-- #secondary -->
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="mid-footer">
							<div id="secondary" class="widget-area" role="complementary">
								<?php if ( ! dynamic_sidebar( 'footer-mid' ) ) : ?>

								<?php endif; // end sidebar widget area ?>
							</div><!-- #secondary -->						</div>
					</div>

					<div class="col-md-4">
						<div class="right-footer">
							<div id="secondary" class="widget-area" role="complementary">
								<?php if ( ! dynamic_sidebar( 'footer-right' ) ) : ?>

								<?php endif; // end sidebar widget area ?>
							</div><!-- #secondary -->				
						</div>
					</div>						
				</div><!-- .footer-widget-area -->
			</div><!-- .row -->
		</div><!-- .container -->	

		<div class="footer-site-info">	
			<div class="container">
				<?php 
					$footer_copyright_text = get_theme_mod( 'footer_copyright_text', '' );
					if( !empty( $footer_copyright_text ) ) {
						echo wp_kses_post( $footer_copyright_text ); 
					} else { ?>
						<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'awaken-pro' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'awaken-pro' ), 'WordPress' ); ?></a>
						<span class="sep"> | </span>
						<?php printf( __( 'Theme: %1$s by %2$s.', 'awaken-pro' ), 'Awaken', '<a href="http://www.themezhut.com" rel="designer">ThemezHut</a>' ); ?>
					<?php } ?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
