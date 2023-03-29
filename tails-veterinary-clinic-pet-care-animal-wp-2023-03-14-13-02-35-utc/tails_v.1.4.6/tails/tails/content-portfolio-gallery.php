<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

$tails_blog_style = explode('_', tails_get_theme_option('blog_style'));
$tails_columns = empty($tails_blog_style[1]) ? 2 : max(2, $tails_blog_style[1]);
$tails_post_format = get_post_format();
$tails_post_format = empty($tails_post_format) ? 'standard' : str_replace('post-format-', '', $tails_post_format);
$tails_animation = tails_get_theme_option('blog_animation');
$tails_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($tails_columns).' post_format_'.esc_attr($tails_post_format) ); ?>
	<?php echo (!tails_is_off($tails_animation) ? ' data-animation="'.esc_attr(tails_get_animation_classes($tails_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($tails_image[1]) && !empty($tails_image[2])) echo intval($tails_image[1]) .'x' . intval($tails_image[2]); ?>"
	data-src="<?php if (!empty($tails_image[0])) echo esc_url($tails_image[0]); ?>"
	>

	<?php
	$tails_image_hover = 'icon';
	if (in_array($tails_image_hover, array('icons', 'zoom'))) $tails_image_hover = 'dots';
	// Featured image
	tails_show_post_featured(array(
		'hover' => $tails_image_hover,
		'thumb_size' => tails_get_thumb_size( strpos(tails_get_theme_option('body_style'), 'full')!==false || $tails_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. tails_show_post_meta(array(
									'categories' => true,
									'date' => true,
									'edit' => false,
									'seo' => false,
									'share' => true,
									'counters' => 'comments',
									'echo' => false
									))
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'tails') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>