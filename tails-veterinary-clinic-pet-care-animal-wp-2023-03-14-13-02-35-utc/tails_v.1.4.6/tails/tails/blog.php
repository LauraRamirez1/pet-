<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WPBakery Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$tails_content = '';
$tails_blog_archive_mask = '%%CONTENT%%';
$tails_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $tails_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($tails_content = apply_filters('the_content', get_the_content())) != '') {
		if (($tails_pos = strpos($tails_content, $tails_blog_archive_mask)) !== false) {
			$tails_content = preg_replace('/(\<p\>\s*)?'.$tails_blog_archive_mask.'(\s*\<\/p\>)/i', $tails_blog_archive_subst, $tails_content);
		} else
			$tails_content .= $tails_blog_archive_subst;
		$tails_content = explode($tails_blog_archive_mask, $tails_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) tails_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$tails_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$tails_args = tails_query_add_posts_and_cats($tails_args, '', tails_get_theme_option('post_type'), tails_get_theme_option('parent_cat'));
$tails_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($tails_page_number > 1) {
	$tails_args['paged'] = $tails_page_number;
	$tails_args['ignore_sticky_posts'] = true;
}
$tails_ppp = tails_get_theme_option('posts_per_page');
if ((int) $tails_ppp != 0)
	$tails_args['posts_per_page'] = (int) $tails_ppp;
// Make a new query
query_posts( $tails_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($tails_content) && count($tails_content) == 2) {
	set_query_var('blog_archive_start', $tails_content[0]);
	set_query_var('blog_archive_end', $tails_content[1]);
}

get_template_part('index');
?>