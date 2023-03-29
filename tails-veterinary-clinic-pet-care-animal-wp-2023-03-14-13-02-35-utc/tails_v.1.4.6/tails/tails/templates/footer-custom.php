<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0.10
 */

$tails_footer_scheme =  tails_is_inherit(tails_get_theme_option('footer_scheme')) ? tails_get_theme_option('color_scheme') : tails_get_theme_option('footer_scheme');
$tails_footer_id = str_replace('footer-custom-', '', tails_get_theme_option("footer_style"));
if ((int) $tails_footer_id == 0) {
	$tails_footer_id = tails_get_post_id(array(
			'name' => $tails_footer_id,
			'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
		)
	);
} else {
	$tails_footer_id = apply_filters('trx_addons_filter_get_translated_layout', $tails_footer_id);
}

?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($tails_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($tails_footer_id))); 
						?> scheme_<?php echo esc_attr($tails_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('tails_action_show_layout', $tails_footer_id);

	?>
</footer><!-- /.footer_wrap -->
