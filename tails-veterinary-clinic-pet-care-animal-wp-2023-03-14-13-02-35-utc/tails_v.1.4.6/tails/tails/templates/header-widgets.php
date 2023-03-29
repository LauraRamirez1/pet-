<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

// Header sidebar
$tails_header_name = tails_get_theme_option('header_widgets');
$tails_header_present = !tails_is_off($tails_header_name) && is_active_sidebar($tails_header_name);
if ($tails_header_present) { 
	tails_storage_set('current_sidebar', 'header');
	$tails_header_wide = tails_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($tails_header_name) ) {
		dynamic_sidebar($tails_header_name);
	}
	$tails_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($tails_widgets_output)) {
		$tails_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $tails_widgets_output);
		$tails_need_columns = strpos($tails_widgets_output, 'columns_wrap')===false;
		if ($tails_need_columns) {
			$tails_columns = max(0, (int) tails_get_theme_option('header_columns'));
			if ($tails_columns == 0) $tails_columns = min(6, max(1, substr_count($tails_widgets_output, '<aside ')));
			if ($tails_columns > 1)
				$tails_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($tails_columns).' widget ', $tails_widgets_output);
			else
				$tails_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($tails_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$tails_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($tails_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'tails_action_before_sidebar' );
				tails_show_layout($tails_widgets_output);
				do_action( 'tails_action_after_sidebar' );
				if ($tails_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$tails_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>