<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
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

?><header class="top_panel top_panel_default<?php
					echo !empty($tails_header_image) || !empty($tails_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($tails_header_video!='') echo ' with_bg_video';
					if ($tails_header_image!='') echo ' '.esc_attr(tails_add_inline_css_class('background-image: url('.esc_url($tails_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (tails_is_on(tails_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
					?> scheme_<?php echo esc_attr(tails_is_inherit(tails_get_theme_option('header_scheme')) 
													? tails_get_theme_option('color_scheme') 
													: tails_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($tails_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (tails_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	get_template_part( 'templates/header-single' );

?></header>