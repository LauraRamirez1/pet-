<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

$tails_post_id    = get_the_ID();
$tails_post_date  = tails_get_date();
$tails_post_title = get_the_title();
$tails_post_link  = get_permalink();
$tails_post_author_id   = get_the_author_meta('ID');
$tails_post_author_name = get_the_author_meta('display_name');
$tails_post_author_url  = get_author_posts_url($tails_post_author_id, '');

$tails_args = get_query_var('tails_args_widgets_posts');
$tails_show_date = isset($tails_args['show_date']) ? (int) $tails_args['show_date'] : 1;
$tails_show_image = isset($tails_args['show_image']) ? (int) $tails_args['show_image'] : 1;
$tails_show_author = isset($tails_args['show_author']) ? (int) $tails_args['show_author'] : 1;
$tails_show_counters = isset($tails_args['show_counters']) ? (int) $tails_args['show_counters'] : 1;
$tails_show_categories = isset($tails_args['show_categories']) ? (int) $tails_args['show_categories'] : 1;

$tails_output = tails_storage_get('tails_output_widgets_posts');

$tails_post_counters_output = '';
if ( $tails_show_counters ) {
	$tails_post_counters_output = '<span class="post_info_item post_info_counters">'
								. tails_get_post_counters('comments')
							. '</span>';
}


$tails_output .= '<article class="post_item with_thumb">';

if ($tails_show_image) {
	$tails_post_thumb = get_the_post_thumbnail($tails_post_id, tails_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($tails_post_thumb) $tails_output .= '<div class="post_thumb">' . ($tails_post_link ? '<a href="' . esc_url($tails_post_link) . '">' : '') . ($tails_post_thumb) . ($tails_post_link ? '</a>' : '') . '</div>';
}

$tails_output .= '<div class="post_content">'
			. ($tails_show_categories 
					? '<div class="post_categories">'
						. tails_get_post_categories()
						. $tails_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($tails_post_link ? '<a href="' . esc_url($tails_post_link) . '">' : '') . ($tails_post_title) . ($tails_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('tails_filter_get_post_info', 
								'<div class="post_info">'
									. ($tails_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($tails_post_link ? '<a href="' . esc_url($tails_post_link) . '" class="post_info_date">' : '') 
											. esc_html($tails_post_date) 
											. ($tails_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($tails_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'tails') . ' ' 
											. ($tails_post_link ? '<a href="' . esc_url($tails_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($tails_post_author_name) 
											. ($tails_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$tails_show_categories && $tails_post_counters_output
										? $tails_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
tails_storage_set('tails_output_widgets_posts', $tails_output);
?>