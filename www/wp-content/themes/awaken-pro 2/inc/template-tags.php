<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Awaken
 */

if ( ! function_exists( 'awaken_pro_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function awaken_pro_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 3,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '<span class="meta-nav-prev"></span> Previous', 'awaken-pro' ),
		'next_text' => __( 'Next <span class="meta-nav-next"></span>', 'awaken-pro' ),
		'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'awaken-pro' ); ?></h1>
			<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'awaken_pro_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function awaken_pro_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'awaken-pro' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '%title', 'Previous post link', 'awaken-pro' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title', 'Next post link',     'awaken-pro' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'awaken_pro_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function awaken_pro_posted_on() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$single_post_meta = get_theme_mod('single_post_meta', array( 'date', 'author', 'comments' ) );
	$index_post_meta = get_theme_mod('index_post_meta', array( 'date', 'author', 'comments' ) );

	$option_date		= ( in_array('date', $index_post_meta) ) ? 1 : 0;
	$option_author 		= ( in_array('author', $index_post_meta) ) ? 1 : 0;
	$option_comments 	= ( in_array('comments', $index_post_meta) ) ? 1 : 0;
	$option_date_s		= ( in_array('date', $single_post_meta) ) ? 1 : 0;
	$option_author_s 	= ( in_array('author', $single_post_meta) ) ? 1 : 0;
	$option_comments_s 	= ( in_array('comments', $single_post_meta) ) ? 1 : 0;

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
	
	if ( ! is_single() ) {
		if( $option_date == '1' ) {
			echo '<span class="posted-on">' . $posted_on . '</span>';
		}
		if( $option_author == '1' ) {
			echo '<span class="byline">' . $byline . '</span>';
		}
		if( $option_comments == '1' ) {
			if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Comment', 'awaken-pro' ), '1', '%' ); ?></span>
			<?php endif;
		} 
	} else {
		if( $option_date_s == '1' ) {
			echo '<span class="posted-on">' . $posted_on . '</span>';
		}
		if( $option_author_s == '1' ) {
			echo '<span class="byline"> ' . $byline . '</span>';
		}
		if( $option_comments_s == '1' ) {
			if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'awaken-pro' ), __( '1 Comment', 'awaken-pro' ), __( '% Comments', 'awaken-pro' ) ); ?></span>
			<?php endif;
		}
	}


}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function awaken_pro_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'awaken_pro_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'awaken_pro_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so awaken_pro_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so awaken_pro_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in awaken_pro_categorized_blog.
 */
function awaken_pro_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'awaken_pro_categories' );
}
add_action( 'edit_category', 'awaken_pro_category_transient_flusher' );
add_action( 'save_post',     'awaken_pro_category_transient_flusher' );


/**
* Get the featured image if exists.
* @return void
*/
function awaken_pro_featured_image() {
	if ( post_password_required() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) : 
		if ( get_theme_mod( 'show_article_featured_image', 1 ) ) { ?>
			<div class="article-featured-image">
				<?php the_post_thumbnail( 'featured-slider' ); ?>
			</div>
	    <?php } ?>
	<?php else : ?>
		<div class="article-preview-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'featured' ); ?></a>
		</div>
	<?php endif;
}