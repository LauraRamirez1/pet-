<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr(tails_get_theme_option('menu_mobile_fullscreen') > 0 ? 'fullscreen' : 'narrow'); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a><?php

		// Logo
		set_query_var('tails_logo_args', array('type' => 'inverse'));
		get_template_part( 'templates/header-logo' );
		set_query_var('tails_logo_args', array());

		// Mobile menu
		$tails_menu_mobile = tails_get_nav_menu('menu_mobile');
		if (empty($tails_menu_mobile)) {
			$tails_menu_mobile = apply_filters('tails_filter_get_mobile_menu', '');
			if (empty($tails_menu_mobile)) $tails_menu_mobile = tails_get_nav_menu('menu_main');
			if (empty($tails_menu_mobile)) $tails_menu_mobile = tails_get_nav_menu();
		}
		if (!empty($tails_menu_mobile)) {
			if (!empty($tails_menu_mobile))
				$tails_menu_mobile = str_replace(
					array('menu_main', 'id="menu-', 'sc_layouts_menu_nav', 'sc_layouts_hide_on_mobile', 'hide_on_mobile'),
					array('menu_mobile', 'id="menu_mobile-', '', '', ''),
					$tails_menu_mobile
					);
			if (strpos($tails_menu_mobile, '<nav ')===false)
				$tails_menu_mobile = sprintf('<nav class="menu_mobile_nav_area">%s</nav>', $tails_menu_mobile);
			tails_show_layout(apply_filters('tails_filter_menu_mobile_layout', $tails_menu_mobile));
		}

		// Search field
		do_action('tails_action_search', 'normal', 'search_mobile', false);
		
		// Social icons
		tails_show_layout(tails_get_socials_links(), '<div class="socials_mobile">', '</div>');
		?>
	</div>
</div>
