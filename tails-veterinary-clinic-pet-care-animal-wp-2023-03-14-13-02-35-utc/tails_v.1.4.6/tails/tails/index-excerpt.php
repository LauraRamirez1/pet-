<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

tails_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	?><div class="posts_container"><?php
	
	$tails_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$tails_sticky_out = is_array($tails_stickies) && count($tails_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($tails_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($tails_sticky_out && !is_sticky()) {
			$tails_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $tails_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($tails_sticky_out) {
		$tails_sticky_out = false;
		?></div><?php
	}
	
	?></div><?php

	tails_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>