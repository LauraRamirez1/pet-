<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($tails_columns).' post_format_'.esc_attr($tails_post_format) ); ?>
	<?php echo (!tails_is_off($tails_animation) ? ' data-animation="'.esc_attr(tails_get_animation_classes($tails_animation)).'"' : ''); ?>
	>

	<?php
	$tails_image_hover = tails_get_theme_option('image_hover');
	// Featured image
	tails_show_post_featured(array(
		'thumb_size' => tails_get_thumb_size(strpos(tails_get_theme_option('body_style'), 'full')!==false || $tails_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $tails_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $tails_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>