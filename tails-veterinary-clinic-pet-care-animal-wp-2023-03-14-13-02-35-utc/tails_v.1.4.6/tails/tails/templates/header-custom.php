<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0.06
 */

$tails_header_css = $tails_header_image = '';
$tails_header_video = tails_get_header_video();
if (true || empty($tails_header_video)) {
	$tails_header_image = get_header_image();
	if (tails_is_on(tails_get_theme_option('header_image_override')) && apply_filters('tails_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($tails_cat_img = tails_get_category_image()) != '')
				$tails_header_image = $tails_cat_img;
		} else if (is_singular() || tails_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$tails_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($tails_header_image)) $tails_header_image = $tails_header_image[0];
			} else
				$tails_header_image = '';
		}
	}
}

$tails_header_id = str_replace('header-custom-', '', tails_get_theme_option("header_style"));
if ((int) $tails_header_id == 0) {
	$tails_header_id = tails_get_post_id(array(
			'name' => $tails_header_id,
			'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
		)
	);
} else {
	$tails_header_id = apply_filters('trx_addons_filter_get_translated_layout', $tails_header_id);
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($tails_header_id); 
						?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($tails_header_id)));
						echo !empty($tails_header_image) || !empty($tails_header_video) 
							? ' with_bg_image' 
							: ' without_bg_image';
						if ($tails_header_video!='') 
							echo ' with_bg_video';
						if ($tails_header_image!='') 
							echo ' '.esc_attr(tails_add_inline_css_class('background-image: url('.esc_url($tails_header_image).');'));
						if (is_single() && has_post_thumbnail()) 
							echo ' with_featured_image';
						if (tails_is_on(tails_get_theme_option('header_fullheight'))) 
							echo ' header_fullheight trx-stretch-height';
						?> scheme_<?php echo esc_attr(tails_is_inherit(tails_get_theme_option('header_scheme')) 
														? tails_get_theme_option('color_scheme') 
														: tails_get_theme_option('header_scheme'));
						?>"><?php

	// Background video
	if (!empty($tails_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('tails_action_show_layout', $tails_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>