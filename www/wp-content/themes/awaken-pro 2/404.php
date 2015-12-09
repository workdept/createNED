<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Awaken
 */

get_header(); ?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-8 awaken-content-float">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'awaken-pro' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'awaken-pro' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
	</div><!-- bootstrap cols -->
	<div class="col-xs-12 col-sm-6 col-md-4 awaken-widgets-float">
		<?php get_sidebar(); ?>
	</div><!-- .bootstrap cols -->
</div><!-- .row -->
<?php get_footer(); ?>
