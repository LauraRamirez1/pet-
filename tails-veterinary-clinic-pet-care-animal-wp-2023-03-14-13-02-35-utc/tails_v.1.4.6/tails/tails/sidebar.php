<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

$tails_sidebar_position = tails_get_theme_option('sidebar_position');
if (tails_sidebar_present()) {
	ob_start();
	$tails_sidebar_name = tails_get_theme_option('sidebar_widgets');
	tails_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($tails_sidebar_name) ) {
		dynamic_sidebar($tails_sidebar_name);
	}
	$tails_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($tails_out)) {
		?>
		<div class="sidebar <?php echo esc_attr($tails_sidebar_position); ?> widget_area<?php if (!tails_is_inherit(tails_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(tails_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'tails_action_before_sidebar' );
				tails_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $tails_out));
				do_action( 'tails_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>