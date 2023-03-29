<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0.10
 */

// Footer sidebar
$tails_footer_name = tails_get_theme_option('footer_widgets');
$tails_footer_present = !tails_is_off($tails_footer_name) && is_active_sidebar($tails_footer_name);
if ($tails_footer_present) { 
	tails_storage_set('current_sidebar', 'footer');
	$tails_footer_wide = tails_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($tails_footer_name) ) {
		dynamic_sidebar($tails_footer_name);
	}
	$tails_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($tails_out)) {
		$tails_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $tails_out);
		$tails_need_columns = true;
		if ($tails_need_columns) {
			$tails_columns = max(0, (int) tails_get_theme_option('footer_columns'));
			if ($tails_columns == 0) $tails_columns = min(6, max(1, substr_count($tails_out, '<aside ')));
			if ($tails_columns > 1)
				$tails_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($tails_columns).' widget ', $tails_out);
			else
				$tails_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($tails_footer_wide) ? ' footer_fullwidth' : ''; ?>">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$tails_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($tails_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'tails_action_before_sidebar' );
				tails_show_layout($tails_out);
				do_action( 'tails_action_after_sidebar' );
				if ($tails_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$tails_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>