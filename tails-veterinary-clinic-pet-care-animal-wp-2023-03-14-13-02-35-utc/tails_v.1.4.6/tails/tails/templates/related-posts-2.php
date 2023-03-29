<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

$tails_link = get_permalink();
$tails_post_format = get_post_format();
$tails_post_format = empty($tails_post_format) ? 'standard' : str_replace('post-format-', '', $tails_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_'.esc_attr($tails_post_format) ); ?>><?php
	tails_show_post_featured(array(
		'thumb_size' => tails_get_thumb_size( 'big' ),
		'show_no_image' => true,
		'singular' => false
		)
	);
	?><div class="post_header entry-header"><?php
		if ( in_array(get_post_type(), array( 'post', 'attachment' ) ) ) {
			?><span class="post_date"><a href="<?php echo esc_url($tails_link); ?>"><?php echo tails_get_date(); ?></a></span><?php
		}
		?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url($tails_link); ?>"><?php echo the_title(); ?></a></h6>
	</div>
</div>