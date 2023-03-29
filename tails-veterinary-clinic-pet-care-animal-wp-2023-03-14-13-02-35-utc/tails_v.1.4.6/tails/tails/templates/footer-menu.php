<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0.10
 */

// Footer menu
$tails_menu_footer = tails_get_nav_menu('menu_footer');
if (!empty($tails_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php tails_show_layout($tails_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>