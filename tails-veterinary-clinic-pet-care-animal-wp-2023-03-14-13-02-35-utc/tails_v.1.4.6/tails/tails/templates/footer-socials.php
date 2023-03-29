<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0.10
 */


// Socials
if ( tails_is_on(tails_get_theme_option('socials_in_footer')) && ($tails_output = tails_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php tails_show_layout($tails_output); ?>
		</div>
	</div>
	<?php
}
?>